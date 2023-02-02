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
        header("location:/pharmacy-dashboard/medicines");
        return "";

    }

    public static function viewMedPage()
    {
        $nic = $_SESSION["nic"];

        if (!$nic) {
            header("/pharmacy-login");
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
    public static function deleteMed()
    {
        /* return self::render('/DeleteMed');*/
        $nic = $_SESSION["nic"];

        /* $med_id = $_POST["med_id"];*/
        $db = new Database();
        $sql = "DELETE  FROM medicine WHERE med_id='deletex_button'";
        $result = $db->connection->query($sql);

        /*  $medicines = [];
        while($row = $result->fetch_assoc())
        {
        $medicines[] = $row;
        }*/

        /*     return self::render('Medicine',[
        "medicines" => $medicines
        ]);*/

    }

}