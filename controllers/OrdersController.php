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

            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $product_seller = $result->fetch_assoc();
        }

        return self::render(view: 'product-seller-dashboard-orders', layout: "product-seller-dashboard-layout", layoutParams: [
            "product_seller" => $product_seller,
            "active_link" => "orders",
            "title" => "Orders"
        ]);
    }


    public static function viewNewOrderPage()
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

            $stmt = $db->connection->prepare("SELECT c.profile_picture,c.name,c.mobile_number,pr.prescription,pr.request_id FROM pharmacy_request pr INNER JOIN service_consumer c ON c.consumer_nic = pr.consumer_nic INNER JOIN service_provider p ON p.provider_nic = pr.provider_nic WHERE pr.provider_nic = ?  ");
            $stmt->bind_param("s",$provider_nic);
//                                                                                                                                                                                                                                                                                         AND pr.Sent_Request!=1
            $stmt->execute();
            $result = $stmt->get_result();
            $orders = $result->fetch_all(MYSQLI_ASSOC);



            return self::render(view: 'pharmacy-dashboard-neworders', layout: "pharmacy-dashboard-layout", params:[

                "orders" => $orders
            ] ,layoutParams: [
                "pharmacy" => $pharmacy,
                "title" => "New Orders",
                "active_link" => "new-orders"]);
        }

    }


















}
