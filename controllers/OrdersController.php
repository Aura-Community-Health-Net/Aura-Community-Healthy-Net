<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;
class OrdersController extends Controller
{
    public function getProductSellerOrdersPage(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if(!$nic || $providerType !== "product-seller"){
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();

            $stmt = $db->connection->prepare("
            SELECT s.profile_picture, 
                   s.name AS consumer_name, 
                   s.mobile_number, 
                   cg.category_name, 
                   p.name,
                   p.quantity,
                   p.quantity_unit,
                   o.order_id,
                   o.created_at
            FROM service_consumer s 
                INNER JOIN  product_order o ON s.consumer_nic = o.consumer_nic 
                INNER JOIN order_has_product ohp ON o.order_id = ohp.order_id 
                INNER JOIN product p on ohp.product_id = p.product_id 
                INNER JOIN product_category cg on p.category_id = cg.category_id 
            WHERE o.provider_nic = ? AND o.status = 'paid' ORDER BY o.created_at DESC;
            ");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $orders = $result->fetch_all(MYSQLI_ASSOC);
        }

        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $service_provider = $result->fetch_assoc();

        return self::render(view: 'product-seller-dashboard-orders', layout: "product-seller-dashboard-layout", params: [
            "orders" => $orders
        ], layoutParams: [
            "product_seller" => $service_provider,
            "active_link" => "orders",
            "title" => "Orders"
        ]);
    }

    public static function markOrderAsPrepared(): string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if(!$nic || $providerType !== "product-seller") {
            header("location: /provider-login");
            return "";
        } else {
            $order_id = $_GET["order_id"] ?? null;
            $db = new Database();
            $stmt = $db->connection->prepare("UPDATE product_order SET status = 'prepared' WHERE provider_nic = ? AND status = 'paid' AND order_id = ?");
            $stmt->bind_param("sd", $nic, $order_id);
            $stmt->execute();
            header("location: /product-seller-dashboard/orders");
            return "";
        }
    }

    //MARKING THE MEDICINE ORDER AS PREPARED

    public static function markMedOrderAsPrepared(): string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if(!$nic || $providerType !== "pharmacy") {
            header("location: /provider-login");
            return "";
        } else {
            $order_id = $_GET["order_id"] ?? null;
            $db = new Database();
            $stmt = $db->connection->prepare("UPDATE medicine_order SET status = 'prepare' WHERE provider_nic = ? AND status = 'paid' AND order_id = ?");
            $stmt->bind_param("sd", $nic, $order_id);
            $stmt->execute();
            header("location: /pharmacy-dashboard/orders");
            return "";
        }
    }

    //NEW PHARMACYREQUESTS FOR PHARMACY BY CONSUMERS

    public static function viewNewMedRequestsPage()
    {
        $provider_nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];

        if (!$provider_nic || $providerType !== "pharmacy" ) {
            header("/pharmacy-login");
        } else {

            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT c.profile_picture,c.name,c.mobile_number,pr.prescription,pr.request_id FROM pharmacy_request pr INNER JOIN service_consumer c ON c.consumer_nic = pr.consumer_nic INNER JOIN service_provider p ON p.provider_nic = pr.provider_nic WHERE pr.provider_nic = ? AND Sent_Request='unsent'");
            $stmt->bind_param("s",$provider_nic);
//                                                                                                                                                                                                                                                                                         AND pr.Sent_Request!=1
            $stmt->execute();
            $result = $stmt->get_result();
            $orders = $result->fetch_all(MYSQLI_ASSOC);



            return self::render(view: 'pharmacy-dashboard-newRequests', layout: "pharmacy-dashboard-layout", params:[

                "orders" => $orders
            ] ,layoutParams: [
                "pharmacy" => $pharmacy,
                "title" => "New Requests",
                "active_link" => "new-requests"]);
        }

    }

    //MEDICINE ORDERS FOR PHARMACY
    public static function viewMedicineOrders(){

        $provider_nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];

        if (!$provider_nic || $providerType !== "pharmacy" ) {
            header("/pharmacy-login");
        } else {

            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();

//            $stmt = $db->connection->prepare("
//            SELECT s.profile_picture,
//                   s.name AS consumer_name,
//                   s.mobile_number,
//                   r.available_medicines,
//                   o.order_id
//            FROM service_consumer s
//                INNER JOIN  medicine_order o ON s.consumer_nic = o.consumer_nic
//                INNER JOIN order_has_med ohm ON o.order_id = ohm.order_id
//                INNER JOIN medicine m on ohm.med_id = m.med_id
//                INNER JOIN pharmacy_request r on r.consumer_nic = o.consumer_nic
//            WHERE o.provider_nic = ? AND o.status = 'paid';
//            ");


            $stmt = $db->connection->prepare("SELECT distinct(o.order_id),s.profile_picture,s.name AS consumer_name,s.mobile_number,r.available_medicines
                FROM medicine_order o
                         INNER JOIN pharmacy_request r ON  r.request_id = o.request_id
                         INNER  JOIN order_has_med ohm ON ohm.order_id = o.order_id
                         INNER  JOIN service_consumer s ON s.consumer_nic = o.consumer_nic 
                         INNER JOIN  medicine m  ON m.med_id = ohm.med_id
                         WHERE o.provider_nic = ? AND o.status='paid'");

            $stmt->bind_param("s",$provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $orders = $result->fetch_all(MYSQLI_ASSOC);








            return self::render(view: 'pharmacy-dashboard-Orders', layout: "pharmacy-dashboard-layout", params:[
                "orders" => $orders

            ] ,layoutParams: [
                "pharmacy" => $pharmacy,
                "title" => "Orders",
                "active_link" => "orders"]);
        }









    }


















}
