<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class CartController extends Controller
{
    public static function addToCart(): string
    {
        $nic = $_SESSION["nic"];
        $product_id = $_GET["product_id"];
        $userType = $_SESSION["user_type"];

        if (!$nic || $userType !== "consumer") {
            header("Content-Type: application/json");
            http_response_code(401);
            return "You're not authorized for this action";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM cart WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $cart = $result->fetch_assoc();
            if (!$cart) {
                $stmt = $db->connection->prepare("INSERT INTO cart (consumer_nic) VALUES (?)");
                $stmt->bind_param("s", $nic);
                $stmt->execute();
                $result = $stmt->get_result();
                $cartId = $stmt->insert_id;
            } else {
                $cartId = $cart["cart_id"];
            }

            $stmt = $db->connection->prepare("SELECT * FROM cart_item WHERE cart_id = ? AND product_id = ?");
            $stmt->bind_param("dd", $cartId, $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $cartItem = $result->fetch_assoc();

            if ($cartItem){
                $stmt = $db->connection->prepare("UPDATE cart_item SET quantity = quantity + 1 WHERE cart_item_id = ?");
                $stmt->bind_param("d", $cartItem["cart_item_id"]);
                $stmt->execute();
                header("Content-Type: application/json");
                http_response_code(204);
                return "Successfully increased the amount";
            }

            $stmt = $db->connection->prepare("INSERT INTO cart_item (cart_id, product_id, quantity) VALUES (?, ?, 1)");
            $stmt->bind_param("dd", $cartId, $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            header("Content-Type: application/json");
            http_response_code(201);
            return "Successfully added to cart";
        }
    }

    public static function getCustomerCartPage(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if (!$nic || $userType !== "consumer"){
            header("location: /login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();
        }
            return self::render(view: 'consumer-dashboard-cart', layout: "consumer-dashboard-layout", layoutParams: [
                "title" => "Your Cart",
                "consumer" => $consumer,
                "active_link" => "cart",
            ]);
        }

}

