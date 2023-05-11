<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;


class AnalyticsController extends Controller
{
    public static function getCareRiderAnalyticsPage(): array|bool|string
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

        return self::render(view: "care-rider-dashboard-analytics", layout: "care-rider-dashboard-layout", layoutParams: [
            "care_rider" => $careRider,
            "active_link" => "analytics",
            "title" => "Analytics"]);
    }

    public static function getDoctorAnalyticsPage(): array|bool|string
    {

        $provider_nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$provider_nic || $providerType !== "doctor") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $doctor = $result->fetch_assoc();
        }

        return self::render(view: 'doctor-dashboard-analytics', layout: "doctor-dashboard-layout", params: ["doctor" => $doctor
        ], layoutParams: [
            "title" => "Analytics",
            "active_link" => "analytics",
            "doctor" => $doctor
        ]);

    }


    public static function getDoctorAnalyticsRevenueChart(): array|bool|string
    {

        $provider_nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$provider_nic || $providerType !== "doctor") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $chart_time = $_GET['period'] ?? "all_time";

            $stmt = "";
            switch ($chart_time) {
                case "this_week";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    AND YEAR(date_time) = YEAR(NOW()) 
                                                    AND WEEK(date_time, 1) = WEEK(NOW(), 1)
                                                    GROUP BY DATE(date_time)");
                    break;

                case "this_month";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue 
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    AND YEAR(date_time) = YEAR(NOW()) 
                                                    AND MONTH(date_time) = MONTH(NOW())
                                                    GROUP BY DATE(date_time)");
                    break;

                case "past_six_months";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    AND date_time BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
                                                    GROUP BY DATE(date_time)");
                    break;

                case "this_year";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    AND YEAR(date_time) = YEAR(NOW()) 
                                                    GROUP BY DATE(date_time)");
                    break;

                case "all_time";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    GROUP BY DATE(date_time)");
                    break;
            }
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $records = $result->fetch_all(MYSQLI_ASSOC);
            header("Content-Type: application/json");
            return json_encode($records);
        }

    }

    public static function getDoctorAnalyticsAppointmentCount(): bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "doctor") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $chart_time = $_GET["period"] ?? "all_time";

            $stmt = "";
            switch ($chart_time) {
                case "this_week";
                    $stmt = $db->connection->prepare("SELECT DATE(doctor_time_slot.date) as date, COUNT(appointment.appointment_id) as appointment_count 
                FROM appointment INNER JOIN doctor_time_slot on appointment.appointment_id = doctor_time_slot.appointment_id WHERE doctor_time_slot.provider_nic = ? 
                AND YEAR(doctor_time_slot.date) = YEAR(NOW()) 
                AND WEEK(doctor_time_slot.date, 1) = WEEK(NOW(), 1)
                AND status != 'unpaid' 
                GROUP BY DATE(doctor_time_slot.date)");
                    break;

                case ("this_month");
                    $stmt = $db->connection->prepare("SELECT DATE(doctor_time_slot.date) as date, COUNT(appointment.appointment_id) as appointment_count 
                FROM appointment INNER JOIN doctor_time_slot on appointment.appointment_id = doctor_time_slot.appointment_id WHERE doctor_time_slot.provider_nic = ? 
                AND YEAR(doctor_time_slot.date) = YEAR(NOW()) 
                AND MONTH(doctor_time_slot.date) = MONTH(NOW())
                AND status != 'unpaid'
                GROUP BY DATE(doctor_time_slot.date)");
                    break;

                case ("past_six_months");
                    $stmt = $db->connection->prepare("SELECT DATE(doctor_time_slot.date) as date, COUNT(appointment.appointment_id) as appointment_count 
                FROM appointment INNER JOIN doctor_time_slot on appointment.appointment_id = doctor_time_slot.appointment_id WHERE doctor_time_slot.provider_nic = ? 
                AND doctor_time_slot.date BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
                AND status != 'unpaid'
                GROUP BY DATE(doctor_time_slot.date)");
                    break;

                case ("all_time");
                    $stmt = $db->connection->prepare("SELECT DATE(doctor_time_slot.date) as date, COUNT(appointment.appointment_id) as appointment_count 
                FROM appointment INNER JOIN doctor_time_slot on appointment.appointment_id = doctor_time_slot.appointment_id WHERE doctor_time_slot.provider_nic = ?  
                AND status != 'unpaid'
                GROUP BY DATE(doctor_time_slot.date)");
                    break;
            }

            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $appointment_records = $result->fetch_all(MYSQLI_ASSOC);
            header("Content-Type: application/json");
            return json_encode($appointment_records);

        }
    }


//     public function getProductSellerAnalyticsPage(): bool|array|string
//     {
//         $nic = $_SESSION["nic"];
//         $providerType = $_SESSION["user_type"];
//         if (!$nic || $providerType !== "product-seller") {
//             header("location: /provider-login");
//             return "";
//         } else {
//             $db = new Database();
//             $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
//             $stmt->bind_param("s", $nic);
//             $stmt->execute();
//             $result = $stmt->get_result();
//             $product_seller = $result->fetch_assoc();
//         }

//         return self::render(view: 'product-seller-dashboard-analytics', layout: "product-seller-dashboard-layout", layoutParams: [
//             "product_seller" => $product_seller,
//             "active_link" => "analytics",
//             "title" => "Analytics"
//         ]);
//

//RETRIVE PHARMACY ANALYTICS PAGE
    public static function getPharmacyAnalyticsPage(): array|bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];

        if (!$nic || $providerType !== "pharmacy") {
            header("/provider-login");
            return "";
        } else {

            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();
        }


        return self::render(view: 'pharmacy-dashboard-analytics', layout: "pharmacy-dashboard-layout", params: [], layoutParams: [
            "pharmacy" => $pharmacy,
            "title" => "Analytics",
            "active_link" => ""
        ]);
    }

    public static function getConsumerAnalyticsPage()
    {
        $nic = $_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if (!$nic || $userType !== "consumer") {
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

        return self::render(view: 'consumer-dashboard-analytics', layout: "consumer-dashboard-layout", layoutParams: [
            "consumer" => $consumer,
            "active_link" => "analytics",
            "title" => "Analytics"]);
    }

    public static function getProductSellerAnalyticsRevenueChart(): bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "product-seller") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $chart_time = $_GET["period"] ?? "all_time";

            $stmt = "";
            switch ($chart_time) {
                case "this_week";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    AND YEAR(date_time) = YEAR(NOW()) 
                                                    AND WEEK(date_time, 1) = WEEK(NOW(), 1)
                                                    GROUP BY DATE(date_time)");
                    break;

                case "this_month";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue 
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    AND YEAR(date_time) = YEAR(NOW()) 
                                                    AND MONTH(date_time) = MONTH(NOW())
                                                    GROUP BY DATE(date_time)");
                    break;

                case "past_six_months";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    AND date_time BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
                                                    GROUP BY DATE(date_time)");
                    break;

                case "this_year";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    AND YEAR(date_time) = YEAR(NOW()) 
                                                    GROUP BY DATE(date_time)");
                    break;

                case "all_time";
                    $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record 
                                                    WHERE provider_nic = ? 
                                                    GROUP BY DATE(date_time)");
                    break;
            }
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $records = $result->fetch_all(MYSQLI_ASSOC);
            header("Content-Type: application/json");
            return json_encode($records);
        }

    }

    public static function getProductSellerAnalyticsOrderCount(): bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "product-seller") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $chart_time = $_GET["period"] ?? "all_time";

            $stmt = "";
            switch ($chart_time) {
                case "this_week";
                    $stmt = $db->connection->prepare("SELECT DATE(created_at) as date, COUNT(order_id) as order_count 
                FROM product_order WHERE provider_nic = ? 
                AND YEAR(created_at) = YEAR(NOW()) 
                AND WEEK(created_at, 1) = WEEK(NOW(), 1)
                AND status != 'unpaid' 
                GROUP BY DATE(created_at)");
                    break;

                case ("this_month");
                    $stmt = $db->connection->prepare("SELECT DATE(created_at) as date, COUNT(order_id) as order_count 
                FROM product_order WHERE provider_nic = ? 
                AND YEAR(created_at) = YEAR(NOW()) 
                AND MONTH(created_at) = MONTH(NOW())
                AND status != 'unpaid'
                GROUP BY DATE(created_at)");
                    break;

                case ("past_six_months");
                    $stmt = $db->connection->prepare("SELECT DATE(created_at) as date, COUNT(order_id) as order_count 
                FROM product_order WHERE provider_nic = ? 
                AND created_at BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
                AND status != 'unpaid'
                GROUP BY DATE(created_at)");
                    break;

                case ("all_time");
                    $stmt = $db->connection->prepare("SELECT DATE(created_at) as date, COUNT(order_id) as order_count 
                FROM product_order WHERE provider_nic = ? 
                AND status != 'unpaid'
                GROUP BY DATE(created_at)");
                    break;
            }

            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $order_records = $result->fetch_all(MYSQLI_ASSOC);
            header("Content-Type: application/json");
            return json_encode($order_records);

        }
    }

    public static function getProductSellerRevenueVsProductPercentage(): bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "product-seller") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $chart_time = $_GET["period"] ?? "all_time";

            $stmt = "";
            switch ($chart_time) {
                case "this_week";
                    $stmt = $db->connection->prepare("SELECT p.name AS product_name, SUM(op.price_at_order * op.num_of_items) AS revenue
                    FROM order_has_product op
                    JOIN product_order o ON op.order_id = o.order_id
                    JOIN product p ON op.product_id = p.product_id
                    WHERE o.status != 'unpaid'
                      AND o.provider_nic = ?
                    AND YEAR(created_at) = YEAR(NOW()) 
                    AND WEEK(created_at, 1) = WEEK(NOW(), 1)
                    GROUP BY op.product_id
                    ORDER BY revenue DESC
                    LIMIT 10;");
                    break;

                case "this_month";
                    $stmt = $db->connection->prepare("SELECT p.name AS product_name, SUM(op.price_at_order * op.num_of_items) AS revenue
                    FROM order_has_product op
                    JOIN product_order o ON op.order_id = o.order_id
                    JOIN product p ON op.product_id = p.product_id
                    WHERE o.status != 'unpaid'
                      AND o.provider_nic = ?
                    AND YEAR(created_at) = YEAR(NOW()) 
                    AND MONTH(created_at) = MONTH(NOW())
                    GROUP BY op.product_id
                    ORDER BY revenue DESC
                    LIMIT 10;");
                    break;

                case "past_six_months";
                    $stmt = $db->connection->prepare("SELECT p.name AS product_name, SUM(op.price_at_order * op.num_of_items) AS revenue
                    FROM order_has_product op
                    JOIN product_order o ON op.order_id = o.order_id
                    JOIN product p ON op.product_id = p.product_id
                    WHERE o.status != 'unpaid'
                      AND o.provider_nic = ?
                    AND created_at BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
                    GROUP BY op.product_id
                    ORDER BY revenue DESC
                    LIMIT 10;");
                    break;

                case "all_time";
                    $stmt = $db->connection->prepare("SELECT p.name AS product_name, SUM(op.price_at_order * op.num_of_items) AS revenue
                    FROM order_has_product op
                    JOIN product_order o ON op.order_id = o.order_id
                    JOIN product p ON op.product_id = p.product_id
                    WHERE o.status != 'unpaid'
                    AND o.provider_nic = ?
                    GROUP BY op.product_id
                    ORDER BY revenue DESC
                    LIMIT 10;");
                    break;
            }

            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $product_records = $result->fetch_all(MYSQLI_ASSOC);
            header("Content-Type: application/json");
            return json_encode($product_records);
        }
    }

    //REVENUE CHART FOR THE PHARMACY(ANALYTICS)

    public static function getPharmacyAnalyticsRevenueChart(): bool|string
    {


        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "pharmacy") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $chart_time = $_GET["period"] ?? "all_time";


            $stmt = "";
            switch ($chart_time) {
                case "this_week";
                    $stmt = $db->connection->prepare("SELECT DATE(p.date_time) as date, SUM(r.total_amount) as revenue
                                                    FROM payment_record p INNER JOIN pharmacy_request r ON p.provider_nic = r.provider_nic 
                                                    WHERE p.provider_nic = ?  
                                                    AND YEAR(p.date_time) = YEAR(NOW()) 
                                                    AND WEEK(p.date_time, 1) = WEEK(NOW(), 1)
                                                    GROUP BY DATE(p.date_time)");
                    break;

                case "this_month";
                    $stmt = $db->connection->prepare("SELECT DATE(p.date_time) as date, SUM(r.total_amount) as revenue 
                                                    FROM payment_record p INNER JOIN pharmacy_request r ON p.provider_nic=r.provider_nic
                                                    WHERE p.provider_nic = ?    
                                                    AND YEAR(p.date_time) = YEAR(NOW()) 
                                                    AND MONTH(p.date_time) = MONTH(NOW())
                                                    GROUP BY DATE(p.date_time)");
                    break;

                case "past_six_months";
                    $stmt = $db->connection->prepare("SELECT DATE(p.date_time) as date, SUM(r.total_amount) as revenue
                                                    FROM payment_record p INNER JOIN pharmacy_request r ON p.provider_nic=r.provider_nic  
                                                    WHERE p.provider_nic = ?  
                                                    AND p.date_time BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
                                                    GROUP BY DATE(p.date_time)");
                    break;

                case "this_year";
                    $stmt = $db->connection->prepare("SELECT DATE(p.date_time) as date, SUM(r.total_amount) as revenue
                                                    FROM payment_record p INNER JOIN pharmacy_request r ON p.provider_nic=r.provider_nic 
                                                    WHERE p.provider_nic = ?
                                                    AND YEAR(p.date_time) = YEAR(NOW()) 
                                                    GROUP BY DATE(p.date_time)");
                    break;

                case "all_time";
                    $stmt = $db->connection->prepare("SELECT DATE(p.date_time) as date, SUM(r.total_amount) as revenue
                                                    FROM payment_record p INNER JOIN pharmacy_request r ON p.provider_nic=r.provider_nic
                                                    WHERE p.provider_nic = ? 
                                                    GROUP BY DATE(p.date_time)");
                    break;
            }
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $records = $result->fetch_all(MYSQLI_ASSOC);


            header("Content-Type: application/json");
            return json_encode($records);
        }


    }

    //ORDER COUNT CHART FOR PHARMACY(ANALYTICS)

    public static function getPharmacyAnalyticsOrderCount(): bool|string
    {

        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "pharmacy") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $chart_time = $_GET["period"] ?? "all_time";

            $stmt = "";
            switch ($chart_time) {
                case "this_week";
                    $stmt = $db->connection->prepare("SELECT DATE(created_at) as date, COUNT(order_id) as order_count 
                FROM medicine_order WHERE provider_nic = ? 
                AND YEAR(created_at) = YEAR(NOW()) 
                AND WEEK(created_at, 1) = WEEK(NOW(), 1)
                AND status != 'unpaid' 
                GROUP BY DATE(created_at)");
                    break;

                case ("this_month");
                    $stmt = $db->connection->prepare("SELECT DATE(created_at) as date, COUNT(order_id) as order_count 
                FROM medicine_order WHERE provider_nic = ? 
                AND YEAR(created_at) = YEAR(NOW()) 
                AND MONTH(created_at) = MONTH(NOW())
                AND status != 'unpaid'
                GROUP BY DATE(created_at)");
                    break;

                case ("past_six_months");
                    $stmt = $db->connection->prepare("SELECT DATE(created_at) as date, COUNT(order_id) as order_count 
                FROM medicine_order WHERE provider_nic = ? 
                AND created_at BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
                AND status != 'unpaid'
                GROUP BY DATE(created_at)");
                    break;

                case ("all_time");
                    $stmt = $db->connection->prepare("SELECT DATE(created_at) as date, COUNT(order_id) as order_count 
                FROM medicine_order WHERE provider_nic = ? 
                AND status != 'unpaid'
                GROUP BY DATE(created_at)");
                    break;
            }

            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $order_records = $result->fetch_all(MYSQLI_ASSOC);
            header("Content-Type: application/json");
            return json_encode($order_records);

        }
    }

//public static function getPharmacyRevenueVsMedicinePercentage(): bool|string


//{

//     public static function getPharmacyRevenueVsMedicinePercentage(): bool|string


//     {

//    $nic = $_SESSION["nic"];
//    $providerType = $_SESSION["user_type"];
//    if (!$nic || $providerType !== "pharmacy") {
//        header("location: /provider-login");
//        return "";
//    } else{
//        $db = new Database();
//        $chart_time = $_GET["period"] ?? "all_time";
//
//        $stmt = "";
//        switch ($chart_time){
//            case "this_week";
//                $stmt = $db->connection->prepare("SELECT m.name AS medicine_name, SUM(r.total_amount) AS revenue
//                    FROM order_has_med om
//                    JOIN medicine_order o ON om.order_id = o.order_id
//                    JOIN medicine m ON m.med_id = om.med_id
//                    JOIN pharmacy_request r ON
//                    WHERE o.status != 'unpaid'
//                      AND o.provider_nic = ?
//                    AND YEAR(created_at) = YEAR(NOW())
//                    AND WEEK(created_at, 1) = WEEK(NOW(), 1)
//                    GROUP BY op.product_id
//                    ORDER BY revenue DESC
//                    LIMIT 10;");
//                break;

//            case "this_month";
//                $stmt = $db->connection->prepare("SELECT p.name AS product_name, SUM(op.price_at_order * op.num_of_items) AS revenue
//                    FROM order_has_product op
//                    JOIN product_order o ON op.order_id = o.order_id
//                    JOIN product p ON op.product_id = p.product_id
//                    WHERE o.status != 'unpaid'
//                      AND o.provider_nic = ?
//                    AND YEAR(created_at) = YEAR(NOW())
//                    AND MONTH(created_at) = MONTH(NOW())
//                    GROUP BY op.product_id
//                    ORDER BY revenue DESC
//                    LIMIT 10;");
//                break;
//
//            case "past_six_months";
//                $stmt = $db->connection->prepare("SELECT p.name AS product_name, SUM(op.price_at_order * op.num_of_items) AS revenue
//                    FROM order_has_product op
//                    JOIN product_order o ON op.order_id = o.order_id
//                    JOIN product p ON op.product_id = p.product_id
//                    WHERE o.status != 'unpaid'
//                      AND o.provider_nic = ?
//                    AND created_at BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
//                    GROUP BY op.product_id
//                    ORDER BY revenue DESC
//                    LIMIT 10;");
//                break;
//
//            case "all_time";
//                $stmt = $db->connection->prepare("SELECT p.name AS product_name, SUM(op.price_at_order * op.num_of_items) AS revenue
//                    FROM order_has_product op
//                    JOIN product_order o ON op.order_id = o.order_id
//                    JOIN product p ON op.product_id = p.product_id
//                    WHERE o.status != 'unpaid'
//                    AND o.provider_nic = ?
//                    GROUP BY op.product_id
//                    ORDER BY revenue DESC
//                    LIMIT 10;");
//                break;
//        }
//
//        $stmt->bind_param("s", $nic);
//        $stmt->execute();
//        $result = $stmt->get_result();
//        $product_records = $result->fetch_all(MYSQLI_ASSOC);
//        header("Content-Type: application/json");
//        return json_encode($product_records);
//    }

//}


//     }


    public static function getCareRiderAnalyticsRevenueChart()
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "care-rider") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $chart_time = $_GET["period"] ?? "all_time";

            $stmt = "";
            switch ($chart_time) {
                case "this_week":
                    $stmt = $db->connection->prepare("SELECT DATE(care_rider_time_slot.date) AS date, SUM(ride.cost)/100 AS revenue 
                                                 FROM ride 
                                                 INNER JOIN care_rider_time_slot ON ride.request_id = care_rider_time_slot.request_id 
                                                 WHERE ride.provider_nic = ? 
                                                 AND YEAR(care_rider_time_slot.date) = YEAR(NOW()) 
                                                 AND WEEK(care_rider_time_slot.date, 1) = WEEK(NOW(), 1)
                                                 GROUP BY DATE(care_rider_time_slot.date)");
                    break;

                case "this_month":
                    $stmt = $db->connection->prepare("SELECT DATE(care_rider_time_slot.date) AS date, SUM(ride.cost)/100 AS revenue 
                                                 FROM ride 
                                                 INNER JOIN care_rider_time_slot ON ride.request_id = care_rider_time_slot.request_id 
                                                 WHERE ride.provider_nic = ? 
                                                 AND YEAR(care_rider_time_slot.date) = YEAR(NOW()) 
                                                 AND MONTH(care_rider_time_slot.date) = MONTH(NOW())
                                                 GROUP BY DATE(care_rider_time_slot.date)");
                    break;

                case "past_six_months":
                    $stmt = $db->connection->prepare("SELECT DATE(care_rider_time_slot.date) AS date, SUM(ride.cost)/100 AS revenue 
                                                 FROM ride 
                                                 INNER JOIN care_rider_time_slot ON ride.request_id = care_rider_time_slot.request_id 
                                                 WHERE ride.provider_nic = ? 
                                                 AND care_rider_time_slot.date BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
                                                 GROUP BY DATE(care_rider_time_slot.date)");
                    break;

                case "this_year":
                    $stmt = $db->connection->prepare("SELECT DATE(care_rider_time_slot.date) AS date, SUM(ride.cost)/100 AS revenue 
                                                 FROM ride 
                                                 INNER JOIN care_rider_time_slot ON ride.request_id = care_rider_time_slot.request_id 
                                                 WHERE ride.provider_nic = ? 
                                                 AND YEAR(care_rider_time_slot.date) = YEAR(NOW()) 
                                                 GROUP BY DATE(care_rider_time_slot.date)");
                    break;

                case "all_time":
                    $stmt = $db->connection->prepare("SELECT DATE(care_rider_time_slot.date) AS date, SUM(ride.cost)/100 AS revenue 
                                                 FROM ride 
                                                 INNER JOIN care_rider_time_slot ON ride.request_id = care_rider_time_slot.request_id 
                                                 WHERE ride.provider_nic = ? 
                                                 GROUP BY DATE(care_rider_time_slot.date)");
                    break;
            }

            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $records = $result->fetch_all(MYSQLI_ASSOC);

            header("Content-Type: application/json");
            return json_encode($records);
        }
    }

    public static function getCareRiderAnalyticsRequestCountChart(): bool|string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if (!$nic || $providerType !== "care-rider") {
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $chart_time = $_GET["period"] ?? "all_time";

            $stmt = "";
            switch ($chart_time) {
                case "this_week";
                    $stmt = $db->connection->prepare("SELECT DATE(crts.date) as date, COUNT(ride_request.request_id) as request_count 
                FROM ride_request INNER JOIN care_rider_time_slot crts on ride_request.request_id = crts.request_id WHERE crts.provider_nic = ? 
                AND YEAR(crts.date) = YEAR(NOW()) 
                AND WEEK(crts.date, 1) = WEEK(NOW(), 1)
                GROUP BY DATE(crts.date)");
                    break;

                case ("this_month");
                    $stmt = $db->connection->prepare("SELECT DATE(crts.date) as date, COUNT(ride_request.request_id) as request_count 
                FROM ride_request INNER JOIN care_rider_time_slot crts on ride_request.request_id = crts.request_id WHERE crts.provider_nic = ? 
                AND YEAR(crts.date) = YEAR(NOW()) 
                AND MONTH(crts.date) = MONTH(NOW())
                GROUP BY DATE(crts.date)");
                    break;

                case ("past_six_months");
                    $stmt = $db->connection->prepare("SELECT DATE(crts.date) as date, COUNT(ride_request.request_id) as request_count 
                 FROM ride_request INNER JOIN care_rider_time_slot crts on ride_request.request_id = crts.request_id WHERE crts.provider_nic = ? 
                AND crts.date BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
                GROUP BY DATE(crts.date)");
                    break;

                case ("all_time");
                    $stmt = $db->connection->prepare("SELECT DATE(crts.date) as date, COUNT(ride_request.request_id) as request_count 
                 FROM ride_request INNER JOIN care_rider_time_slot crts on ride_request.request_id = crts.request_id WHERE crts.provider_nic = ? 
                GROUP BY DATE(crts.date)");
                    break;
            }

            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $request_records = $result->fetch_all(MYSQLI_ASSOC);
            header("Content-Type: application/json");
            return json_encode($request_records);
            print_r($request_records);
            die();
        }
    }

    public function getProductSellerAnalyticsPage(): bool|array|string
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
        }

        return self::render(view: 'product-seller-dashboard-analytics', layout: "product-seller-dashboard-layout", layoutParams: [
            "product_seller" => $product_seller,
            "active_link" => "analytics",
            "title" => "Analytics"
        ]);
    }


}