<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class AdministratorController extends Controller
{
    public static function getNewRegistrationPage(): array|bool|string
    {
        $db = new Database();
        $is_admin = $_SESSION["is_admin"];

        if ($is_admin) {
            $provider_type = $_GET["provider_type"] ?? "doctor";    //show all the doctors who are not verified yet
            if ($provider_type == "doctor") {
                $sql = "SELECT * FROM service_provider INNER JOIN doctor d on service_provider.provider_nic = d.provider_nic WHERE is_verified = 0";
                $result = $db->connection->query(query: $sql);
                $new_registrations = $result->fetch_all(MYSQLI_ASSOC);
                $doc_details_list = [];

                foreach ($new_registrations as $row) {
                    $stmt = $db->connection->prepare("SELECT * FROM doc_qualifications WHERE provider_nic = ?");
                    $stmt->bind_param("s", $row["provider_nic"]);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $qualifications = $result->fetch_all(MYSQLI_ASSOC);

                    $doc_details = [
                        "personal" => $row,
                        "qualifications" => []
                    ];
                    foreach ($qualifications as $qualification) {
                        $doc_details["qualifications"][] = $qualification["qualifications"];
                    }
                    $doc_details_list[] = $doc_details;
                }

                return self::render(view: 'admin-view-new-registrations', layout: "admin-dashboard-layout", params: [
                    "new_registrations" => $doc_details_list
                ], layoutParams: [
                    "title" => "New Registrations",
                    "admin" => [
                        "name" => "Randima Dias"
                    ],
                    "active_link" => "new-registrations"
                ]);
                //retrieve the all pharmacies which are not verified yet
            } elseif ($provider_type == "pharmacy") {
                $sql = "SELECT * FROM service_provider INNER JOIN pharmacy p on service_provider.provider_nic = p.provider_nic WHERE is_verified = 0";

                //retrieve the all product sellers which are not verified yet
            } elseif ($provider_type == "product-seller") {
                $sql = "SELECT * FROM service_provider INNER JOIN `healthy_food/natural_medicine_provider` `hf/nmp` on service_provider.provider_nic = `hf/nmp`.provider_nic WHERE  is_verified = 0";

                //retrieve the all product sellers which are not verified yet
            } elseif ($provider_type == "care-rider") {
                $sql = "SELECT * FROM service_provider INNER JOIN care_rider cr on service_provider.provider_nic = cr.provider_nic INNER JOIN vehicle v on cr.provider_nic = v.provider_nic  WHERE is_verified = 0";
            }
            $result = $db->connection->query(query: $sql);
            $new_registrations = [];

            while ($row = $result->fetch_assoc()) {
                $new_registrations[] = $row;
            }


            return self::render(view: 'admin-view-new-registrations', layout: "admin-dashboard-layout", params: [
                "new_registrations" => $new_registrations
            ], layoutParams: [
                "title" => "New Registrations",
                "admin" => [
                    "name" => "Randima Dias"
                ],
                "active_link" => "new-registrations"
            ]);
        }

        header("location: /admin-login");
        return "";
    }

    public static function getAdministratorDashboardPage(): bool|array|string
    {
        $db = new Database();
        $is_admin = $_SESSION["is_admin"];

        //if the administrator credentials incorrect redirected to the administrator login page
        if (!$is_admin) {
            header("location: /administrator-login");
            return "";
        }

        //get new registrations count of pharmacies
        $stmt = $db->connection->prepare("SELECT COUNT(provider_nic)AS provider_count FROM service_provider s  WHERE s.is_verified = 0 AND s.provider_type='pharmacy'");
        $stmt->execute();
        $result = $stmt->get_result();
        $pharmacist_count = $result->fetch_all(MYSQLI_ASSOC);

        //get new registrations count of product sellers
        $stmt = $db->connection->prepare("SELECT COUNT(provider_nic) AS provider_count FROM service_provider s  WHERE s.is_verified = 0 AND s.provider_type='product-seller'");
        $stmt->execute();
        $result = $stmt->get_result();
        $product_seller_count = $result->fetch_all(MYSQLI_ASSOC);

        //get new registrations count of doctors
        $stmt = $db->connection->prepare("SELECT COUNT(provider_nic) AS provider_count FROM service_provider s  WHERE s.is_verified = 0 AND s.provider_type='doctor'");
        $stmt->execute();
        $result = $stmt->get_result();
        $doctor_count = $result->fetch_all(MYSQLI_ASSOC);

        //get new registrations count of care riders
        $stmt = $db->connection->prepare("SELECT COUNT(provider_nic) AS provider_count FROM service_provider s  WHERE s.is_verified = 0 AND s.provider_type='care-rider'");
        $stmt->execute();
        $result = $stmt->get_result();
        $care_rider_count = $result->fetch_all(MYSQLI_ASSOC);

        //get the due payments for the providers for current month
        $stmt = $db->connection->prepare("SELECT s.profile_picture, s.provider_nic, s.name, sum(pr.amount)/100 AS amount, s.provider_type FROM service_provider s 
        INNER JOIN payment_record pr on s.provider_nic = pr.provider_nic WHERE YEAR(date_time) = YEAR(CURRENT_TIMESTAMP) AND MONTH(date_time) = MONTH(CURRENT_TIMESTAMP) GROUP BY s.provider_nic ORDER BY amount DESC LIMIT 4");
        $stmt->execute();
        $result = $stmt->get_result();
        $due_payments = $result->fetch_all(MYSQLI_ASSOC);

        //get the registered doctors
        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_type = 'doctor' AND is_verified = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $reg_doctors = $result->fetch_all(MYSQLI_ASSOC);

        //get the registered pharmacies
        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_type = 'pharmacy' AND is_verified = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $reg_pharmacies = $result->fetch_all(MYSQLI_ASSOC);

        //get the registered product sellers
        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_type = 'product-seller' AND is_verified = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $reg_sellers = $result->fetch_all(MYSQLI_ASSOC);

        //get the registered care riders
        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_type = 'care-rider' AND is_verified = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $reg_riders = $result->fetch_all(MYSQLI_ASSOC);

        //get the service consumers
        $stmt = $db->connection->prepare("SELECT * FROM service_consumer");
        $stmt->execute();
        $result = $stmt->get_result();
        $all_consumers = $result->fetch_all(MYSQLI_ASSOC);

        return self::render(view: 'administrator-dashboard', layout: "admin-dashboard-layout", params: [
            "pharmacies" => $pharmacist_count,
            "product_sellers" => $product_seller_count,
            "doctors" => $doctor_count,
            "care_riders"=>$care_rider_count,
            "due_payments"=>$due_payments,
            "reg_doctors"=>$reg_doctors,
            "reg_pharmacies"=>$reg_pharmacies,
            "reg_sellers"=>$reg_sellers,
            "reg_riders"=>$reg_riders,
            "all_consumers"=>$all_consumers
        ], layoutParams: [
            "title" => "Dashboard",
            "admin" => [
                "name" => "Randima Dias"
            ],
            "active_link" => "dashboard"
        ]);
    }

    public static function getAdministratorUsersPage(): bool|array|string
    {
        $db = new Database();
        $is_admin = $_SESSION["is_admin"];


        if (!$is_admin){
            header("location: /administrator-login");
            return "";
        } else {
//            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE is_verified = 1");
//            $stmt->execute();
//            $result = $stmt->get_result();
//            $providers = $result->fetch_all(MYSQLI_ASSOC);


            //filter all the service providers
            $provider_type = $_GET["provider_type"] ?? "all";

            if($provider_type === "all") {
                $sql = "SELECT * FROM service_provider";
            }

            //filter all the doctors
            if ($provider_type === "doctor"){
                $sql = "SELECT * FROM service_provider WHERE provider_type = 'doctor'";

                //filter all the pharmacies
            } else if ($provider_type === "pharmacy"){
                $sql = "SELECT * FROM service_provider WHERE provider_type = 'pharmacy'";

                //filter all the product sellers
            } else if ($provider_type === "product-seller"){
                $sql = "SELECT * FROM service_provider WHERE provider_type = 'product-seller'";
            } else if ($provider_type === "care-rider"){

                //filter all the scare riders
                $sql = "SELECT * FROM service_provider WHERE provider_type = 'care-rider'";
            }

            $result = $db->connection->query(query: $sql);
            $providers = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT * FROM service_consumer");
            $stmt->execute();
            $result = $stmt->get_result();
            $consumers = $result->fetch_all(MYSQLI_ASSOC);

            return self::render(view: 'administrator-dashboard-users', layout: "admin-dashboard-layout", params: [
                "providers"=>$providers,
                "consumers"=>$consumers,
                "provider_type"=>$provider_type
            ], layoutParams: [
                "title" => "Users",
                "admin" => [
                    "name" => "Randima Dias"
                ],
                "active_link" => "users"
            ]);
        }
    }

//    public static function updateConsumerByAdmin(): string
//    {
//        $db = new Database();
//        $is_admin = $_SESSION["is_admin"];
//
//        $consumer_nic = $_POST["nic"];
//        $email_address = $_POST["email"];
//        $mobile_number = $_POST["mobile_number"];
//        $address = $_POST["address"];
//        var_dump($consumer_nic, $email_address, $mobile_number, $address);
//
//        if (!$is_admin){
//            header("location: /administrator-login");
//            return "";
//        } else {
//            $stmt = $db->connection->prepare("UPDATE service_consumer SET consumer_nic = ?,
//                              email_address = ?,
//                              address = ?,
//                              mobile_number = ?
//                        WHERE consumer_nic = ?");
//            $stmt->bind_param("sssss", $consumer_nic, $email_address, $mobile_number, $address,$nic);
//            $result = $stmt->get_result();
//            header("location: /admin-dashboard/users");
//            return "";
//        }
//    }

    public static function getAdministratorDuePaymentsPage(): bool|array|string
    {
        $db = new Database();
        $is_admin = $_SESSION["is_admin"];

        if (!$is_admin) {
            header("location: /administrator-login");
            return "";
        } else{
            //get the due payments of service providers for the current month
            $stmt = $db->connection->prepare("SELECT s.profile_picture, sum(p.amount)/100 AS amount, p.purpose, s.name, s.provider_type, s.bank_account_number, s.provider_nic FROM payment_record p INNER JOIN service_provider s ON p.provider_nic = s.provider_nic WHERE YEAR(date_time) = YEAR(CURRENT_TIMESTAMP) AND MONTH(date_time) = MONTH(CURRENT_TIMESTAMP) GROUP BY s.provider_nic ORDER BY amount DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            $payments = $result->fetch_all(MYSQLI_ASSOC);

            return self::render(view: 'administrator-dashboard-due-payments', layout: "admin-dashboard-layout", params: [
                'payments' => $payments
            ], layoutParams: [
                "title" => "Due Payments",
                "admin" => [
                    "name" => "Randima Dias"
                ],
                "active_link" => "payments"
            ]);
        }
    }

    public static function getAdministratorAnalyticsPage(): bool|array|string
    {
        $is_admin = $_SESSION["is_admin"];
        if (!$is_admin) {
            header("location: /administrator-login");
            return "";
        }

        return self::render(view: 'administrator-dashboard-analytics', layout: "admin-dashboard-layout", params: [],
        layoutParams: [
            "title" => "Analytics",
                "admin" => [
                    "name" => "Randima Dias"
            ], "active_link" => "analytics"
        ]);
    }

    public static function getAdministratorProductSellersRevenueChart(): bool|string  //get product sellers revenue chart
    {
        $db = new Database();
        $chart_time = $_GET["period"] ?? "all_time";

        $stmt = "";
        $db = new Database();
        $chart_time = $_GET["period"] ?? "all_time";

        $stmt = "";
        switch ($chart_time) {
            case "this_week";
            //get the revenues for current week of all product sellers
                $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record INNER JOIN service_provider s ON payment_record.provider_nic = s.provider_nic 
                                                    WHERE s.provider_type = 'product-seller' AND YEAR(date_time) = YEAR(NOW()) 
                                                    AND WEEK(date_time, 1) = WEEK(NOW(), 1)
                                                    GROUP BY DATE(date_time)");
                break;

            case "this_month";
                //get the revenues for current month of all product sellers
                $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue 
                                                    FROM payment_record INNER JOIN service_provider s ON payment_record.provider_nic = s.provider_nic
                                                    WHERE s.provider_type = 'product-seller' AND YEAR(date_time) = YEAR(NOW()) 
                                                    AND MONTH(date_time) = MONTH(NOW())
                                                    GROUP BY DATE(date_time)");
                break;

            case "past_six_months";
                //get the revenues for past six months of all product sellers
                $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record INNER JOIN service_provider s ON payment_record.provider_nic = s.provider_nic 
                                                    WHERE s.provider_type = 'product-seller' AND YEAR(date_time) = YEAR(NOW()) 
                                                    GROUP BY DATE(date_time)");
                break;

            case "all_time";
                //get the revenues for all dates of all product sellers
                $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record  INNER JOIN service_provider s ON payment_record.provider_nic = s.provider_nic 
                                                    WHERE s.provider_type = 'product-seller'
                                                    GROUP BY DATE(date_time)");
                break;
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        header("Content-Type: application/json");
        return json_encode($data);
    }

//getAdministratorCareRiderRevenueChart

    public static function getAdministratorCareRiderRevenueChart(): bool|string
    {
        $db = new Database();
        $chart_time = $_GET["period"] ?? "all_time";

        $stmt = "";
        switch ($chart_time) {
            case "this_week":
                $stmt = $db->connection->prepare("SELECT DATE(care_rider_time_slot.date) AS date, SUM(ride.cost) AS revenue 
                                                 FROM ride 
                                                 INNER JOIN care_rider_time_slot ON ride.request_id = care_rider_time_slot.request_id 
                                                 AND YEAR(care_rider_time_slot.date) = YEAR(NOW()) 
                                                 AND WEEK(care_rider_time_slot.date, 1) = WEEK(NOW(), 1)
                                                 GROUP BY DATE(care_rider_time_slot.date)");
                break;

            case "this_month":
                $stmt = $db->connection->prepare("SELECT DATE(care_rider_time_slot.date) AS date, SUM(ride.cost) AS revenue 
                                                 FROM ride 
                                                 INNER JOIN care_rider_time_slot ON ride.request_id = care_rider_time_slot.request_id 
                                                 AND YEAR(care_rider_time_slot.date) = YEAR(NOW()) 
                                                 AND MONTH(care_rider_time_slot.date) = MONTH(NOW())
                                                 GROUP BY DATE(care_rider_time_slot.date)");
                break;

            case "past_six_months":
                $stmt = $db->connection->prepare("SELECT DATE(care_rider_time_slot.date) AS date, SUM(ride.cost) AS revenue 
                                                 FROM ride 
                                                 INNER JOIN care_rider_time_slot ON ride.request_id = care_rider_time_slot.request_id 
                                                 AND care_rider_time_slot.date BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
                                                 GROUP BY DATE(care_rider_time_slot.date)");
                break;

            case "this_year":
                $stmt = $db->connection->prepare("SELECT DATE(care_rider_time_slot.date) AS date, SUM(ride.cost) AS revenue 
                                                 FROM ride 
                                                 INNER JOIN care_rider_time_slot ON ride.request_id = care_rider_time_slot.request_id 
                                                 AND YEAR(care_rider_time_slot.date) = YEAR(NOW()) 
                                                 GROUP BY DATE(care_rider_time_slot.date)");
                break;

            case "all_time":
                $stmt = $db->connection->prepare("SELECT DATE(care_rider_time_slot.date) AS date, SUM(ride.cost) AS revenue 
                                                 FROM ride 
                                                 INNER JOIN care_rider_time_slot ON ride.request_id = care_rider_time_slot.request_id 
                                                 GROUP BY DATE(care_rider_time_slot.date)");
                break;

        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        header("Content-Type: application/json");
        return json_encode($data);
    }

    public static function getAdministratorPharmacyRevenueChart(): bool|string

    {

        $db = new Database();
        $chart_time = $_GET["period"] ?? "all_time";

        $stmt = "";
        $db = new Database();
        $chart_time = $_GET["period"] ?? "all_time";

        $stmt = "";
            switch ($chart_time) {
                case "this_week";
                    $stmt = $db->connection->prepare("SELECT DATE(p.date_time) as date, SUM(r.total_amount) as revenue
                                                    FROM payment_record p INNER JOIN pharmacy_request r ON p.provider_nic = r.provider_nic
                                                    INNER JOIN service_provider s ON s.provider_nic = p.provider_nic                                                   
                                                    WHERE s.provider_type = 'pharmacy'  
                                                    AND YEAR(p.date_time) = YEAR(NOW()) 
                                                    AND WEEK(p.date_time, 1) = WEEK(NOW(), 1)
                                                    GROUP BY DATE(p.date_time)");
                    break;

                case "this_month";
                    $stmt = $db->connection->prepare("SELECT DATE(p.date_time) as date, SUM(r.total_amount) as revenue 
                                                    FROM payment_record p INNER JOIN pharmacy_request r ON p.provider_nic=r.provider_nic
                                                    INNER JOIN service_provider s ON s.provider_nic = p.provider_nic                                                   
                                                    WHERE s.provider_type = 'pharmacy'   
                                                    AND YEAR(p.date_time) = YEAR(NOW()) 
                                                    AND MONTH(p.date_time) = MONTH(NOW())
                                                    GROUP BY DATE(p.date_time)");
                    break;

                case "past_six_months";
                    $stmt = $db->connection->prepare("SELECT DATE(p.date_time) as date, SUM(r.total_amount) as revenue
                                                    FROM payment_record p INNER JOIN pharmacy_request r ON p.provider_nic=r.provider_nic
                                                    INNER JOIN service_provider s ON s.provider_nic = p.provider_nic                                                   
                                                    WHERE s.provider_type = 'pharmacy' 
                                                    AND p.date_time BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
                                                    GROUP BY DATE(p.date_time)");
                    break;

                case "this_year";
                    $stmt = $db->connection->prepare("SELECT DATE(p.date_time) as date, SUM(r.total_amount) as revenue
                                                    FROM payment_record p INNER JOIN pharmacy_request r ON p.provider_nic=r.provider_nic
                                                    INNER JOIN service_provider s ON s.provider_nic = p.provider_nic                                                   
                                                    WHERE s.provider_type = 'pharmacy' 
                                                    AND YEAR(p.date_time) = YEAR(NOW()) 
                                                    GROUP BY DATE(p.date_time)");
                    break;

                case "all_time";
                    $stmt = $db->connection->prepare("SELECT DATE(p.date_time) as date, SUM(r.total_amount) as revenue
                                                    FROM payment_record p INNER JOIN pharmacy_request r ON p.provider_nic=r.provider_nic
                                                    INNER JOIN service_provider s ON s.provider_nic = p.provider_nic                                                   
                                                    WHERE s.provider_type = 'pharmacy' 
                                                    GROUP BY DATE(p.date_time)");
                    break;
            }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        header("Content-Type: application/json");
        return json_encode($data);

   }

    public static function getAdministratorDoctorRevenueChart(): bool|string
    {

        $db = new Database();
        $chart_time = $_GET["period"] ?? "all_time";

        $stmt = "";
        $db = new Database();
        $chart_time = $_GET["period"] ?? "all_time";

        $stmt = "";
        switch ($chart_time) {
            case "this_week";
                $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record INNER JOIN service_provider s ON payment_record.provider_nic = s.provider_nic 
                                                    WHERE s.provider_type = 'doctor' AND YEAR(date_time) = YEAR(NOW()) 
                                                    AND WEEK(date_time, 1) = WEEK(NOW(), 1)
                                                    GROUP BY DATE(date_time)");
                break;

            case "this_month";
                $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue 
                                                    FROM payment_record INNER JOIN service_provider s ON payment_record.provider_nic = s.provider_nic
                                                    WHERE s.provider_type = 'doctor' AND YEAR(date_time) = YEAR(NOW()) 
                                                    AND MONTH(date_time) = MONTH(NOW())
                                                    GROUP BY DATE(date_time)");
                break;

            case "past_six_months";
                $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record INNER JOIN service_provider s ON payment_record.provider_nic = s.provider_nic 
                                                    WHERE s.provider_type = 'doctor' AND YEAR(date_time) = YEAR(NOW()) 
                                                    GROUP BY DATE(date_time)");
                break;


            case "all_time";
                $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record  INNER JOIN service_provider s ON payment_record.provider_nic = s.provider_nic 
                                                    WHERE s.provider_type = 'doctor'
                                                    GROUP BY DATE(date_time)");
                break;
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        header("Content-Type: application/json");
        return json_encode($data);
    }


    public static function getAdministratorFeedbackPage(): bool|array|string
    {
        $is_admin = $_SESSION["is_admin"];
        if (!$is_admin) {
            header("location: /administrator-login");
            return "";
        } else {
            $db = new Database();

            //get all feedback thar provided by service consumers to the service providers
            $stmt = $db->connection->prepare("SELECT s.profile_picture, s.name, s.provider_type, f.text, f.date_time FROM service_provider s INNER JOIN feedback f on s.provider_nic = f.provider_nic ORDER BY f.date_time DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            $feedback_from_providers = $result->fetch_all(MYSQLI_ASSOC);
        }
        return self::render(view: 'administrator-dashboard-feedback', layout: "admin-dashboard-layout", params: [
            'feedback_from_providers' => $feedback_from_providers
        ], layoutParams: [
            "title" => "Feedback",
            "admin" => [
                "name" => "Randima Dias"
            ],
            "active_link" => "feedback"
        ]);
    }


//    public static function updateProviderDetails(): bool|array|string
//    {
//        $nic = $_POST['provider_nic'];
//        $is_admin = $_SESSION["is_admin"];
//        $provider_nic = $_POST['nic'];
//        $provider_name = $_POST['name'];
//        $email_address = $_POST['email'];
//        $mobile_number = $_POST['mobile'];
//        $address = $_POST['address'];
//        $account_no = $_POST['acc_no'];
//        $bank_name = $_POST['bank'];
//        $branch_name = $_POST['branch'];
//
//        print_r($nic);
//
//        if (!$is_admin) {
//            header("location: /administrator-login");
//            return "";
//        } else {
//            $db = new Database();
//            $stmt = $db->connection->prepare("UPDATE service_provider SET provider_nic = ?,
//                              name = ?,
//                              address = ?,
//                              email_address = ?,
//                        mobile_number = ?,
//                        bank_name = ?,
//                        bank_branch_name = ?,
//                        bank_account_number = ?
//                        WHERE provider_nic = ?");
//            $stmt->bind_param("sssssssis", $provider_nic, $provider_name, $address,$email_address,$mobile_number,$bank_name,$branch_name,$account_no,$nic);
//            $stmt->execute();
//            $result = $stmt->get_result();
//
//            header("location: /admin-dashboard/users");
//            return "";
//        }
//    }

}

