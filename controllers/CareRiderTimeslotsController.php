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
        $timeslots = [];
        //        $product2=null;
        while ($row = $result->fetch_assoc()) {
            $timeslots[] = $row;
        }

        return self::render(view: 'care-rider-dashboard-timeslots', layout: "care-rider-dashboard-layout", params: ['timeslots' => $timeslots], layoutParams: [
            "care_rider" => $careRider,
            "active_link" => "timeslots",
            "title" => "Timeslots"
        ]);

    }

    public static function addCareRiderTimeslot(): array|bool|string
    {
        $nic = $_SESSION['nic'];
        $providerType = $_SESSION['user_type'];
        if(!$nic || $providerType !== "care-rider"){
            header("location: /provider-login");
            return "";
        }
        $db = new Database();

        $errors = [];
        if (empty($errors)) {

            $stmt = $db->connection->prepare("INSERT INTO care_rider_time_slot (
                              date,
                              from_time,
                              to_time,
                            request_id,
                              provider_nic
                              
                              ) VALUES ( ?, ?, ?,null,? )");

            $stmt->bind_param("ssss", $_POST["date"], $_POST["fromTime"], $_POST["toTime"],$nic);
            $stmt->execute();
            $result = $stmt->get_result();
            header("location: /care-rider-dashboard/timeslots");
            return "";

        } else {
            return self::render(view: 'care-rider-dashboard-timeslots', layout: "care-rider-dashboard-layout", layoutParams: ['errors' => $errors]);
        }
    }

    public static function deleteCareRiderTimeSlots(): array|bool|string
    {
        $nic = $_SESSION['nic'];
        $providerType = $_SESSION['user_type'];
        if (!$nic || $providerType != "care-rider") {
            header("location: /provider-login");
            return "";

        } else {

            $slot_number = $_GET['slotNo'];
            $db = new Database();
            $stmt = $db->connection->prepare("DELETE FROM care_rider_time_slot WHERE slot_number =? AND provider_nic=?");
            $stmt->bind_param("ds", $slot_number, $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            header("location:/care-rider-dashboard/timeslots ");
            return "";

        }
    }

//
//    public static function UpdateCareRiderTimeSlots(): array|bool|string
//    {
//        $nic = $_SESSION['nic'];
//        $providerType = $_SESSION['user_type'];
//        if (!$nic || $providerType != "care-rider") {
//            header("location: /provider-login");
//            return "";
//
//        } else {
//
//            $slot_number = $_GET['slotNo'];
//            $updateDate = $_POST["update-date"];
//            $updateFromTime = $_POST["update-fromTime"];
//            $updateTOTime = $_POST["update-toTime"];
//
//            $db = new Database();
//            $stmt = $db->connection->prepare("UPDATE  care_rider_time_slot SET date=?,
//                                    from_time=?, to_time=?, provider_nic=?     WHERE slot_number =? ");
//            $stmt->bind_param("SSSS", $updateDate,$updateFromTime, $updateTOTime,$nic);
//            $stmt->execute();
//            $result = $stmt->get_result();
//            header("location:/care-rider-dashboard/timeslots ");
//            return "";
//
//        }
//    }
}