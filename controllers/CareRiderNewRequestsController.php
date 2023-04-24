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
        $careRider = $result->fetch_assoc();


        $stmt = $db->connection->prepare("SELECT * FROM care_rider_time_slot WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $requests = $result->fetch_all(MYSQLI_ASSOC);


        $confirmation = 0;
        $stmt = $db->connection->prepare("SELECT * FROM care_rider_time_slot INNER JOIN ride_request ON care_rider_time_slot.request_id = ride_request.request_id INNER JOIN service_consumer ON service_consumer.consumer_nic = ride_request.consumer_nic WHERE ride_request.provider_nic = ? && ride_request.confirmation = ?");
        $stmt->bind_param("si", $nic,$confirmation);
        $stmt->execute();
        $result = $stmt->get_result();
        $request_details = $result->fetch_all(MYSQLI_ASSOC);

        return self::render(view: "care-rider-dashboard-new-requests",layout: "care-rider-dashboard-layout",params:  ["requests" => $requests,"request_details"=>$request_details ] ,layoutParams: array("care_rider" => $careRider,
            "active_link" => "new-requests",
            "title" => "New Requests",
            "care_rider"=>$careRider
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

            if($id==1){
                $stmt = $db->connection->prepare("UPDATE ride_request SET done = 1 WHERE request_id = ?");
                $stmt->bind_param("i",$request_id );
                $stmt->execute();
                $result = $stmt->get_result();
            }
        }
        var_dump();
        header("location: /care-rider-dashboard/new-requests");

        return self::render(view: 'care-rider-dashboard-new-requests', layout: "care-rider-dashboard-layout", params: [
        ], layoutParams: [
            "active_link" => "new-requests",
            "title" => "New Requests",
        ]);

    }
}