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

        $stmt = $db->connection->prepare("SELECT * FROM care_rider_time_slot WHERE provider_nic = ? ") ;
        $stmt->bind_param("s",$nic);
        $stmt->execute();
        $result = $stmt->get_result();
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
        if (!$nic || $providerType !== "care-rider") {
            header("location: /provider-login");
            return "";
        }

        $db = new Database();
        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $care_rider = $result->fetch_assoc();

        if (!$care_rider["is_verified"]) {
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

        $errors = [];
        if (empty($errors)) {
            $fromTime = date("h:i A", strtotime($_POST["fromTime"]));
            $toTime = date("h:i A", strtotime($_POST["toTime"]));

            $stmt = $db->connection->prepare("INSERT INTO care_rider_time_slot (
                      date,
                      from_time,
                      to_time,
                      request_id,
                      provider_nic
                    ) VALUES (?, ?, ?, null, ?)");

            $stmt->bind_param("ssss", $_POST["date"], $fromTime, $toTime, $nic);
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


 public static function UpdateCareRiderTimeSlots(): array|bool|string
  {
      $nic = $_SESSION['nic'];
     $providerType = $_SESSION['user_type'];
     if (!$nic || $providerType != "care-rider") {
          header("location: /provider-login");

     } else {

         $slot_number = $_GET["slotNo"];
         $editDate = $_POST["edit-date"];
         $editFromTime = $_POST["edit-fromTime"];
         $editTOTime = $_POST["edit-toTime"];

           $db = new Database();
            $stmt = $db->connection->prepare("UPDATE  care_rider_time_slot SET date=?,
                                    from_time=?, to_time=? WHERE slot_number =? AND provider_nic =? ");
            $stmt->bind_param("sssss", $editDate,$editFromTime, $editTOTime,$slot_number,$nic);
            $stmt->execute();
           $result = $stmt->get_result();
          header("location:/care-rider-dashboard/timeslots ");
     }
      return "";
  }
}