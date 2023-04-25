<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Database;

class ProductsController extends Controller
{
    public static function getProductSellerChooseCategoryPage(): array|bool|string
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

    public static function getProductSellerMedFruitsVegPage(): array|bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "product-seller") {
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
        $quantity = (int)$_POST["quantity"];
        $quantity_unit = $_POST["quantity_unit"];
        $price = (int)$_POST["price"] * 100;
        $category = (int)$_GET["category"];
        if ($category != 5) {
            $stock = (int)$_POST["stock"];
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
                     provider_nic, 
                     category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $image = "/uploads/$new_file_name";
        $stmt->bind_param("ssisiisi", $image, $product_name, $quantity, $quantity_unit, $price, $stock, $nic, $category);
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
        if (!$nic || $providerType !== "product-seller") {
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

        $db = new Database();
        $stmt = $db->connection->prepare("UPDATE product SET name = ?,quantity = ?, price = ?, quantity_unit = ?,stock = ? WHERE product_id = ? AND provider_nic = ?");
        if ($category_id == 5){
            $stmt = $db->connection->prepare("UPDATE product SET name = ?,quantity = ?, price = ?, quantity_unit = ? WHERE product_id = ? AND provider_nic = ?");
        }
        if ($category_id != 5){
            $stmt->bind_param("ssdsdds", $name, $quantity, $price, $quantity_unit, $stock, $product_id, $nic);
        } else {
            $stmt->bind_param("ssdsds", $name, $quantity, $price, $quantity_unit, $product_id, $nic);

        }
        $stmt->execute();
        $result = $stmt->get_result();
        header("location: /product-seller-dashboard/products?category=$category_id");
        return "";
    }

    public static function getConsumerProductsPage(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        if (!$nic) {
            header("location: /login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();

            $category_id = isset($_GET["category_id"]) ? $_GET['category_id']:false;

            $search_query = isset($_GET["q"]) ? $_GET["q"]: "";

            $db = new Database();
            if (!$category_id) {
                $stmt = $db->connection->prepare("SELECT p.product_id, p.image, p.name, p.quantity, p.quantity_unit, p.price, h.business_name, p.stock, p.category_id FROM product p INNER JOIN `healthy_food/natural_medicine_provider` h ON p.provider_nic = h.provider_nic WHERE p.name LIKE '%$search_query%'");
//                $stmt->bind_param("s", $search_query);
            } else {
                $stmt = $db->connection->prepare("SELECT p.product_id, p.image, p.name, p.quantity, p.quantity_unit, p.price, h.business_name, p.stock, p.category_id FROM product p INNER JOIN `healthy_food/natural_medicine_provider` h ON p.provider_nic = h.provider_nic WHERE p.category_id = ? AND p.name LIKE '%$search_query%'");
                $stmt->bind_param("d", $category_id);

            }
            $stmt->execute();

            $result = $stmt->get_result();
            $products = $result->fetch_all(MYSQLI_ASSOC);

//            var_dump($search_query);
//            var_dump($products);
//            exit();

            return self::render(view: 'consumer-dashboard-products', layout: 'consumer-dashboard-layout', params: [
                'products'=>$products
            ], layoutParams: [
                "consumer" => $consumer,
                "title" => "Natural Food Products",
                "active_link" => "dashboard-products"
            ]);
        }
    }

    public static function getConsumerProductOverviewPage(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        $product_id = $_GET["id"];
        $providerType = $_SESSION["user_type"];

        if (!$nic || $providerType !== 'consumer') {
            header("location: /login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT s.provider_nic, s.profile_picture, s.name as provider_name, h.business_name, h.business_reg_no, s.address, p.image, p.name, p.quantity, p.quantity_unit, p.price, p.product_id, p.category_id, p.stock FROM product p INNER JOIN service_provider s ON p.provider_nic = s.provider_nic INNER JOIN `healthy_food/natural_medicine_provider` h ON h.provider_nic = s.provider_nic WHERE product_id = ?");
            $stmt->bind_param("d", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT * FROM product WHERE provider_nic = ? AND product_id != ?");
            $stmt->bind_param("sd", $product['provider_nic'], $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product_list = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT c.profile_picture, c.name, f.date_time, f.text FROM feedback f INNER JOIN service_consumer  c ON c.consumer_nic = f.consumer_nic WHERE f.provider_nic = ? ORDER BY f.date_time DESC");
            $stmt->bind_param("s", $product["provider_nic"]);
            $stmt->execute();
            $result = $stmt->get_result();
            $feedback_list = $result->fetch_all(MYSQLI_ASSOC);

            return self::render(view: 'consumer-dashboard-product-overview', layout: 'consumer-dashboard-layout', params: [
                'product_details'=>$product,
                'other_products'=>$product_list,
                'feedback_for_sellers' => $feedback_list
            ], layoutParams: [
                "consumer" => $consumer,
                "title" => "Natural Food Products",
                "active_link" => "dashboard-product"
            ]);
        }
    }

    public static function addProductFeedback(): string
    {
        $nic = $_SESSION["nic"];
        $product_id = $_GET["product_id"];
        $providerType = $_SESSION["user_type"];
        $product_feedback = $_POST["product-feedback"];
        $provider_nic = $_GET["provider_nic"];

        if (!$nic || $providerType!=='consumer')
        {
            header("location: /login");
            return "";
        } else{
            $db = new Database();
            $stmt = $db->connection->prepare("INSERT INTO feedback (text, date_time, provider_nic, consumer_nic) VALUES (?, now(), ?, ?)");
            $stmt->bind_param("sss", $product_feedback, $provider_nic, $nic);
            $stmt->execute();
            header("location: /products/view?id=$product_id");
            return "";
        }


    }

    public static function getConsumerProductPayment(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType!=='consumer') {
            header("location: /login");
            return "";
        } else {
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