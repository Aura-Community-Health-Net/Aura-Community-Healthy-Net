<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\StripeClient;
class PaymentsController extends Controller
{
    public static function calculateChargeForProduct(): string
    {
        $stripe_secret_key = $_ENV["STRIPE_SECRET_KEY"];
        Stripe::setApiKey($stripe_secret_key);
        $db = new Database();
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType!=='consumer'){
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
                if(!$customer_stripe_id) {
                    throw new \Exception("No payment ID");
                }
                $stripeCustomer = Customer::retrieve([
                    "id" => $customer_stripe_id
                ]);
                $stripeCustomerId = $stripeCustomer->id;
        }catch (\Exception $e) {
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
                    return "System Error";
            }
        }


        $product_id = $_GET["product_id"];

        $stmt = $db->connection->prepare("SELECT * FROM product where product_id = ?");
        $stmt->bind_param("d", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        $paymentIntent = PaymentIntent::create([
            'amount' => $product['price'],
            'currency' => 'lkr',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
            'customer' => $stripeCustomerId,
            'receipt_email' => $customer_email,
        ]);
        $output = [
            'clientSecret' => $paymentIntent->client_secret,
        ];

        header("Content-Type: application/json");
        return json_encode($output);
    }
}