<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Database;
use app\core\EmailSender;
use Exception;

class ServiceProvidersController extends Controller
{
    public static function verifyServiceProvider(): string
    {
        $nic = $_GET["nic"];
        $provider_type = $_GET["provider_type"];

        $db = new Database();
        $stmt = $db->connection->prepare("UPDATE service_provider SET is_verified = 1 WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();


        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $service_provider = $result->fetch_assoc();
        $email_address = $service_provider["email_address"];
        $provider_name = $service_provider["name"];

        $type = match ($provider_type) {
            "doctor" => "Doctor",
            "pharmacy" => "Pharmacist",
            "product-seller" => "Product Seller",
            "care-rider" => "Care Rider"
        };

        try {
            EmailSender::sendEmail(receiverEmail: $email_address, receiverName: $provider_name, subject: "Verification confirmation for your Aura account", htmlContent: "", params: [
                "TYPE" => $type,
                "NAME" => $provider_name,
            ]);
            header("location: /admin-dashboard/new-registrations?provider_type=$provider_type");
            return "";
        } catch (Exception $e){
            header("location: /admin-dashboard/new-registrations?provider_type=$provider_type");
            return "";
        }
    }
    public static function denyServiceProvider(): string
    {
        $nic = $_GET["nic"];
        $provider_type = $_GET["provider_type"];

        $db = new Database();
        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $service_provider = $result->fetch_assoc();
        $email_address = $service_provider["email_address"];
        $provider_name = $service_provider["name"];

        $type = match ($provider_type) {
            "doctor" => "Doctor",
            "pharmacy" => "Pharmacist",
            "product-seller" => "Product Seller",
            "care-rider" => "Care Rider"
        };

        try {
            EmailSender::sendEmail(receiverEmail: $email_address, receiverName: $provider_name, subject: "Verification confirmation for your Aura account", htmlContent: "", params: [
                "TYPE" => $type,
                "NAME" => $provider_name,
            ]);
            header("location: /admin-dashboard/new-registrations?provider_type=$provider_type");
            return "";
        } catch (Exception $e){
            header("location: /admin-dashboard/new-registrations?provider_type=$provider_type");
            return "";
        }

    }
}