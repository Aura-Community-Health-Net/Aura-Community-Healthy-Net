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

            $stmt = $db->connection->prepare("SELECT COUNT(consumer_nic) AS order_count FROM product_order WHERE status = 'paid' AND provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $new_orders_count = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT COUNT(consumer_nic) AS all_order_count FROM product_order WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $all_orders_count = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT s.profile_picture, 
                   s.name AS consumer_name,  
                   p.name,
                   o.created_at
            FROM service_consumer s 
                INNER JOIN  product_order o ON s.consumer_nic = o.consumer_nic 
                INNER JOIN order_has_product ohp ON o.order_id = ohp.order_id 
                INNER JOIN product p on ohp.product_id = p.product_id 
            WHERE o.provider_nic = ? AND  o.status = 'paid' ORDER BY created_at DESC LIMIT 4");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $orders_list = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT s.profile_picture, 
                   s.name AS consumer_name, 
                   s.mobile_number, 
                   cg.category_name, 
                   p.name,
                   p.quantity,
                   p.quantity_unit,
                   p.image,
                   o.created_at
            FROM service_consumer s 
                INNER JOIN  product_order o ON s.consumer_nic = o.consumer_nic 
                INNER JOIN order_has_product ohp ON o.order_id = ohp.order_id 
                INNER JOIN product p on ohp.product_id = p.product_id 
                INNER JOIN product_category cg on p.category_id = cg.category_id 
            WHERE o.provider_nic = ? AND o.status = 'paid' ORDER BY created_at DESC LIMIT 1");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $order_preview = $result->fetch_assoc();

            return self::render(
            view: 'product-seller-dashboard', layout: "product-seller-dashboard-layout",
            params: [
                    "product_seller" => $product_seller,
                    "product_lists" => $product_lists,
                    "new_orders_count" => $new_orders_count,
                    "all_orders_count" => $all_orders_count,
                    "orders_list" => $orders_list,
                    "order_preview" => $order_preview
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
        if (!$nic || $providerType !== "pharmacy") {
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


//            $stmt = $db->connection->prepare("SELECT c.name,c.profile_picture,c.mobile_number FROM service_consumer c INNER JOIN pharmacy_request pr on c.consumer_nic = pr.consumer_nic where provider_nic = ?");
//            $stmt->bind_param("s",$nic);
//            $stmt->execute();
//            $result = $stmt->get_result();
//            $new_orders = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT COUNT(consumer_nic) AS order_count FROM medicine_order WHERE status = 'paid' AND provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $orders_count = $result->fetch_all(MYSQLI_ASSOC);



            $stmt = $db->connection->prepare("SELECT COUNT(consumer_nic) AS all_order_count FROM medicine_order WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $all_orders_count = $result->fetch_all(MYSQLI_ASSOC);


            $stmt = $db->connection->prepare("SELECT distinct(o.order_id), s.profile_picture, 
                   s.name AS consumer_name,  
                   s.mobile_number,
                   o.created_at
            FROM service_consumer s 
                INNER JOIN  medicine_order o ON s.consumer_nic = o.consumer_nic 
                INNER JOIN order_has_med ohm ON o.order_id = ohm.order_id 
            WHERE o.provider_nic = ? AND o.status = 'paid' ORDER BY created_at DESC LIMIT 4");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $medicines_orders_list = $result->fetch_all(MYSQLI_ASSOC);




            $stmt = $db->connection->prepare("SELECT s.profile_picture, 
                   s.name AS consumer_name, 
                   s.mobile_number,  
                   r.prescription,
                   o.created_at
            FROM service_consumer s 
                INNER JOIN  medicine_order o ON s.consumer_nic = o.consumer_nic 
                INNER JOIN order_has_med ohm ON o.order_id = ohm.order_id 
                INNER JOIN pharmacy_request r on s.consumer_nic = r.consumer_nic
            WHERE o.provider_nic = ? AND o.status = 'paid' ORDER BY created_at DESC LIMIT 1");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $order_preview = $result->fetch_assoc();





            return self::render(view: 'pharmacy-dashboard', layout: "pharmacy-dashboard-layout", params: [
                'pharmacy' => $pharmacy,
                'medicines' => $medicines_lists,
                'orders_counts' => $orders_count,
                'all_orders_count' => $all_orders_count,
                'medicines_orders_list' => $medicines_orders_list,
                'order_preview' => $order_preview
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

            $stmt = $db->connection->prepare("SELECT * FROM ride_request WHERE provider_nic =?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $date= $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT * FROM ride_request INNER JOIN service_consumer on service_consumer.consumer_nic = ride_request.consumer_nic INNER JOIN care_rider_time_slot on ride_request.request_id = care_rider_time_slot.request_id  WHERE ride_request.provider_nic = ? &&  ride_request.done = 0 ORDER BY care_rider_time_slot.date DESC limit 4 ");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $request_confirm = $result->fetch_all(MYSQLI_ASSOC);

            //print_r($request_confirm);die();

            $stmt = $db->connection->prepare("SELECT * FROM ride_request INNER JOIN service_consumer on service_consumer.consumer_nic = ride_request.consumer_nic WHERE ride_request.provider_nic = ? && ride_request.done = 1");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $request_done = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT COUNT(done) FROM ride_request WHERE provider_nic = ? && done = 0");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $new_request = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT COUNT(done) FROM ride_request WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $all_request = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT COUNT(done) FROM ride_request WHERE provider_nic = ? && done = 1");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $count_request = $result->fetch_assoc();
            //print_r($count_timeSlots);

            $stmt = $db->connection->prepare("SELECT MAX(care_rider_time_slot.date),service_consumer.profile_picture,service_consumer.name,care_rider_time_slot.date,service_consumer.mobile_number,service_consumer.address FROM care_rider_time_slot INNER JOIN ride_request ON ride_request.provider_nic = care_rider_time_slot.provider_nic  INNER JOIN service_consumer ON service_consumer.consumer_nic = ride_request.consumer_nic WHERE ride_request.provider_nic = ? && ride_request.done = 1 GROUP BY ride_request.provider_nic  ");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $request_details = $result->fetch_assoc();


            //print_r($patient_details);

            return self::render(view: 'care-rider-dashboard', layout: "care-rider-dashboard-layout",params: ["care_rider"=>$care_rider,"request_confirm"=>$request_confirm,"request_done"=>$request_done,"new_request"=>$new_request,"all_request"=>$all_request,"request_details"=>$request_details,"count_request"=>$count_request,"date"=>$date], layoutParams: [
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

            $stmt = $db->connection->prepare("SELECT * FROM appointment INNER JOIN service_consumer on service_consumer.consumer_nic = appointment.consumer_nic JOIN doctor_time_slot on doctor_time_slot.appointment_id = appointment.appointment_id WHERE appointment.provider_nic = ? &&  appointment.done = 0 ORDER BY doctor_time_slot.date DESC LIMIT 2;");
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

            $stmt = $db->connection->prepare("SELECT MAX(doctor_time_slot.date),service_consumer.profile_picture,service_consumer.name,doctor_time_slot.date,service_consumer.mobile_number,service_consumer.address FROM doctor_time_slot INNER JOIN appointment ON appointment.appointment_id = doctor_time_slot.appointment_id INNER JOIN service_consumer ON service_consumer.consumer_nic = appointment.consumer_nic WHERE appointment.provider_nic = ? && appointment.done = 1 GROUP BY appointment.provider_nic");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $patient_details = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT COUNT(done) FROM appointment WHERE provider_nic = ? && done = 1");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consulted_patients = $result->fetch_assoc();

                //print_r($consulted_patients);die();

            return self::render(view: 'doctor-dashboard', layout: "doctor-dashboard-layout", params: [
                "doctor" => $doctor,"appointment_confirm"=>$appointment_confirm,"appointment_done"=>$appointment_done,"new_patients"=>$new_patients,"all_patients"=>$all_patients,"patient_details"=>$patient_details,"consulted_patients"=>$consulted_patients],
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

            $stmt = $db->connection->prepare("SELECT s.profile_picture, s.name, s.mobile_number, s.provider_type, s.email_address, pr.date_time
                    FROM service_provider s
                    INNER JOIN payment_record pr on s.provider_nic = pr.provider_nic 
                    INNER JOIN service_consumer c on c.consumer_nic = pr.consumer_nic WHERE c.consumer_nic = ? LIMIT 4");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $services = $result->fetch_all(MYSQLI_ASSOC);
            return self::render(view: 'consumer-dashboard', layout: 'consumer-dashboard-layout', params: ["services" => $services],  layoutParams: [
                "consumer" => $consumer,
                "title" => "Dashboard",
                "active_link" => "dashboard"
            ]);
        }
    }

    public static function getUpcomingEvents(){

    }
}