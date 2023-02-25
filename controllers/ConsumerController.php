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

      $db = new Database();

      $stmt = $db->connection->prepare("SELECT r.id, p.pharmacy_name,r.provider_nic,r.mobile_number FROM pharmacy p INNER JOIN service_provider r ON p.provider_nic = r.provider_nic");
      $stmt->execute();
      $result = $stmt->get_result();
      $pharmacies = $result->fetch_all(MYSQLI_ASSOC);
      return self::render(view: 'consumer-dashboard-services-pharmacy-pharmacylist', layout: "consumer-dashboard-layout", params : [
          'pharmacies' => $pharmacies
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
       $id = $_GET["id"];
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


           $stmt = $db->connection->prepare("SELECT  m.name, round(m.price/100,2) as price, m.image , m.quantity,m.quantity_unit  FROM  medicine m INNER  JOIN service_provider s ON m.provider_nic = s.provider_nic WHERE s.id = ?");

           //go through

           $stmt->bind_param("s",$id);
           $stmt->execute();
           $result = $stmt->get_result();
           $medicines = $result->fetch_all(MYSQLI_ASSOC);
//           var_dump($medicines);

//           $provider_nic = $pharmacy['provider_nic'];





           $stmt = $db->connection->prepare("SELECT * FROM service_provider s INNER  JOIN pharmacy p ON s.provider_nic = p.provider_nic WHERE s.id = ?");
           $stmt->bind_param("s",$id);
           $stmt->execute();
           $result = $stmt->get_result();
           $pharmacy = $result->fetch_assoc();



           return self::render(view: 'consumer-dashboard-services-pharmacy-pharmacy-dashboard', layout: "consumer-dashboard-layout",params: [
               'pharmacy' => $pharmacy,
               'medicines' => $medicines
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