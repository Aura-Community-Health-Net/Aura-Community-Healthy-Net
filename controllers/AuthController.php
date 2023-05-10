<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Database;

class AuthController extends Controller
{
    public function registerProvider(): array|bool|string
    {
        $providerType = $_GET['provider_type'];
        if (!isset($providerType)) {
            return "Not Allowed";
        }
        switch ($providerType) {
            #region Doctor Signup
            case 'doctor':
                //print_r($_POST);
                $name = $_POST["doc-name"];
                $nic = $_POST["nic"];
                $email = $_POST["email"];
                $mobile_number = $_POST["mobile-number"];
                $address = $_POST["address"];
                $reg_no = $_POST["reg-num"];
                $field_of_study = $_POST["field-study"];

                $qualifications = $_POST["qualifications"];
                $qualifications_array = explode(",", $qualifications);
                $account_no = $_POST["account-num"];
                $bank_name = $_POST["bank-name"];
                $branch_name = $_POST["branch-name"];
                $password = $_POST["password"];
                $con_password = $_POST["con-password"];
                $doctor_type = $_POST['doctor_type'];


                $certificate = $_FILES["certificate"];
                $file_name1 = $certificate["name"];
                $file_tmp_name1 = $certificate["tmp_name"];

                $random_id1 = bin2hex(random_bytes(24));
                $new_file_name1 = $nic . $random_id1 . "user" . $file_name1;
                move_uploaded_file($file_tmp_name1, Application::$ROOT_DIR . "/public/uploads/$new_file_name1");



                $profile = $_FILES["profile-pic"];
                $file_name2 = $profile["name"];
                $file_tmp_name2 = $profile["tmp_name"];

                $random_id2 = bin2hex(random_bytes(24));
                $new_file_name2 = $nic . $random_id2 . "user" . $file_name2;
                move_uploaded_file($file_tmp_name2, Application::$ROOT_DIR . "/public/uploads/$new_file_name2");




                //var_dump($_POST);
                $db = new database();

                $errors = [];

                $sql = "SELECT * FROM service_provider WHERE email_address = '$email'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["email"] = "Email address already in use";
                }


                $sql = "SELECT * FROM service_provider WHERE mobile_number = '$mobile_number'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["mobile_number"] = "Mobile number already in use";
                }

                $sql = "SELECT * FROM service_provider WHERE provider_nic = '$nic'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["nic"] = "NIC already in use";
                }

                $sql = "SELECT * FROM doctor WHERE slmc_reg_no = '$reg_no'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["reg_no"] = "Registration number already in use";
                }

                $sql = "SELECT * FROM service_provider WHERE bank_account_number = '$account_no'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["account_no"] = "Account number already in use";
                }

                if ($password != $con_password) {
                    $errors["con_password"] = "Password and Confirm Password must match.";
                }

                if (!isset($_POST["ua"])) {
                    $errors["ua"] = "You need to accept the user agreement";
                }

                if (empty($errors)) {
                    $hashedPassword = password_hash(password: $password, algo: PASSWORD_DEFAULT);

                    $stmt = $db->connection->prepare("INSERT INTO service_provider (
                            provider_nic, 
                            id,
                            name, 
                            address, 
                            email_address, 
                            password, 
                            mobile_number, 
                            bank_name, 
                            bank_branch_name, 
                            profile_picture, 
                            bank_account_number, 
                            provider_type) VALUES ( ?,UUID(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    $profilePic = "/uploads/$new_file_name2";
                    $type = "doctor";
                    $stmt->bind_param("sssssssssis", $nic, $name, $address, $email, $hashedPassword, $mobile_number, $bank_name, $branch_name, $profilePic, $account_no, $type);
                    $stmt->execute();
                    $result = $stmt->get_result();



                    $certificate = "/uploads/$new_file_name1";
                    $stmt = $db->connection->prepare("INSERT INTO doctor (provider_nic, slmc_reg_no, field_of_study, certificate_of_mbbs, type) VALUES ( ?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssss", $nic, $reg_no, $field_of_study, $certificate, $doctor_type);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    foreach ($qualifications_array as $qualification_item) {
                        $stmt = $db->connection->prepare("INSERT INTO doc_qualifications (provider_nic,qualifications) VALUES (?,?)");
                        $stmt->bind_param("ss", $nic, $qualification_item);
                        $stmt->execute();
                    }

                    $_SESSION["nic"] = $nic;
                    $_SESSION["user_type"] = "doctor";
                    $_SESSION["is_admin"] = false;
                    header("location: /doctor-dashboard");
                    return "";


                } else {
                    return self::render(view: 'doctor-signup', layout: 'provider-signup-layout', params: ['errors' => $errors]);
                }
            #endregion
            #region Pharmacy Signup
            case "pharmacy":
                $pharmacyName = $_POST["pharmacyname"];
                $ownerName = $_POST["ownername"];
                $nic = $_POST["nic"];
                $emailAddress = $_POST["emailaddress"];
                $mobile = $_POST["mobile"];
                $address = $_POST["address"];
                $pharmacyRegNo = $_POST["pharmacyregno"];
                $nmra = $_FILES["nmra"];
                $bankAccNo = $_POST["bankaccno"];
                $bankName = $_POST["bankname"];
                $bankBranch = $_POST["bankbranch"];
                $picFile = $_FILES["pic"];
                $password = $_POST["password"];
                $confirmPassword = $_POST["confirmpassword"];
                $location_lat = $_POST["location_lat"];
                $location_lng = $_POST["location_lng"];

                $file1_name = $picFile["name"];
                $file1_full_path = $picFile["full_path"];
                $file1_type = $picFile["type"];
                $file1_tmp_name = $picFile["tmp_name"];
                $file1_error = $picFile["error"];
                $file1_size = $picFile["size"];

                $random_picfile_id = bin2hex(random_bytes(24));
                $new_picfile_name = $nic . $random_picfile_id . "user" . $file1_name;
                move_uploaded_file($file1_tmp_name, Application::$ROOT_DIR . " /public/uploads/$new_picfile_name");


                $file2_name = $nmra["name"];
                $file2_full_path = $nmra["full_path"];
                $file2_type = $nmra["type"];
                $file2_tmp_name = $nmra["tmp_name"];
                $file2_error = $nmra["error"];
                $file2_size = $nmra["size"];

                $random_nmra_id = bin2hex(random_bytes(24));
                $new_nmra_name = $nic . $random_nmra_id . "user" . $file2_name;
                move_uploaded_file($file2_tmp_name, Application::$ROOT_DIR . " /public/uploads/$new_nmra_name");

                $db = new Database();
                $errors = [];

                $sql = "SELECT * FROM service_provider WHERE email_address = '$emailAddress'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["emailaddress"] = "Email address already in use";
                }


                $sql = "SELECT * FROM service_provider WHERE provider_nic = '$nic'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["nic"] = "NIC already in use";
                }


                $sql = "SELECT * FROM service_provider WHERE mobile_number = '$mobile'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["mobile_number"] = "Mobile Number already in use";
                }



                $sql = "SELECT * FROM pharmacy WHERE pharmacist_reg_no = '$pharmacyRegNo'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["pharmacyregno"] = "Pharmacist Registration Number already in use";
                }




                $sql = "SELECT * FROM service_provider WHERE bank_account_number = '$bankAccNo'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["bankaccno"] = "Bank account number already exists";
                }



                if ($password != $confirmPassword) {
                    $errors["confirmpassword"] = "password and confirm password isn't match ";
                }


                if (!isset($_POST["ua"])) {
                    $errors["ua"] = "You need to accept the user agreement";
                }


                if (empty($errors)) {
                    $hashedPassword = password_hash(password: $password, algo: PASSWORD_DEFAULT);

                    $result = $db->connection->prepare("INSERT INTO service_provider(
                             provider_nic,
                             id,
                             name,
                             address,
                             email_address,
                             password,
                             mobile_number,
                             locatin_lat,
                             location_lng,
                             bank_name,
                             bank_branch_name,
                             profile_picture,
                             bank_account_number,
                             provider_type) VALUES (?,UUID(),?,?,?,?,?,?,?,?,?,?,?,?)");

                    $picFile = "/uploads/$new_picfile_name";
                    $provider_type = "pharmacy";

                    $result->bind_param("ssssssddsssis", $nic, $ownerName, $address, $emailAddress, $hashedPassword, $mobile,$location_lat,$location_lng, $bankName, $bankBranch, $picFile, $bankAccNo, $provider_type);
                    $result->execute();
                    $Result = $result->get_result();



                    $result = $db->connection->prepare("INSERT INTO pharmacy(
                     provider_nic,
                     pharmacist_reg_no,
                     pharmacy_name,
                     nmra_certificate) VALUES (?,?,?,?)");

                    $nmra = "/uploads/$new_nmra_name";

                    $result->bind_param("ssss", $nic, $pharmacyRegNo, $pharmacyName, $nmra);
                    $result->execute();
                    $RESULT = $result->get_result();
                    $_SESSION["nic"] = $nic;
                    $_SESSION["user_type"] = "pharmacy";
                    $_SESSION["is_admin"] = false;

                } else {
                    return self::render(view: 'pharmacy-signup', layout: 'provider-signup-layout', params: ['errors' => $errors]);
                }


                header("location: /pharmacy-dashboard");
                return "";
            #endregion
            #region Product Seller Signup
            case "product-seller":
                $businessName = $_POST["businessName"];
                $ownerName = $_POST["ownerName"];
                $nic = $_POST["nic"];
                $email = $_POST["email"];
                $mobileNumber = $_POST["mobileNumber"];
                $address = $_POST["address"];
                $regNumber = $_POST["regNumber"];
                $bankNo = $_POST["bankNo"];
                $bankName = $_POST["bankName"];
                $branchName = $_POST["branchName"];
                $password = $_POST["password"];
                $confirmPassword = $_POST["confirmPassword"];
                $location_lat = $_POST["location_lat"];
                $location_lng = $_POST["location_lng"];

                $file = $_FILES["image"];
                $file_name = $file["name"];
                $file_tmp_name = $file["tmp_name"];

                $random_id = bin2hex(random_bytes(24));
                $new_file_name = $nic . $random_id . "profile_pic" . $file_name;
                move_uploaded_file($file_tmp_name, Application::$ROOT_DIR . "/public/uploads/$new_file_name");

                $db = new Database();

                $errors = [];

                $sql = "SELECT * FROM service_provider WHERE email_address = '$email'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["email"] = "This email address already in use.";
                }

                $sql = "SELECT * FROM service_provider WHERE provider_nic = '$nic'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["nic"] = "This NIC already in use.";
                }

                $sql = "SELECT * FROM service_provider WHERE mobile_number = '$mobileNumber'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["mobileNumber"] = "This Mobile number already in use.";
                }
                $sql = "SELECT * FROM service_provider WHERE bank_account_number = '$bankNo'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["bankNo"] = "This Bank account number already in use.";
                }

                $sql = "SELECT * FROM `healthy_food/natural_medicine_provider`WHERE business_reg_no = '$regNumber'";
                $result = $db->connection->query(query: $sql);
                if ($result->num_rows > 0) {
                    $errors["regNumber"] = "This Business Registration Number already in use";
                }

                if ($password != $confirmPassword) {
                    $errors["confirmPassword"] = "Password and Confirm Password must match.";
                }

                if (!isset($_POST["ua"])) {
                    $errors["ua"] = "You need to accept the user agreement";
                }

                if (empty($errors)) {
                    $hashedPassword = password_hash(password: $password, algo: PASSWORD_DEFAULT);
                    $stmt = $db->connection->prepare("INSERT INTO service_provider (provider_nic,
                                   id,
                                    name, 
                                    address, 
                                    email_address, 
                                    password, 
                                    mobile_number, 
                                    bank_name, 
                                    bank_branch_name, 
                                    profile_picture, 
                                    bank_account_number, 
                                    provider_type) VALUES (?,UUID(), ?, ?, ?, ?, ?, ?, ?, ?, ?,  ?)");

                    $image = "/uploads/$new_file_name";
                    $type = 'product-seller';
                    $stmt->bind_param("sssssssssis", $nic, $ownerName, $address, $email, $hashedPassword, $mobileNumber, $bankName, $branchName, $image, $bankNo, $type);
                    $stmt->execute();


                    $stmt = $db->connection->prepare("INSERT INTO `healthy_food/natural_medicine_provider` (provider_nic, business_reg_no, business_name) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $nic, $regNumber, $businessName);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $_SESSION["nic"] = $nic;
                    $_SESSION["is_admin"] = false;
                    $_SESSION["user_type"] = "product-seller";

                } else {
                    return self::render(view: 'product-seller-signup', layout: 'provider-signup-layout', params: ['errors' => $errors]);
                }
                header("location: /product-seller-dashboard");
                return "";
            #endregion    
            #region Care Rider Signup
            case "care-rider":
                $name = $_POST["name"];
                $nic = $_POST["nic"];
                $email = $_POST["email"];
                $mobileNumber = $_POST["mobile_number"];
                $address = $_POST["address"];
                $typeOfVehicle = $_POST["type_of_vehicle"];
                $numberPlate = $_POST["number_plate"];
                $color = $_POST["colour"];
                $drivingLicenseNumber = $_POST["driving_license_number"];
                $bankNo = $_POST["bank_no"];
                $bankName = $_POST["bank_name"];
                $branchName = $_POST["branch_name"];
                $password = $_POST["password"];
                $confirmPassword = $_POST["confirm_password"];

                $file1 = $_FILES["profile_pic"];
                $file_name1 = $file1["name"];
                $file_tmp_name1 = $file1["tmp_name"];

                $random_id = bin2hex(random_bytes(24));
                $new_file_name = $nic . $random_id . "profile_pic" . $file_name1;
                move_uploaded_file($file_tmp_name1, Application::$ROOT_DIR . "/public/uploads/$new_file_name");

                $db = new Database();
                $errors = [];

                //nic
                $sql = "SELECT * FROM service_provider WHERE provider_nic = '$nic'";
                $result = $db->connection->query(query: $sql);

                if ($result->num_rows > 0) {
                    //            echo "Email already in use";
                    $errors["nic"] = "nic already in use";
                }


                //email
                $sql = "SELECT * FROM service_provider WHERE email_address = '$email'";
                $result = $db->connection->query(query: $sql);

                if ($result->num_rows > 0) {
                    //            echo "Email already in use";
                    $errors["email"] = "Email address already in use";
                }


                //mobile number
                $sql = "SELECT * FROM service_provider WHERE mobile_number = '$mobileNumber'";
                $result = $db->connection->query(query: $sql);

                if ($result->num_rows > 0) {
                    $errors["mobile_number"] = "Mobile number already in use";

                }


                //number plate
                $sql = "SELECT * FROM vehicle WHERE number_plate = '$numberPlate'";
                $result = $db->connection->query(query: $sql);

                if ($result->num_rows > 0) {
                    $errors["number_plate"] = "number plate already in use";

                }


                //driving licence number
                $sql = "SELECT * FROM care_rider WHERE driving_licence_number = '  $drivingLicenseNumber '";
                $result = $db->connection->query(query: $sql);

                if ($result->num_rows > 0) {
                    $errors["driving_licence_number"] = "driving licence number already in use";

                }


                //bank account number
                $sql = "SELECT * FROM service_provider WHERE bank_account_number = '$bankNo'";
                $result = $db->connection->query(query: $sql);

                if ($result->num_rows > 0) {
                    //            echo "Email already in use";
                    $errors["bank_account_number"] = "bank account number already in use";
                }



                if ($password != $confirmPassword) {
                    $errors["password"] = "password & confirm password doesn't match";
                }

                if (empty($errors)) {
                    $hashedPassword = password_hash(password: $password, algo: PASSWORD_DEFAULT);
                    $stmt = $db->connection->prepare("INSERT INTO  service_provider (
                                       provider_nic ,
                                       id,
                                       name ,
                                       address,
                                       email_address,
                                       password,
                                       mobile_number,
                                       bank_name,
                                       bank_branch_name,
                                       profile_picture,
                                       bank_account_number,
                                       provider_type )
                             VALUES (?,UUID(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    $image = "/uploads/$new_file_name";
                    $role = "care-rider";
                    $stmt->bind_param("sssssisssis", $nic, $name, $address, $email, $hashedPassword, $mobileNumber, $bankName, $branchName, $image, $bankNo, $role);
                    $stmt->execute();
//
                    $stmt = $db->connection->prepare("INSERT INTO care_rider ( provider_nic,
                                                    driving_licence_number
                                                    )VALUES ( ?, ?)");
                    $stmt->bind_param("ss", $nic, $drivingLicenseNumber);
                    $stmt->execute();

                    $stmt = $db->connection->prepare("INSERT INTO vehicle ( number_plate,color,type,provider_nic
                                                    )VALUES ( ?,?,?,?)");
                    $stmt->bind_param("ssss",$numberPlate,$color,$typeOfVehicle, $nic);
                    $stmt->execute();


                    $_SESSION["nic"] = $nic;
                    $_SESSION["user_type"] = "care-rider";
                    $_SESSION["is_admin"] = false;
                    header("location: /care-rider-dashboard");
                    return "";
                } else {

                    return self::render(view: 'care-rider-signup', params: ['errors' => $errors],layout: "provider-signup-layout"
                    );

                }


            #endregion    
            default:
                return "Not Allowed";
        }
    }

    public static function getProviderSignupPage(): array|bool|string
    {
        $providerType = $_GET['provider_type'];
        if (!isset($providerType)) {
            return "Not Found";
        }
        return match ($providerType) {
            'doctor' => self::render(view: 'doctor-signup', layout: "provider-signup-layout", layoutParams: [
                "title" => "Register as a doctor"
            ]),
            "pharmacy" => self::render(view: 'pharmacy-signup', layout: "provider-signup-layout", layoutParams: [
                "title" => "Register as a pharmacy"
            ]),
            "product-seller" => self::render(view: 'product-seller-signup', layout: "provider-signup-layout", layoutParams: [
                "title" => "Register as a product seller"
            ]),
            "care-rider" => self::render(view: 'care-rider-signup', layout: "provider-signup-layout", layoutParams: [
                "title" => "Register as a care rider"
            ]),
            default => "Not Found",
        };
    }

    public static function getProviderLoginPage(): array|bool|string
    {
        return self::render(view: 'provider-login', layoutParams: ["title"=>"Login as a Service Provider"]);
    }

    public static function loginProvider(): bool|array|string
    {

        $emailAddress = $_POST['email'];
        $password = $_POST['password'];
        $_SESSION["is_admin"] = false;

        $db = new Database();
        $errors = [];
        $sql = "SELECT * FROM `service_provider` WHERE email_address = '$emailAddress' ";
        $result = $db->connection->query($sql);


        if ($result->num_rows === 1) {
            $provider = $result->fetch_assoc();
            $providerType = $provider['provider_type'];
            if (password_verify($password, $provider["password"])) {
                $_SESSION["is_admin"] = false;
                $_SESSION['nic'] = $provider['provider_nic'];
                $_SESSION['user_type'] = $providerType;
                switch ($providerType) {
                    case 'pharmacy':
                        header("location: /pharmacy-dashboard");
                        break;
                    case 'doctor':
                        header("location: /doctor-dashboard");
                        break;

                    case 'product-seller':
                        header("location: /product-seller-dashboard");
                        break;
                    case 'care-rider':
                        header("location: /care-rider-dashboard");
                        break;
                    default:
                        $errors["system"] = "Internal Server Error";
                        return self::render(view: 'provider-login', params: ['errors' => $errors], layoutParams: ["title"=>"Login as a Service Provider"]);
                }
                return "";
            } else {
                $errors["password"] = "Incorrect Password";
                return self::render(view: 'provider-login', params: ['errors' => $errors], layoutParams: ["title"=>"Login as a Service Provider"]);
            }
        } else {
            $errors["email"] = "Incorrect Email";
            return self::render(view: 'provider-login', params: ['errors' => $errors], layoutParams: ["title"=>"Login as a Service Provider"]);
        }
    }

    public static function getAdministratorLoginPage(): array|bool|string
    {
        return self::render(view: 'administrator-login', layoutParams: [
            "title" => "Login to Admin Dashboard"
        ]);
    }

    public static function loginAdministrator(): array|bool|string
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $db = new Database();
        $errors = [];
        //
        $stmt = $db->connection->prepare("SELECT * FROM administrator WHERE email_address = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin["password"])) {
                $_SESSION["is_admin"] = true;
                header("location: /admin-dashboard");
                return "";
            }
            $errors["password"] = "Password is incorrect";
            return self::render(view: 'administrator-login', layout: 'provider-signup-layout', params: ['errors' => $errors]);
        }

        $errors["email"] = "Email doesn't exist";
        return self::render(view: 'administrator-login', layout: 'provider-signup-layout', params: ['errors' => $errors]);

    }

    public static function getConsumerSignupPage(): bool|array|string
    {
        return self::render(view: 'consumer-signup', layout: 'consumer-signup-layout', layoutParams: ['title' => 'Register with Aura']);
    }

    public static function registerConsumer(): bool|array|string
    {
        $name = $_POST["name"];
        $nic = $_POST["nic"];
        $email = $_POST["email"];
        $mobileNumber = $_POST["mobileNumber"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $location_lat = $_POST["location_lat"];
        $location_lng = $_POST["location_lng"];
        $file = $_FILES["image"];
        $file_name = $file["name"];
        $file_tmp_name = $file["tmp_name"];

        $random_id = bin2hex(random_bytes(24));
        $new_file_name = $nic . $random_id . "profile_pic" . $file_name;
        move_uploaded_file($file_tmp_name, Application::$ROOT_DIR . "/public/uploads/$new_file_name");

        $db = new Database();

        $errors = [];

        $sql = "SELECT * FROM service_consumer WHERE email_address = '$email'";
        $result = $db->connection->query(query: $sql);
        if ($result->num_rows > 0) {
            $errors["email"] = "This email address already in use.";
        }

        $sql = "SELECT * FROM service_consumer WHERE consumer_nic = '$nic'";
        $result = $db->connection->query(query: $sql);
        if ($result->num_rows > 0) {
            $errors["nic"] = "This NIC already in use.";
        }

        $sql = "SELECT * FROM service_consumer WHERE mobile_number = '$mobileNumber'";
        $result = $db->connection->query(query: $sql);
        if ($result->num_rows > 0) {
            $errors["mobileNumber"] = "This Mobile number already in use.";
        }

        if ($password != $confirmPassword) {
            $errors["confirmPassword"] = "Password and Confirm Password must match.";
        }

        if (!isset($_POST["ua"])) {
            $errors["ua"] = "You need to accept the user agreement";
        }

        if (empty($errors)) {
            $hashedPassword = password_hash(password: $password, algo: PASSWORD_DEFAULT);
            $stmt = $db->connection->prepare("INSERT INTO service_consumer (consumer_nic, 
                                    name, 
                                    address, 
                                    email_address, 
                                    password, 
                                    mobile_number,
                                    location_lat,
                                    location_lng,
                                    profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $image = "/uploads/$new_file_name";
            $stmt->bind_param("ssssssdds", $nic, $name, $address, $email, $hashedPassword, $mobileNumber, $location_lat, $location_lng, $image);
            $stmt->execute();
            $_SESSION["nic"] = $nic;
            $_SESSION["is_admin"] = false;
            $_SESSION["user_type"] = "consumer";

        } else {
            return self::render(view: 'consumer-signup', params: ['errors' => $errors]);
        }
        header("location: /consumer-dashboard");
        return "";
    }

    public static function loginServiceConsumer(): bool|array|string
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $errors = [];
        $db = new Database();
        $stmt = $db->connection->prepare("SELECT * FROM service_consumer WHERE email_address = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $consumer = $result->fetch_assoc();
            if (password_verify($password, $consumer["password"])){
                $_SESSION["nic"] = $consumer["consumer_nic"];
                $_SESSION["user_type"] = "consumer";
                $_SESSION["is_admin"] = false;
                header("location: /consumer-dashboard");
                return "";
            } else {
                $errors["password"] = "Password doesn't match";
            }
        } else {
            $errors["email"] = "Email doesn't exist";
        }
        return self::render(view: "consumer-login", params: ["errors" => $errors]);
    }


    public static function getConsumerLoginPage(): bool|array|string
    {
        return self::render(view: "consumer-login");
    }

    public static function registrationOverview(): bool|array|string
    {
        return self::render(view: "registration-overview");
    }

    public static function providerLogout(): string
    {
        session_destroy();
        header("location: /provider-login");
        return "";
    }

    public static function consumerLogout(): string
    {
        session_destroy();
        header("location: /login");
        return "";
    }

    public static function adminLogout(): string
    {
        session_destroy();
        header("location: /administrator-login");
        return "";
    }



}