<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class DashboardController extends Controller
{
    public static function getProductSellerDashboardPage(): array |bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];

        if (!$nic || $providerType !== "product-seller") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $product_seller = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT p.image, p.name, c.category_name, p.quantity, p.quantity_unit, p.price FROM product p INNER JOIN product_category c on p.category_id = c.category_id WHERE provider_nic = ? LIMIT 4");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $product_lists = $result->fetch_all(MYSQLI_ASSOC);

            return self::render(
            view: 'product-seller-dashboard', layout: "product-seller-dashboard-layout", params: [
                    "product_seller" => $product_seller,
                    "product_lists" => $product_lists
                ],
            layoutParams: [
                    "title" => "Dashboard",
                    "product_seller" => $product_seller,
                    "active_link" => "dashboard"
                ]
            );
        }


    }
    public static function getPharmacyDashboard(): bool|array|string
    {

        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "product-seller") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();


            $stmt = $db->connection->prepare("SELECT m.image, m.name,  m.quantity, m.quantity_unit, m.price FROM medicine m  WHERE provider_nic = ? LIMIT 4");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $medicines_lists = $result->fetch_all(MYSQLI_ASSOC);


            return self::render(view: 'pharmacy-dashboard', layout: "pharmacy-dashboard-layout", params: [
                'pharmacy' => $pharmacy,
                'medicines' => $medicines_lists
            ], layoutParams: [
                "pharmacy" => $pharmacy,
                "title" => "Dashboard",
                "active_link" => "dashboard"
            ]);
        }
    }

    public static function getCareRiderDashboard(): bool|array|string
    {
        $nic = $_SESSION['nic'];
        $providerType = $_SESSION['user_type'];
        if (!$nic || $providerType != "care-rider") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $care_rider = $result->fetch_assoc();

            return self::render(view: 'care-rider-dashboard', layout: "care-rider-dashboard-layout",params: ["care_rider"=>$care_rider], layoutParams: [
                "care_rider" => $care_rider,
                "title" => "Dashboard",
                "active_link" => "dashboard"
            ]);
        }
    }

    public static function getDoctorDashboardPage(): array |bool|string
    {
        $nic = $_SESSION["nic"];
        $provideType = $_SESSION["user_type"];
        if (!$nic || $provideType !== "doctor") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();

            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $doctor = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT * FROM appointment INNER JOIN service_consumer on service_consumer.consumer_nic = appointment.consumer_nic WHERE appointment.provider_nic = ? &&  appointment.done = 0");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $appointment_confirm = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT * FROM appointment INNER JOIN service_consumer on service_consumer.consumer_nic = appointment.consumer_nic WHERE appointment.provider_nic = ? && appointment.done = 1");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $appointment_done = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT COUNT(done) FROM appointment WHERE provider_nic = ? && done = 0");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $new_patients = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT COUNT(done) FROM appointment WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $all_patients = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT COUNT(done) FROM appointment WHERE provider_nic = ? && done = 1");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $count_appointments = $result->fetch_assoc();
            //print_r($count_timeSlots);

                $stmt = $db->connection->prepare("SELECT MAX(doctor_time_slot.date),service_consumer.profile_picture,service_consumer.name,doctor_time_slot.date,service_consumer.mobile_number,service_consumer.address FROM doctor_time_slot INNER JOIN appointment ON appointment.appointment_id = doctor_time_slot.appointment_id INNER JOIN service_consumer ON service_consumer.consumer_nic = appointment.consumer_nic WHERE appointment.provider_nic = ? && appointment.done = 1 GROUP BY appointment.provider_nic");
                $stmt->bind_param("s", $nic);
                $stmt->execute();
                $result = $stmt->get_result();
                $patient_details = $result->fetch_assoc();

                //print_r($patient_details);

            return self::render(view: 'doctor-dashboard', layout: "doctor-dashboard-layout", params: [
                "doctor" => $doctor,"appointment_confirm"=>$appointment_confirm,"appointment_done"=>$appointment_done,"new_patients"=>$new_patients,"all_patients"=>$all_patients,"patient_details"=>$patient_details,"count_appointments"=>$count_appointments],
                layoutParams:[
                    "title" => "Dashboard",
                    "active_link" => "dashboard",
                    "doctor" => $doctor
                ]);

        }
    }

    public static function getConsumerDashboardPage(): array |bool|string{
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "consumer"){
            header("location: /login");
            return "";
        } else{
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();

            return self::render(view: 'consumer-dashboard', layout: 'consumer-dashboard-layout', layoutParams: [
                "consumer" => $consumer,
                "title" => "Dashboard",
                "active_link" => "dashboard"
            ]);
        }
    }
}