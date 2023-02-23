<?php

namespace app\controllers;

use app\core\Database;

class CartController
{
    public static function addToCart(): string
    {
        $nic = $_SESSION["nic"];
        $product_id = $_GET["product_id"];
        if (!$nic){
            header("location: /login");
            return "";
        } else{
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $cart = $result->fetch_assoc();
            if (!$cart){
                $stmt = $db->connection->prepare("INSERT INTO cart (consumer_nic) VALUES (?)");
                $stmt->bind_param("s", $nic);
                $stmt->execute();
                $result = $stmt->get_result();
            }

            $stmt = $db->connection->prepare("INSERT INTO cart_item (cart_id, product_id VALUES (?, ?)");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
        }
    }
}

