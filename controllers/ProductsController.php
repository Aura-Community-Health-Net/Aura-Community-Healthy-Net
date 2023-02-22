<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Database;

class ProductsController extends Controller
{
    public static function getProductSellerChooseCategoryPage(): array |bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "product-seller") {
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
        return self::render(view: 'product-seller-dashboard-choose-category', layout: "product-seller-dashboard-layout", layoutParams: [
            "product_seller" => $product_seller,
            "active_link" => "choose-category",
            "title" => "Choose Category"
        ]);
    }

    public static function getProductSellerMedFruitsVegPage(): array |bool|string
    {
        $nic = $_SESSION["nic"];
        if (!$nic) {
            header("location: /product-seller-login");
            return "";
        } else {
            $category_id = $_GET["category"];
            $db = new Database();

            //        $sql = "SELECT * FROM product WHERE category_id = $category_id";
            $stmt = $db->connection->prepare("SELECT * FROM product WHERE category_id = ? AND provider_nic = ?");
            $stmt->bind_param("is", $category_id, $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            //        $result = $db->connection->query(query: $sql);
            $products = [];

            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }

            $stmt = $db->connection->prepare("SELECT category_name FROM product_category WHERE category_id = ?");
            $stmt->bind_param("i", $category_id);
            $stmt->execute();
            $result = $stmt->get_result();
            //        $result = $db->connection->query(query: $sql);

            $row = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $product_seller = $result->fetch_assoc();

            return self::render(view: 'product-seller-dashboard-products', layout: "product-seller-dashboard-layout", params: [
                "products" => $products,
                "category" => $category_id,
            ], layoutParams: ["title" => $row["category_name"], "product_seller" => $product_seller, "active_link" => "products"]);
        }
    }

    public static function addProducts(): string
    {
        $product_name = $_POST["name"];
        $quantity = (int) $_POST["quantity"];
        $quantity_unit = $_POST["quantity_unit"];
        $price = (int) $_POST["price"] * 100;
        $category = (int) $_GET["category"];
        if ($category != 5) {
            $stock = (int) $_POST["stock"];
            $stock_unit = $_POST["stock_unit"];
        }
        $file = $_FILES["image"];
        $file_name = $file["name"];
        $file_full_path = $file["full_path"];
        $file_type = $file["type"];
        $file_tmp_name = $file["tmp_name"];
        $file_error = $file["error"];
        $file_size = $file["size"];
        $nic = $_SESSION["nic"];

        $db = new Database();
        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $product_seller = $result->fetch_assoc();


        if (!$product_seller["is_verified"]) {
            return "
        <style>
        .verification-error{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            font-size: 4rem;
            color: rgba(0, 0, 0, 0.3);
        }
       </style>
        <div class='verification-error'>You're not verified, Please check later</div>";
        }

        $random_id = bin2hex(random_bytes(24));
        $new_file_name = $nic . $random_id . "products" . $file_name;
        move_uploaded_file($file_tmp_name, Application::$ROOT_DIR . "/public/uploads/$new_file_name");


        $stmt = $db->connection->prepare("INSERT INTO product (
                     image,
                     name, 
                     quantity,
                     quantity_unit,
                     price, 
                     stock,
                     stock_unit,
                     provider_nic, 
                     category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $image = "/uploads/$new_file_name";
        $stmt->bind_param("ssisiissi", $image, $product_name, $quantity, $quantity_unit, $price, $stock, $stock_unit, $nic, $category);
        $result = $stmt->execute();
        header("location: /product-seller-dashboard/products?category=$category");
        return "";
    }

    public static function deleteProduct()
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "product-seller") {
            header("location: /provider-login");
            return "";
        }
        $product_id = $_GET["productId"];
        $category_id = $_GET["categoryId"];

        $db = new Database();
        $stmt = $db->connection->prepare("DELETE FROM product WHERE product_id = ? AND provider_nic = ?");
        $stmt->bind_param("ds", $product_id, $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        header("location: /product-seller-dashboard/products?category=$category_id");
        return "";
    }

    public static function updateProducts(): string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "product-seller"){
            header("location: provider-login");
            return "";
        }
        $product_id = $_GET["productId"];
        $category_id = $_GET["categoryId"];

        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $quantity_unit = $_POST['quantity_unit'];
        $price = $_POST['price'] * 100;
        $stock = $_POST['stock'];
        $stock_unit = $_POST['stock_unit'];

        $db = new Database();
        $stmt = $db->connection->prepare("UPDATE product SET name = ?,quantity = ?, price = ?, quantity_unit = ?,stock = ?, stock_unit = ? WHERE product_id = ? AND provider_nic = ?");
        $stmt->bind_param("ssdsdsds", $name, $quantity, $price, $quantity_unit, $stock, $stock_unit, $product_id, $nic);
        $stmt-> execute();
        $result = $stmt->get_result();
        header("location: /product-seller-dashboard/products?category=$category_id");
        return "";
    }

    public static function getConsumerProductsPage(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        if (!$nic){
            header("location: /login");
            return "";
        } else{
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();

            return self::render(view: 'consumer-dashboard-products', layout: 'consumer-dashboard-layout', layoutParams: [
                "consumer" => $consumer,
                "title" => "Natural Food Products",
                "active_link" => "dashboard-products"
            ]);
        }
    }

    public static function getConsumerProductOverviewPage(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        if (!$nic){
            header("location: /login");
            return "";
        } else{
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();

            return self::render(view: 'consumer-dashboard-product-overview', layout: 'consumer-dashboard-layout', layoutParams: [
                "consumer" => $consumer,
                "title" => "Natural Food Products",
                "active_link" => "dashboard-product"
            ]);
        }
    }

    public static function getConsumerProductPayment(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        if (!$nic){
            header("location: /login");
            return "";
        } else{
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();

            return self::render(view: 'consumer-dashboard-product-payment', layout: 'consumer-dashboard-layout', layoutParams: [
                "consumer" => $consumer,
                "title" => "Natural Food Products",
                "active_link" => "dashboard-product"
            ]);
        }
    }



}