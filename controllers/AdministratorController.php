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
            $provider_type = $_GET["provider_type"] ?? "doctor";
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
            } elseif ($provider_type == "pharmacy") {
                $sql = "SELECT * FROM service_provider INNER JOIN pharmacy p on service_provider.provider_nic = p.provider_nic WHERE is_verified = 0";
            } elseif ($provider_type == "product-seller") {
                $sql = "SELECT * FROM service_provider INNER JOIN `healthy_food/natural_medicine_provider` `hf/nmp` on service_provider.provider_nic = `hf/nmp`.provider_nic WHERE
                                                                                                                                                         is_verified = 0";
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
        if (!$is_admin) {
            header("location: /administrator-login");
            return "";
        }

        $stmt = $db->connection->prepare("SELECT COUNT(provider_nic)AS provider_count FROM service_provider s  WHERE s.is_verified = 0 AND s.provider_type='pharmacy'");
        $stmt->execute();
        $result = $stmt->get_result();
        $pharmacist_count = $result->fetch_all(MYSQLI_ASSOC);

        $stmt = $db->connection->prepare("SELECT COUNT(provider_nic) AS provider_count FROM service_provider s  WHERE s.is_verified = 0 AND s.provider_type='product-seller'");
        $stmt->execute();
        $result = $stmt->get_result();
        $product_seller_count = $result->fetch_all(MYSQLI_ASSOC);

        $stmt = $db->connection->prepare("SELECT COUNT(provider_nic) AS provider_count FROM service_provider s  WHERE s.is_verified = 0 AND s.provider_type='doctor'");
        $stmt->execute();
        $result = $stmt->get_result();
        $doctor_count = $result->fetch_all(MYSQLI_ASSOC);

        $stmt = $db->connection->prepare("SELECT COUNT(provider_nic) AS provider_count FROM service_provider s  WHERE s.is_verified = 0 AND s.provider_type='care-rider'");
        $stmt->execute();
        $result = $stmt->get_result();
        $care_rider_count = $result->fetch_all(MYSQLI_ASSOC);

        $stmt = $db->connection->prepare("SELECT s.profile_picture, s.name, sum(pr.amount)/100 AS amount, pr.purpose FROM service_provider s 
        INNER JOIN payment_record pr on s.provider_nic = pr.provider_nic WHERE YEAR(date_time) = YEAR(CURRENT_TIMESTAMP) AND MONTH(date_time) = MONTH(CURRENT_TIMESTAMP) GROUP BY s.provider_nic ORDER BY amount DESC LIMIT 4");
        $stmt->execute();
        $result = $stmt->get_result();
        $due_payments = $result->fetch_all(MYSQLI_ASSOC);

        return self::render(view: 'administrator-dashboard', layout: "admin-dashboard-layout", params: [
            "pharmacies" => $pharmacist_count,
            "product_sellers" => $product_seller_count,
            "doctors" => $doctor_count,
            "care_riders"=>$care_rider_count,
            "due_payments"=>$due_payments
        ], layoutParams: [
            "title" => "Dashboard",
            "admin" => [
                "name" => "Randima Dias"
            ],
            "active_link" => "dashboard"
        ]);
    }

    public static function getAdministratorDuePaymentsPage(): bool|array|string
    {
        $db = new Database();
        $is_admin = $_SESSION["is_admin"];

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
            ], "active_link" => "feedback"
        ]);
    }

    public static function getAdministratorProductSellersRevenueChart(){
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
                                                    WHERE s.provider_type = 'product-seller' AND YEAR(date_time) = YEAR(NOW()) 
                                                    AND WEEK(date_time, 1) = WEEK(NOW(), 1)
                                                    GROUP BY DATE(date_time)");
                break;

            case "this_month";
                $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue 
                                                    FROM payment_record INNER JOIN service_provider s ON payment_record.provider_nic = s.provider_nic
                                                    WHERE s.provider_type = 'product-seller' AND YEAR(date_time) = YEAR(NOW()) 
                                                    AND MONTH(date_time) = MONTH(NOW())
                                                    GROUP BY DATE(date_time)");
                break;

            case "past_six_months";
                $stmt = $db->connection->prepare("SELECT DATE(date_time) as date, SUM(amount) as revenue
                                                    FROM payment_record INNER JOIN service_provider s ON payment_record.provider_nic = s.provider_nic 
                                                    WHERE s.provider_type = 'product-seller' AND YEAR(date_time) = YEAR(NOW()) 
                                                    GROUP BY DATE(date_time)");
                break;

            case "all_time";
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

    public static function getAdministratorFeedbackPage(): bool|array|string
    {
        $is_admin = $_SESSION["is_admin"];
        if (!$is_admin) {
            header("location: /administrator-login");
            return "";
        } else {
            $db = new Database();
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

}

