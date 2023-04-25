<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\StripeClient;
use Exception;
use JsonException;
use app\core\Application;


class PaymentsController extends Controller
{
    public static function calculateChargeForProduct(): string
    {
        $stripe_secret_key = $_ENV["STRIPE_SECRET_KEY"];
        Stripe::setApiKey($stripe_secret_key);
        $db = new Database();
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== 'consumer') {
            header("location: /login");
            return "";
        }
        $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $customer = $result->fetch_assoc();
        $customer_id = $customer["consumer_nic"];
        $customer_name = $customer["name"];
        $customer_email = $customer["email_address"];
        $customer_mobile_number = $customer["mobile_number"];
        $customer_stripe_id = $customer["stripe_id"];

        try {
            if (!$customer_stripe_id) {
                throw new Exception("No payment ID");
            }
            $stripeCustomer = Customer::retrieve([
                "id" => $customer_stripe_id
            ]);
            $stripeCustomerId = $stripeCustomer->id;
        } catch (Exception $e) {
            if (($e instanceof ApiErrorException && $e->getStripeCode() === "resource_missing") || !$customer_stripe_id) {
                $stripeCustomer = Customer::create([
                    'email' => $customer_email,
                    'name' => $customer_name,
                    'phone' => $customer_mobile_number
                ]);
                $stripeCustomerId = $stripeCustomer->id;

                $stmt = $db->connection->prepare("UPDATE service_consumer SET stripe_id = ? WHERE consumer_nic = ?");
                $stmt->bind_param("ss", $stripeCustomerId, $nic);
                $stmt->execute();
            } else {
                http_response_code(500);
                header("Content-Type: application/json");
                return json_encode(["message" => "Internal Server Error"]);
            }
        }

        try {
            $product_id = $_GET["product_id"];

            $stmt = $db->connection->prepare("SELECT * FROM product where product_id = ?");
            $stmt->bind_param("d", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

        } catch (Exception $e) {
            http_response_code(500);
            header("Content-Type: application/json");
            return json_encode(["message" => $e->getMessage()]);
        }

        $stmt1 = $db->connection->prepare("INSERT INTO product_order (provider_nic, consumer_nic) VALUE (?, ?)");

        $order_id = null;
        try {
            $db->connection->begin_transaction();
            $stmt1->bind_param("ss", $product["provider_nic"], $nic);
            $stmt1->execute();
            $order_id = $stmt1->insert_id;
            $stmt2 = $db->connection->prepare("INSERT INTO order_has_product (product_id, order_id, price_at_order) VALUES (?, ?, ?)");
            $stmt2->bind_param("ddd", $product_id, $order_id, $product["price"]);
            $stmt2->execute();
            if ($db->connection->errno) {
                $db->connection->rollback();
            } else {
                $db->connection->commit();
            }
        } catch (Exception $e) {
            $db->connection->rollback();
            http_response_code(500);
            header("Content-Type: application/json");
            return json_encode(["message" => $e->getMessage()]);
        }

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $product['price'],
                'currency' => 'lkr',
                'payment_method_types' => [
                    'card'
                ],
                'customer' => $stripeCustomerId,
                'receipt_email' => $customer_email,
                'metadata' => ["order_id" => $order_id]
            ]);
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            http_response_code(200);
            header("Content-Type: application/json");
            return json_encode($output);
        } catch (Exception $e) {
            http_response_code(500);
            header("Content-Type: application/json");
            return json_encode(["message" => "Internal Server Error"]);
        }

    }

    public static function verifyPayments()
    {
        PaymentsController::logPayment("Called verify moment");
        try {
            $body = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            $body = [];
        }
        PaymentsController::logPayment($body);
        $type = $body['type'];
        PaymentsController::logPayment($type);
        if ($type === 'payment_intent.succeeded') {
            $stripeCustomerId = $body['data']['object']['customer'];
            PaymentsController::logPayment($stripeCustomerId);
            $amount = $body['data']['object']['amount'];
            PaymentsController::logPayment($amount);

//            $customerModel = new Customer();
//            $customer = $customerModel->getCustomerByPaymentId($stripeCustomerId);
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE stripe_id = ?");
            $stmt->bind_param("s", $stripeCustomerId);
            $stmt->execute();
            $result = $stmt->get_result();
            $customer = $result->fetch_assoc();
            PaymentsController::logPayment($customer);

            if ($customer) {
                $metadata = $body["data"]["object"]["metadata"];
                PaymentsController::logPayment($metadata);

                $isOrderPayment = isset($metadata["order_id"]);
                $isAppointment = isset($metadata["appointment_id"]);
                PaymentsController::logPayment([
                    "isOrder" => $isOrderPayment,
                    "isAppointment" => $isAppointment
                ]);

                if ($isOrderPayment) {

                    $order_id = $metadata["order_id"];
                    PaymentsController::logPayment($order_id);
                    try {
                        $db->connection->begin_transaction();
                        $stmt = $db->connection->prepare("UPDATE product_order SET status = 'paid' WHERE order_id = ? AND consumer_nic = ?");
                        $stmt->bind_param("ds", $order_id, $customer["consumer_nic"]);
                        $stmt->execute();

                        $stmt = $db->connection->prepare("SELECT * FROM order_has_product WHERE order_id = ?");
                        $stmt->bind_param("d", $order_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $order_items = $result->fetch_all(MYSQLI_ASSOC);

                        if ($order_items) {
                            foreach ($order_items as $order_item) {
                                $product_quantity = $order_item["num_of_items"];
                                $product_id = $order_item["product_id"];

                                $stmt = $db->connection->prepare("SELECT * FROM product WHERE product_id = ?");
                                $stmt->bind_param("d", $product_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $product = $result->fetch_assoc();

                                if (!$product) {
                                    throw new Exception("Item not found");
                                } else {
                                    $stock = $product["stock"];
                                    if ($product_quantity > $stock) {
                                        throw new Exception('Not enough items');
                                    } else {
                                        $stmt = $db->connection->prepare("UPDATE product SET stock = stock - ? WHERE product_id = ?");
                                        $stmt->bind_param("dd", $product_quantity, $product_id);
                                        $stmt->execute();
                                    }
                                }
                            }
                            if ($db->connection->errno) {
                                $db->connection->rollback();
                                return "";
                            } else {
                                $db->connection->commit();
                            }
                        }
                        return "";
                    } catch (Exception $e) {
                        $db->connection->rollback();
                        $stripe_secret_key = $_ENV["STRIPE_SECRET_KEY"];
                        try {
                            $paymentIntent = PaymentIntent::retrieve($body['data']['object']['id']);
                            $stripeClient = new StripeClient([
                                'api_key' => $stripe_secret_key,
                            ]);
                            $stripeClient->refunds->create([
                                'payment_intent' => $paymentIntent->id,
                                'amount' => $amount,
                            ]);
                            return "";
                        } catch (ApiErrorException $e) {
                            return "";
                        }
                    }
                } else if ($isAppointment) {


                    $appointment_id = (int)$metadata["appointment_id"];
                    PaymentsController::logPayment($appointment_id);
                    try {
                        $db->connection->begin_transaction();
                        $stmt = $db->connection->prepare("UPDATE appointment SET status = 'paid' WHERE appointment_id = ? AND consumer_nic = ?");
                        $stmt->bind_param("ds", $appointment_id, $customer["consumer_nic"]);
                        $stmt->execute();

                        if ($db->connection->errno) {
                            $db->connection->rollback();
                            return "";
                        } else {
                            $db->connection->commit();
                        }
                        return "";
                    } catch (Exception $e) {
                        $db->connection->rollback();
                        $stripe_secret_key = $_ENV["STRIPE_SECRET_KEY"];
                        try {
                            $paymentIntent = PaymentIntent::retrieve($body['data']['object']['id']);
                            $stripeClient = new StripeClient([
                                'api_key' => $stripe_secret_key,
                            ]);
                            $stripeClient->refunds->create([
                                'payment_intent' => $paymentIntent->id,
                                'amount' => $amount,
                            ]);
                            return "";
                        } catch (ApiErrorException $e) {
                            return "";
                        }
                    }
                }

            } else {
//                We need to still create a payment record
            }


        }
    }

    public static function logPayment(mixed $body)
    {
        $logFile = fopen(Application::$ROOT_DIR . "/logs/payments.md", "a");
        fwrite($logFile, "## " . date("Y-m-d H:i:s") . "\n\n");
        fwrite($logFile, "```json\n");
        // pretty print json
        fwrite($logFile, json_encode($body, JSON_PRETTY_PRINT));
        fwrite($logFile, "\n```\n\n");
        fclose($logFile);
    }


    public static function calculateChargeForDoctorFees(): string
    {
        $stripe_secret_key = $_ENV["STRIPE_SECRET_KEY"];
        Stripe::setApiKey($stripe_secret_key);
        $db = new Database();
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== 'consumer') {
            header("location: /login");
            return "";
        }
        $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $customer = $result->fetch_assoc();
        $customer_id = $customer["consumer_nic"];
        $customer_name = $customer["name"];
        $customer_email = $customer["email_address"];
        $customer_mobile_number = $customer["mobile_number"];
        $customer_stripe_id = $customer["stripe_id"];

        try {
            if (!$customer_stripe_id) {
                throw new Exception("No payment ID");
            }
            $stripeCustomer = Customer::retrieve([
                "id" => $customer_stripe_id
            ]);
            $stripeCustomerId = $stripeCustomer->id;
        } catch (Exception $e) {
            if (($e instanceof ApiErrorException && $e->getStripeCode() === "resource_missing") || !$customer_stripe_id) {
                $stripeCustomer = Customer::create([
                    'email' => $customer_email,
                    'name' => $customer_name,
                    'phone' => $customer_mobile_number
                ]);
                $stripeCustomerId = $stripeCustomer->id;

                $stmt = $db->connection->prepare("UPDATE service_consumer SET stripe_id = ? WHERE consumer_nic = ?");
                $stmt->bind_param("ss", $stripeCustomerId, $nic);
                $stmt->execute();
            } else {
                http_response_code(500);
                header("Content-Type: application/json");
                return json_encode(["message" => "Internal Server Error"]);
            }
        }

        try {
            $appointment_id = $_GET["appointment_id"];

            $stmt = $db->connection->prepare("SELECT * FROM appointment where appointment_id = ?");
            $stmt->bind_param("d", $appointment_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $appointment = $result->fetch_assoc();

            if (!$appointment) {
                http_response_code(400);
                return json_encode("Appointment not found!");
            }


            $paymentIntent = PaymentIntent::create([
                'amount' => 150000,
                'currency' => 'lkr',
                'payment_method_types' => [
                    'card'
                ],
                'customer' => $stripeCustomerId,
                'receipt_email' => $customer_email,
                'metadata' => ["appointment_id" => $appointment_id]
            ]);
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            http_response_code(200);
            header("Content-Type: application/json");
            return json_encode($output);
        } catch (Exception $e) {
            http_response_code(500);
            header("Content-Type: application/json");
            return json_encode(["message" => $e->getMessage()]);
        }

    }


    public static function verifyFeesPayments()
    {
        try {
            $body = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            $body = [];
        }
        http_response_code(500);
        //var_dump($body);exit();
        PaymentsController::logPayment($body);
        $type = $body['type'];
        PaymentsController::logPayment($type);
        if ($type === 'payment_intent.succeeded') {
            $stripeCustomerId = $body['data']['object']['customer'];
            PaymentsController::logPayment($stripeCustomerId);
            $amount = $body['data']['object']['amount'];
            PaymentsController::logPayment($amount);

//            $customerModel = new Customer();
//            $customer = $customerModel->getCustomerByPaymentId($stripeCustomerId);
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE stripe_id = ?");
            $stmt->bind_param("s", $stripeCustomerId);
            $stmt->execute();
            $result = $stmt->get_result();
            $customer = $result->fetch_assoc();
            PaymentsController::logPayment($customer);

            if ($customer) {
                $metadata = $body["data"]["object"]["metadata"];
                PaymentsController::logPayment($metadata);
                $appointment_id = $metadata["appointment_id"];
                PaymentsController::logPayment($appointment_id);
                try {
                    $db->connection->begin_transaction();
                    $stmt = $db->connection->prepare("UPDATE appointment SET status = 'paid' WHERE appointment_id = ? AND consumer_nic = ?");
                    $stmt->bind_param("ds", $appointment_id, $customer["consumer_nic"]);
                    $stmt->execute();

                    $stmt = $db->connection->prepare("SELECT * FROM order_has_product WHERE order_id = ?");
                    $stmt->bind_param("d", $order_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $order_items = $result->fetch_all(MYSQLI_ASSOC);

                    /*if ($order_items){
                        foreach ($order_items as $order_item){
                            $product_quantity = $order_item["num_of_items"];
                            $product_id = $order_item["product_id"];

                            $stmt = $db->connection->prepare("SELECT * FROM product WHERE product_id = ?");
                            $stmt->bind_param("d", $product_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $product = $result->fetch_assoc();

                            if (!$product){
                                throw new Exception("Item not found");
                            } else {
                                $stock = $product["stock"];
                                if ($product_quantity > $stock){
                                    throw new Exception('Not enough items');
                                } else{
                                    $stmt = $db->connection->prepare("UPDATE product SET stock = stock - ? WHERE product_id = ?");
                                    $stmt->bind_param("dd", $product_quantity, $product_id);
                                    $stmt->execute();
                                }
                            }
                        }
                        if ($db->connection->errno){
                            $db->connection->rollback();
                            return "";
                        } else {
                            $db->connection->commit();
                        }
                    }*/
                    return "";
                } catch (Exception $e) {
                    $db->connection->rollback();
                    $stripe_secret_key = $_ENV["STRIPE_SECRET_KEY"];
                    try {
                        $paymentIntent = PaymentIntent::retrieve($body['data']['object']['id']);
                        $stripeClient = new StripeClient([
                            'api_key' => $stripe_secret_key,
                        ]);
                        $stripeClient->refunds->create([
                            'payment_intent' => $paymentIntent->id,
                            'amount' => $amount,
                        ]);
                        return "";
                    } catch (ApiErrorException $e) {
                        return "";
                    }
                }

            } else {
//                We need to still create a payment record
            }


        }

    }
}