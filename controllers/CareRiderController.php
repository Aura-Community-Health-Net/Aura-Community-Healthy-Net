<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class CareRiderController  extends Controller
{
    public static function getCareRiderChoosePage(): bool|array|string
{
$nic = $_SESSION["nic"];
$userType = $_SESSION["user_type"];
if (!$nic || $userType !== "consumer")
{
header("location: /provider-login");
return "";
}

else {
    $db = new Database();
    $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
    $stmt->bind_param("s", $nic);
    $stmt->execute();
    $result = $stmt->get_result();
    $consumer = $result->fetch_assoc();
}

return self::render(view: 'consumer-dashboard-services-care-rider', layout: "consumer-dashboard-layout", layoutParams: [
    "consumer" => $consumer,
//    "active_link" => "care-rider",
    "title" => "Care Rider"]);
}
    public static function getCareRiderRequestsPage(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if (!$nic || $userType !== "consumer")
        {
            header("location: /provider-login");
            return "";
        }

        else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();
        }

        return self::render(view: 'consumer-dashboard-services-care-rider-requests', layout: "consumer-dashboard-layout", layoutParams: [
            "consumer" => $consumer,
//    "active_link" => "care-rider",
            "title" => "Care Rider"]);
    }

}