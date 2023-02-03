<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;
class OrdersController extends Controller
{
    public function getProductSellerOrdersPage(){
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
        $nic = $_SESSION["nic"];
        if (!$nic) {
            header("/pharmacy-login");
        } else {

            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();

            return self::render(view: 'pharmacy-dashboard-neworders', layout: "pharmacy-dashboard-layout", layoutParams: ["pharmacy" => $pharmacy, "title" => "New Orders", "active_link" => "new-orders"]);
        }

    }


















}
