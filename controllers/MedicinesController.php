<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Database;
use http\Params;

class MedicinesController extends Controller
{

    public static function addMed(): array |bool|string
    {
        $med_name = $_POST["med_name"];
        $image = $_FILES["image"];
        $price = (int) $_POST["price"];
        $quantity = (int) $_POST["quantity"];
        $quantity_unit = $_POST["quantity_unit"];
        $stock = (int) $_POST["stock"];

        $filename = $image["name"];
        $file_full_path = $image["full_path"];
        $filetype = $image["type"];
        $file_tmp_name = $image["tmp_name"];
        $file_error = $image["error"];
        $file_size = $image["size"];

        $nic = $_SESSION["nic"];

        $db = new Database();
        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        $pharmacy = $result->fetch_assoc();




        if (!$pharmacy["is_verified"]) {
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


        $random_ID = bin2hex(random_bytes(24));
        $newfile_name = $nic . $random_ID . "medicine" . $filename;
        move_uploaded_file($file_tmp_name, Application::$ROOT_DIR . " /public/uploads/$newfile_name");

        $db = new Database();
        $stmt = $db->connection->prepare("INSERT INTO medicine(
                     name,
                     image, 
                     price,
                     stock,
                     quantity,
                     quantity_unit,
                     provider_nic) VALUES (?,?,?,?,?,?,?)");

        $image = "/uploads/$newfile_name";
        $med_price = $price*100;
        $stmt->bind_param("ssiiiss", $med_name, $image, $med_price, $stock, $quantity, $quantity_unit, $nic);
        $stmt->execute();
        $result = $stmt->get_result();
        header("location: /pharmacy-dashboard/medicines");
        return "";

    }




    public static function viewMedPage()
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        $search_query = isset($_GET["query"]) ? $_GET["query"]: "";

        if (!$nic || $providerType !== "pharmacy") {
            header("/pharmacy-login");
            return "";
        } else {
            $db = new Database();

            $stmt = $db->connection->prepare("SELECT * FROM medicine m WHERE m.provider_nic = ? AND m.name LIKE '%$search_query%'");
            $stmt->bind_param("s",$nic,);
            $stmt->execute();
            $result=$stmt->get_result();
            $medicines = $result->fetch_all(MYSQLI_ASSOC);

            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();

            return self::render(view: 'pharmacy-dashboard-medicines', layout: "pharmacy-dashboard-layout", params: [
                "medicines" => $medicines,
            ], layoutParams: ["pharmacy" => $pharmacy, "title" => "Medicines", "active_link" => "medicines-list"]);

        }
    }



    public static function getSendMedicineAdvanceInfoForm()
    {

        $provider_nic = $_SESSION["nic"];
        $provider_type = $_SESSION["user_type"];
        $request_id = $_GET["id"];




        if (!$provider_nic|| !$provider_type == "pharmacy") {
            header("/pharmacy-login");
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
            $stmt->bind_param("s", $provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT c.profile_picture,c.name,c.mobile_number,pr.prescription,pr.customer_remark,pr.request_id  FROM pharmacy_request pr INNER JOIN service_consumer c ON c.consumer_nic = pr.consumer_nic INNER JOIN service_provider p ON p.provider_nic = pr.provider_nic WHERE pr.provider_nic = ? AND pr.request_id = ? ");
            $stmt->bind_param("si",$provider_nic,$request_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $available_med_details = $result->fetch_assoc();

            $stmt = $db->connection->prepare("SELECT name FROM medicine WHERE provider_nic = ?");
            $stmt->bind_param("s",$provider_nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $medicines_list = $result->fetch_all(MYSQLI_ASSOC);





            return self::render(view: 'pharmacy-dashboard-newRequests-advanceinfo', layout: "pharmacy-dashboard-layout",
                params:[
                    "available_med_details" => $available_med_details,
                    "medicines_list" => $medicines_list
                ],
                layoutParams: ["pharmacy" => $pharmacy, "title" => "New Requests", "active_link" => "new-requests"]);

        }
    }



    public static function sendMedicineAdvanceInfo()
    {

         $available_med_list = $_POST["medicines_list"];


         $available_med_list = json_encode(explode(",", $available_med_list));


         $total_amount = $_POST["total_amount"];
         $advance_amount= $total_amount*0.3;
         $note = $_POST["note"];
         $request_id = $_GET["id"];





        $provider_nic = $_SESSION["nic"];

//        $db = new Database();
//        $stmt = $db->connection->prepare("SELECT * FROM service_provider WHERE provider_nic = ?");
//        $stmt->bind_param("s", $provider_nic);
//        $stmt->execute();
//        $result = $stmt->get_result();
//        $pharmacy = $result->fetch_assoc();

        $db = new Database();
        $stmt = $db->connection->prepare("UPDATE pharmacy_request SET total_amount=?, advance_amount=?,available_medicines=?,pharmacy_remark=?  WHERE request_id = ? AND Sent_Request='unsent'");

        $totalAmountInCents = $total_amount * 100;
        $advanceAmountInCents = $advance_amount * 100;
        $stmt->bind_param("ssssi", $totalAmountInCents, $advanceAmountInCents, $available_med_list,$note,$request_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt = $db->connection->prepare("UPDATE pharmacy_request SET Sent_Request = 'sent' WHERE provider_nic = ? AND request_id=?");
        $stmt->bind_param("si",$provider_nic,$request_id);
        $stmt->execute();




        header("location: /pharmacy-dashboard/new-requests");
        return "";








    }


    public static function getsidepane()
    {
        return self::render(view: '/sidebar');
    }
    public static function deleteMedicines(): string
    {

        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if(!$nic || $providerType )
        {
            header("location: /provider-login");
        }

        $medicine_id = $_GET["med_id"];
        $db = new Database();
        $stmt = $db->connection->prepare("DELETE FROM medicine WHERE med_id = ? AND provider_nic = ?");
        $stmt->bind_param("ds", $medicine_id,$nic);
        $stmt->execute();
        $result = $stmt->get_result();

        header("location: /pharmacy-dashboard/medicines");
        return "";





    }




    public  static  function updateMedicines(): string
    {

        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        if(!$nic || $providerType !== "pharmacy" )
        {
            header("location: /provider-login");
            return "";
        }

        $med_id = $_GET["med_id"];
        $med_name = $_POST["med_name"];
        $med_price = (int) $_POST["price"];
        $med_quantity = (int) $_POST["quantity"];
        $med_quantity_unit = $_POST["quantity_unit"];
        $med_stock = (int) $_POST["stock"];
        $db = new Database();

        $stmt = $db->connection->prepare("UPDATE medicine SET name = ?,price = ?,stock=? , quantity = ?,quantity_unit = ? WHERE med_id = ? AND provider_nic = ?");


        $stmt->bind_param("siiisis",$med_name,$med_price,$med_stock,$med_quantity,$med_quantity_unit,$med_id,$nic);


        $stmt->execute();
        $result = $stmt->get_result();

        header("location: /pharmacy-dashboard/medicines");
        return "";














    }



public static function RequestForPharmacy():bool|array|string
{




    $nic = $_SESSION["nic"];


    if(!$nic )
    {
        header("location: /login");
        return "";
    }

    else{

        $id = $_GET["pharmacy_id"];  //get provider id by  event listner

        var_dump($id);


        $prescription = $_FILES["prescription"];
        $customer_remark = $_POST["customer_remark"];

        $filename = $prescription["name"];
        $file_tmp_name = $prescription["tmp_name"];


        $random_ID = bin2hex(random_bytes(48));
        $newfile_name = $nic . $random_ID . "prescription" . $filename;
        $dd = !file_exists(Application::$ROOT_DIR . "/public/uploads/prescriptions");

        var_dump($dd);
        if(!file_exists(Application::$ROOT_DIR . "/public/uploads/prescriptions"))
        {
            mkdir(Application::$ROOT_DIR . "/public/uploads/prescriptions",0777,true);
        }
        move_uploaded_file($file_tmp_name, Application::$ROOT_DIR . "/public/uploads/prescriptions/$newfile_name");
        $prescription_image = "/uploads/prescriptions/$newfile_name";




        $db = new Database();
//    $stmt = $db->connection->prepare("SELECT s.id FROM pharmacy p INNER JOIN service_provider s  WHERE s.id = ? ");
//    $stmt->bind_param("s",$id);
//    $stmt->execute();
//    $stmt->get_result();

        $stmt = $db->connection->prepare("SELECT p.provider_nic FROM pharmacy p INNER JOIN service_provider s ON p.provider_nic = s.provider_nic WHERE s.id = ? ");
        $stmt->bind_param("s",$id);
        $stmt->execute();
        $provider = $stmt->get_result();
        $provider_details = $provider->fetch_assoc();
        $provider_nic = $provider_details["provider_nic"];

        var_dump($provider_nic);

//    var_dump($result);
//    var_dump($id);




        $stmt = $db->connection->prepare("INSERT INTO pharmacy_request(customer_remark,prescription,consumer_nic,provider_nic)
                VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$customer_remark,$prescription_image,$nic,$provider_nic);

//add provider nic for bind param

        $stmt->execute();
               header("location: /consumer-dashboard/services/pharmacy/request-details");
        return "";



    }















}









    public static function getPharmacyList(): bool|array|string
    {

        $nic =$_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        if(!$nic || $userType !== "consumer"){
            header("location: /login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();


            $db = new Database();

            $stmt = $db->connection->prepare("SELECT r.id, p.pharmacy_name,r.provider_nic,r.mobile_number FROM pharmacy p INNER JOIN service_provider r ON p.provider_nic = r.provider_nic WHERE r.is_verified = 1");
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacies = $result->fetch_all(MYSQLI_ASSOC);
            return self::render(view: 'consumer-dashboard-services-pharmacy-pharmacylist', layout: "consumer-dashboard-layout", params: [
                'pharmacies' => $pharmacies
            ],

                layoutParams: [
                    "consumer" => $consumer,
                    "active_link" => "pharmacy",
                    "title" => "Pharmacy"]);


        }
    }







    public static function getPharmacyPaymentReceipt(): bool|array|string
    {

        $nic =$_SESSION["nic"];
        $userType = $_SESSION["user_type"];
        $id = $_GET["id"];
//        var_dump($id);

        if(!$nic || $userType !== "consumer"){
            header("location: /login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();



            $stmt = $db->connection->prepare("SELECT pr.request_id,pr.available_medicines,pr.advance_amount,pr.total_amount,pr.pharmacy_remark,p.pharmacy_name,pr.customer_remark,pr.prescription FROM  pharmacy_request pr INNER JOIN pharmacy p ON pr.provider_nic = p.provider_nic WHERE pr.consumer_nic = ? AND pr.request_id = ?");
            $stmt->bind_param("si",$nic,$id);
            $stmt->execute();
            $result = $stmt->get_result();
            $payment_details = $result->fetch_assoc();


//            $stmt = $db->connection->prepare("SELECT p.pharmacy_name FROM pharmacy_request pr INNER JOIN pharmacy p ON p.provider_nic=pr.provider_nic WHERE pr.consumer_nic = ? AND pr.request_id = ?");
//            $stmt->bind_param("si",$nic,$id);
//            $stmt->execute();
//            $result = $stmt->get_result();
//            $pharmacy = $result->fetch_all(MYSQLI_ASSOC);
//            var_dump($pharmacy);



            return self::render(view: 'consumer-dashboard-services-pharmacy-payment-receipt', layout: "consumer-dashboard-layout",params:[
                "payment_details" => $payment_details,

            ], layoutParams: [
                "consumer" => $consumer,
                "active_link" => "pharmacy",
                "title" => "Pharmacy"]);


        }
    }



    public static function getConsumerPharmacyOverview(): bool|array|string
    {


        $nic =$_SESSION["nic"];
        $id = $_GET["id"];

        $userType = $_SESSION["user_type"];
        if(!$nic || $userType !== "consumer"){
            header("location: /provider-login");
            return "";
        } else {
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();

//            $search_query = isset($_GET["query"]) ? $_GET["query"]: "";

            $stmt = $db->connection->prepare("SELECT  m.name, round(m.price/100,2) as price, m.image , m.quantity,m.quantity_unit  FROM  medicine m INNER  JOIN pharmacy p ON m.provider_nic = p.provider_nic INNER  JOIN service_provider s ON s.provider_nic = p.provider_nic WHERE s.id = ? ");

//            AND m.name LIKE '%$search_query%'
            $stmt->bind_param("s",$id,);
            $stmt->execute();
            $result = $stmt->get_result();
            $medicines = $result->fetch_all(MYSQLI_ASSOC);



            $stmt = $db->connection->prepare("SELECT * FROM service_provider s INNER  JOIN pharmacy p ON s.provider_nic = p.provider_nic WHERE s.id = ?");
            $stmt->bind_param("s",$id);
            $stmt->execute();
            $result = $stmt->get_result();
            $pharmacy = $result->fetch_assoc();


            $stmt = $db->connection->prepare("SELECT sp.profile_picture,sp.name,f.date_time,f.text FROM feedback f INNER  JOIN service_provider sp ON sp.provider_nic=f.provider_nic WHERE sp.id = ? ORDER BY f.date_time DESC ");
            $stmt->bind_param("s",$id);
            $stmt->execute();
            $result = $stmt->get_result();
            $feedback_set = $result->fetch_all(MYSQLI_ASSOC);
//            exit();



            return self::render(view: 'consumer-dashboard-services-pharmacy-pharmacy-dashboard', layout: "consumer-dashboard-layout",params: [
                'pharmacy' => $pharmacy,
                'medicines' => $medicines,
                'feedback_set' => $feedback_set
            ], layoutParams: [
                "consumer" => $consumer,
                "active_link" => "pharmacy",
                "title" => "Pharmacy"]);







        }






    }



    public static function addPharmacyFeedback(): string
    {
        $nic = $_SESSION["nic"];
        $providerType = $_SESSION["user_type"];
        $pharmacy_feedback = $_POST["pharmacy-feedback"];
        $provider_nic = $_GET["provider_nic"];
        $id = $_GET["id"];

        if(!$nic || $providerType!=='consumer')
        {
            header("location: /login");
            return "";
        }

        else{

            $db = new Database();

            $stmt = $db->connection->prepare("INSERT INTO feedback(text,date_time,provider_nic,consumer_nic) VALUES(?,now(),?,?)");
            $stmt->bind_param("sss",$pharmacy_feedback,$provider_nic,$nic);
            $stmt->execute();
            header("location:/consumer-dashboard/services/pharmacy/view?id=$id");
            return "";




        }












    }


   public  static function getPharmacyRequestDetailsPage(): bool|array|string
   {
       $nic = $_SESSION["nic"];
       if (!$nic){
           header("location: /login");
           return "";
       } else{
           $db = new Database();
           $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
           $stmt->bind_param("s", $nic);
           $stmt->execute();
           $result = $stmt->get_result();
           $consumer = $result->fetch_assoc();

//           $stmt = $db->connection->prepare("SELECT pr.request_id,pr.total_amount,pr.advance_amount,pr.pharmacy_remark,pr.available_medicines FROM pharmacy_request pr WHERE pr.consumer_nic = ?");
//           $stmt->bind_param("s",$nic);
//           $stmt->execute();
//           $result = $stmt->get_result();
//           $pharmacy_request_details = $result->fetch_all(MYSQLI_ASSOC);

           $stmt = $db->connection->prepare("SELECT pr.request_id, s.name,s.mobile_number,s.profile_picture, pr.advance_amount,pr.date_time FROM service_provider s INNER JOIN pharmacy_request pr ON pr.provider_nic = s.provider_nic WHERE pr.consumer_nic = ? ORDER BY pr.date_time DESC ");
           $stmt->bind_param("s",$nic);
           $stmt->execute();
           $result = $stmt->get_result();
           $pharmacy_details = $result->fetch_all(MYSQLI_ASSOC);


           return self::render(view: 'consumer-dashboard-services-pharmacy-requestDetails', layout: 'consumer-dashboard-layout', params:[
//               "pharmacy_request_details" => $pharmacy_request_details,
               "pharmacy_details" => $pharmacy_details
           ],layoutParams: [
               "consumer" => $consumer,
               "title" => "Medicines",
               "active_link" => "dashboard-medicines"
           ]);
       }

   }








    public static function getConsumerMedicinesPayment(): bool|array|string
    {
        $nic = $_SESSION["nic"];
        if (!$nic){
            header("location: /login");
            return "";
        } else{
            $db = new Database();
            $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE consumer_nic = ?");
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();
            $consumer = $result->fetch_assoc();

            return self::render(view: 'consumer-dashboard-services-pharmacy-medicines-payment', layout: 'consumer-dashboard-layout', layoutParams: [
                "consumer" => $consumer,
                "title" => "Medicines",
                "active_link" => "dashboard-medicines"
            ]);
        }
    }




































}



