<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;
use app\core\Application;

class ConsumerController extends Controller
{

  public static function getPharmacyList(): bool|array|string
  {

      $nic =$_SESSION["nic"];
      $userType = $_SESSION["user_type"];
      if(!$nic || $userType !== "consumer"){
          header("location: /provider-login");
          return "";
      } else {
          $db = new Database();
          $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
          $stmt->bind_param("s", $nic);
          $stmt->execute();
          $result = $stmt->get_result();
          $consumer = $result->fetch_assoc();
      }

      $db = new Database();

      $stmt = $db->connection->prepare("SELECT * FROM pharmacy");
      $stmt->execute();
      $result = $stmt->get_result();
      $pharmacy = $result->fetch_all(MYSQLI_ASSOC);

      return self::render(view: 'consumer-dashboard-services-pharmacy-pharmacylist', layout: "consumer-dashboard-layout", params : [
          'pharmacy' => $pharmacy
      ],

          layoutParams: [
          "consumer" => $consumer,
          "active_link" => "pharmacy",
          "title" => "Pharmacy"]);





  }


   public static function getPharmacyPaymentReceipt(): bool|array|string
   {

       $nic =$_SESSION["nic"];
       $userType = $_SESSION["user_type"];
       if(!$nic || $userType !== "consumer"){
           header("location: /provider-login");
           return "";
       } else {
           $db = new Database();
           $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
           $stmt->bind_param("s", $nic);
           $stmt->execute();
           $result = $stmt->get_result();
           $consumer = $result->fetch_assoc();
       }

       return self::render(view: 'consumer-dashboard-services-pharmacy-payment-receipt', layout: "consumer-dashboard-layout", layoutParams: [
           "consumer" => $consumer,
           "active_link" => "pharmacy",
           "title" => "Pharmacy"]);









   }



   public static function getConsumerPharmacyOverview(): bool|array|string
   {


       $nic =$_SESSION["nic"];
       $userType = $_SESSION["user_type"];
       if(!$nic || $userType !== "consumer"){
           header("location: /provider-login");
           return "";
       } else {
           $db = new Database();
           $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
           $stmt->bind_param("s", $nic);
           $stmt->execute();
           $result = $stmt->get_result();
           $consumer = $result->fetch_assoc();
           var_dump($consumer);


           $stmt = $db->connection->prepare("SELECT p.provider_nic,p.profile_picture,p.name as provider_name, h.pharmacy_name,h.pharmacist_reg_no,p.address,m.image,m.name,m.quantity,m.quantity_unit,m.price FROM medicine m INNER JOIN  service_provider p ON p.provider_nic = m.provider_nic INNER JOIN `pharmacy` h  ON h.provider_nic = p.provider_nic WHERE p.provider_nic = ?");
           $stmt->bind_param("s",$nic);
           $stmt->execute();
           $result = $stmt->get_result();
           $pharmacy = $result->fetch_assoc();
           var_dump($pharmacy);

           $stmt = $db->connection->prepare("SELECT * FROM medicine WHERE provider_nic = ?");
           $stmt->bind_param("s",$pharmacy['provider_nic']);
           $stmt->execute();
           $result = $stmt->get_result();
           $medicines_list = $result->fetch_all(MYSQLI_ASSOC);
           var_dump($medicines_list);


           return self::render(view: 'consumer-dashboard-services-pharmacy-pharmacy-dashboard', layout: "consumer-dashboard-layout",params: [
               'pharmacy_details' => $pharmacy,
               'other_medicines' => $medicines_list
           ], layoutParams: [
               "consumer" => $consumer,
               "active_link" => "pharmacy",
               "title" => "Pharmacy"]);








       }






   }


    public static function getConsumerMedicinesPayment(): bool|array|string
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
                "title" => "Medicines",
                "active_link" => "dashboard-medicines"
            ]);
        }
    }

























}