<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class CareRiderNewRequestsController extends Controller
{
    public static function getNewRequestsPage():array|bool|string
    {
        $nic = $_SESSION['nic'];
        $providerType = $_SESSION['user_type'];

        if (!$nic || $providerType != "care-rider") {
            header("location: /provider-login");
            return "";
        }
        $db = new Database();

        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $care_rider = $result->fetch_assoc();
        //print_r($careRider);die();


        $stmt = $db->connection->prepare("SELECT * FROM care_rider_time_slot WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $requests = $result->fetch_all(MYSQLI_ASSOC);


        //display new requests query
        $stmt = $db->connection->prepare("SELECT * FROM care_rider_time_slot INNER JOIN ride_request ON care_rider_time_slot.request_id = ride_request.request_id INNER JOIN service_consumer ON service_consumer.consumer_nic = ride_request.consumer_nic WHERE ride_request.provider_nic = ? && ride_request.confirmation = 0 && ride_request.done = 0 ORDER BY care_rider_time_slot.date DESC ");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $request_details = $result->fetch_all(MYSQLI_ASSOC);
//        print_r($request_details);die();

        return self::render(view: "care-rider-dashboard-new-requests",layout: "care-rider-dashboard-layout",params:  ["requests" => $requests,"request_details"=>$request_details,"care_rider" => $care_rider ] ,
            layoutParams: array(
                "care_rider" => $care_rider,
            "active_link" => "new-requests",
            "title" => "New Requests"
        ));
    }


    public static function CareRiderRequestsProcess() :array|bool|string {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];

        if (!$nic || $providerType != "care-rider") {
            header("location: /provider-login");
            return "";
        }

        $db = new database();
        if(empty($_GET)){
            $empty = $_GET;
        }else{
            $request_id = $_GET['request_id'];
            $id = $_GET['id'];
            //print_r($_GET['id']);die();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $care_rider = $result->fetch_all(MYSQLI_ASSOC);

            if($id==2){
                $stmt = $db->connection->prepare("UPDATE ride_request SET done = 1 WHERE request_id = ?");
                $stmt->bind_param("i",$request_id );
                $stmt->execute();
                $result = $stmt->get_result();

                $stmt = $db->connection->prepare("SELECT distance,consumer_nic,request_id FROM ride_request WHERE provider_nic = ? AND request_id = ?");
                $stmt->bind_param("si", $nic,$request_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $record = $result->fetch_assoc();

                $cost = $record['distance'] * 70;
                $consumer_nic = $record['consumer_nic'];
                $distance = $record['distance'];
                $request_id = $record['request_id'];
//                print_r($distance);
//                print_r($consumer_nic);
//                print_r($cost);

                $stmt = $db->connection->prepare("INSERT INTO ride (cost, distance, provider_nic, consumer_nic,request_id)
                               VALUES (?,?,?,?,?)");
                $stmt->bind_param("dissi", $cost,$distance,$nic,$consumer_nic,$request_id);
                $stmt->execute();
                $result = $stmt->get_result();


            }else if($id==1){
                $stmt = $db->connection->prepare("UPDATE ride_request SET done = 2 WHERE request_id = ?");
                $stmt->bind_param("i",$request_id );
                $stmt->execute();
                $result = $stmt->get_result();
            }
        }
        //var_dump();
        header("location: /care-rider-dashboard/new-requests");

        return self::render(view: 'care-rider-dashboard-new-requests', layout: "care-rider-dashboard-layout", params: ["care_rider" => $care_rider
        ], layoutParams: [
            "active_link" => "new-requests",
            "title" => "New Requests",
            "care-rider" => $care_rider
        ]);

    }
}