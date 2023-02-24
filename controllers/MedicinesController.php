<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Database;
use http\Params;

class MedicinesController extends Controller
{

    public static function addMed(): array |bool|string
    {
        $med_name = $_POST["med_name"];
        $image = $_FILES["image"];
        $price = (int) $_POST["price"];
        $quantity = (int) $_POST["quantity"];
        $quantity_unit = $_POST["quantity_unit"];
        $stock = (int) $_POST["stock"];
        $stock_unit = $_POST["stock_unit"];

        $filename = $image["name"];
        $file_full_path = $image["full_path"];
        $filetype = $image["type"];
        $file_tmp_name = $image["tmp_name"];
        $file_error = $image["error"];
        $file_size = $image["size"];

        $nic = $_SESSION["nic"];

        $db = new Database();
        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $pharmacy = $result->fetch_assoc();




        if (!$pharmacy["is_verified"]) {
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


        $random_ID = bin2hex(random_bytes(24));
        $newfile_name = $nic . $random_ID . "medicine" . $filename;
        move_uploaded_file($file_tmp_name, Application::$ROOT_DIR . " /public/uploads/$newfile_name");

        $db = new Database();
        $stmt = $db->connection->prepare("INSERT INTO medicine(
                     name,
                     image, 
                     price,
                     stock,
                     quantity,
                     quantity_unit,
                     stock_unit,
                     provider_nic) VALUES (?,?,?,?,?,?,?,?)");

        $image = "/uploads/$newfile_name";
        $stmt->bind_param("ssiiisss", $med_name, $image, $price, $stock, $quantity, $quantity_unit, $stock_unit, $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        header("location: /pharmacy-dashboard/medicines");
        return "";

    }

    public static function viewMedPage()
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];

        if (!$nic || $providerType !== "pharmacy") {
            header("/pharmacy-login");
            return "";
        } else {
            $db = new Database();
            $sql = "SELECT * FROM medicine WHERE provider_nic='$nic'";

            $result = $db->connection->query($sql);
            $medicines = [];
            while ($row = $result->fetch_assoc()) {
                $medicines[] = $row;
            }

            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();

            return self::render(view: 'pharmacy-dashboard-medicines', layout: "pharmacy-dashboard-layout", params: [
                "medicines" => $medicines,
            ], layoutParams: ["pharmacy" => $pharmacy, "title" => "Medicines", "active_link" => "medicines-list"]);

        }
    }



    public static function viewMedicineAdvanceInfo()
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

            return self::render(view: 'pharmacy-dashboard-neworders-advanceinfo', layout: "pharmacy-dashboard-layout", layoutParams: ["pharmacy" => $pharmacy, "title" => "New Orders", "active_link" => "new-orders"]);

        }
    }


    public static function getsidepane()
    {
        return self::render(view: '/sidebar');
    }
    public static function deleteMedicines(): string
    {

        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if(!$nic || $providerType )
        {
            header("location: /provider-login");
        }

        $medicine_id = $_GET["med_id"];
        $db = new Database();
        $stmt = $db->connection->prepare("DELETE FROM medicine WHERE med_id = ? AND provider_nic = ?");
        $stmt->bind_param("ds", $medicine_id,$nic);
        $stmt->execute();
        $result = $stmt->get_result();

        header("location: /pharmacy-dashboard/medicines");
        return "";





    }


//    public static function getupdateMedicinesForm(): string
//    {
//
//
//        $nic = $_SESSION["nic"];
//
//
//        if (!$nic) {
//            header("/pharmacy-login");
//        } else {
//
//            $db = new Database();
//            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
//            $stmt->bind_param("s", $nic);
//            $stmt->execute();
//            $result = $stmt->get_result();
//            $pharmacy = $result->fetch_assoc();
//
//            return self::render(view: 'pharmacy-dashboard-medicines-update', layout: "pharmacy-dashboard-layout", layoutParams: ["pharmacy" => $pharmacy, "title" => "Medicines", "active_link" => "medicines-list"]);
//
//        }
//
////
//    }


    public  static  function updateMedicines(): string
    {

        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if(!$nic || $providerType !== "pharmacy" )
        {
            header("location: /provider-login");
            return "";
        }

        $med_id = $_GET["med_id"];
        $med_name = $_POST["med_name"];
        $med_price = (int) $_POST["price"];
        $med_quantity = (int) $_POST["quantity"];
        $med_quantity_unit = $_POST["quantity_unit"];
        $med_stock = (int) $_POST["stock"];
        $med_stock_unit = $_POST["stock_unit"];
        $db = new Database();

        $stmt = $db->connection->prepare("UPDATE medicine SET name = ?,price = ?,stock=? , quantity = ?,quantity_unit = ?, stock_unit = ? WHERE med_id = ? AND provider_nic = ?");


        $stmt->bind_param("siiissis",$med_name,$med_price,$med_stock,$med_quantity,$med_quantity_unit,$med_stock_unit,$med_id,$nic);


        $stmt->execute();
        $result = $stmt->get_result();

        header("location: /pharmacy-dashboard/medicines");
        return "";














    }
}



