<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class AdministratorController extends Controller
{
    public static function getNewRegistrationPage(): array |bool|string
    {
        $db = new Database();
        $is_admin = $_SESSION["is_admin"];
        if ($is_admin) {
            $provider_type = $_GET["provider_type"] ?? "doctor";

            if ($provider_type == "doctor") {
                $sql = "SELECT DISTINCT * FROM service_provider INNER JOIN doctor d on service_provider.provider_nic = d.provider_nic INNER JOIN doc_qualifications dq on d.provider_nic = dq.provider_nic WHERE is_verified = 0";
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
        return self::render(view: 'administrator-dashboard', layout: "admin-dashboard-layout", params: [], layoutParams: [
            "title" => "Dashboard",
            "admin" => [
                "name" => "Randima Dias"
            ],
            "active_link" => "dashboard"
        ]);
    }

    public static function getAdministratorDuePaymentsPage(): bool|array|string
    {
        return self::render(view: 'administrator-dashboard-due-payments', layout: "admin-dashboard-layout", params: [], layoutParams: [
            "title" => "Due Payments",
            "admin" => [
                "name" => "Randima Dias"
            ],
            "active_link" => "payments"
        ]);
    }

    public static function getAdministratorFeedbackPage(): bool|array|string
    {
        $is_admin = $_SESSION["is_admin"];
        if(!$is_admin){
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

