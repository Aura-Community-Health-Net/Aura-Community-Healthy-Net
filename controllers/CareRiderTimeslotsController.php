<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class CareRiderTimeslotsController extends Controller
{
    public static function getCareRiderTimeslotsPage(): array|bool|string
    {

//        var_dump($_SESSION);
//        exit();
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

        $sql = "SELECT * FROM care_rider_time_slot  ";
        $result = $db->connection->query(query: $sql);
        $product = [];
        //        $product2=null;
        while ($row = $result->fetch_assoc()) {
            $product[] = $row;
        }

        return self::render(view: 'care-rider-dashboard-timeslots', layout: "care-rider-dashboard-layout", params: ['data' => $product], layoutParams: [
            "care_rider" => $careRider,
            "active_link" => "timeslots",
            "title" => "Timeslots"
        ]);

    }

    public static function addCareRiderTimeslot(): array|bool|string
    {

        $nic = $_SESSION['nic'];
        $providerType = $_SESSION['user_type'];
        if (!$nic || $providerType != "care-rider") {
            header("location: /provider-login");
            return "";
        }

        $date = $_POST["date"];
        $day = date('l', strtotime($_POST["date"]));
        $fromTime = $_POST["fromTime"];
        $toTime = $_POST["toTime"];

        echo($date);
        echo($day);
        echo($fromTime);
        echo($toTime);

        $db = new Database();

        $errors = [];

        if (empty($errors)) {

            $stmt = $db->connection->prepare("INSERT INTO care_rider_time_slot (
                                  from_time, 
                                  to_time, 
                                  date,
                                  provider_nic
                              ) VALUES ( ?, ?, ?,?)");

            $stmt->bind_param("ssss", $fromTime, $toTime, $date, $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            header("location: /care-rider-dashboard/timeslots");
            return "";

        } else {

            $db = new Database();

            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $careRider = $result->fetch_assoc();

            $sql = "SELECT * FROM care_rider_time_slot  ";
            $result = $db->connection->query(query: $sql);
            $product = [];
            //        $product2=null;
            while ($row = $result->fetch_assoc()) {
                $product[] = $row;
            }

            return self::render(view: 'care-rider-dashboard-timeslots', layout: "care-rider-dashboard-layout", params: ['data' => $product], layoutParams: [
                "care_rider" => $careRider,
                "active_link" => "timeslots",
                "title" => "Timeslots"
            ]);

        }
    }
//
//    public static function deleteCareRiderTimeslot(): array|bool|string
//    {
//
//        $id = $_POST['slot_id'];
//        $db = new Database();
//        $sql = "DELETE FROM care_rider_time_slot WHERE slot_number=$id ";
//        $result = $db->connection->query(query: $sql);
//        $message = "Delete Succesefull!!";
//        header("location: /care-rider-dashboard/timeslots");
//        return $message;
//
//
//    }

//    public static function getUpdatePopup(): array|bool|string
//    {
//        $solt_id = $_GET['slot_id'];
//        $db = new Database();
//        $sql1 = "SELECT * FROM care_rider_time_slot  ";
//        $result1 = $db->connection->query(query: $sql1);
//        $product1 = [];
//        while ($row = $result1->fetch_assoc()) {
//            $product1[] = $row;
//        }
//
//        $sql2 = "SELECT * FROM care_rider_time_slot WHERE slot_number=$solt_id";
//        $result2 = $db->connection->query(query: $sql2);
//        $product2 = [];
//
//        while ($row = $result2->fetch_assoc()) {
//            $product2[] = $row;
//        }
//            echo "<pre>";
////        var_dump($product2);
////        echo "<pre>";
//        return self::render(view: '/care-rider-dashboard-timeslots', params: ['updateInfo' => $product2, 'data' => $product1]);
//
//    }

//    public static function updateTimeSlot(): array|bool|string
//    {
//
//        $solt_No = $_POST['soltNumberName'];
//        $upDate = $_POST['upDate'];
//        $upDay = $_POST['upDay'];
//        $upFromTime = $_POST['upFromTime'];
//        $upToTime = $_POST['upToTime'];
//        $requestId = $_POST['request_id'];
//        $provideNic = $_POST['provider_nic'];
//
//        $db = new Database();
//        $sql = "UPDATE care_rider_time_slot
//                SET from_time='$upFromTime',
//                to_time='$upToTime',
//                date='$upDate'
//                WHERE slot_number=$solt_No";
//        $result = $db->connection->query(query: $sql);
//        $message = "Update Successe!";
//        //        return self::render('carerider-timeslots-update');
//        header("location: /care-rider-dashboard/timeslots");
//        return $message;
//
//    }

}