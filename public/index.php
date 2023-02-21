<?php
// Requiring the autoload file to implement auto require of classes
require_once __DIR__ . '/../vendor/autoload.php';

// Importing core classes
use app\controllers\ConsumerController;
use app\core\Application;
use app\controllers\OrdersController;

// Importing controller classes
use app\controllers\MedicinesController;
use app\controllers\SiteController;
use app\controllers\AuthController;

use app\controllers\AnalyticsController;

use app\controllers\CareRiderController;

use app\controllers\AdministratorController;
use app\controllers\ServiceProvidersController;

use app\controllers\CareRiderTimeslotsController;

use app\controllers\DashboardController;
use app\controllers\DoctorTimeslotsController;
use app\controllers\DoctorAppointmentsController;

use app\controllers\CareRiderNewRequestsController;

use app\controllers\PatientsController;
use app\controllers\ProfileController;

use app\controllers\FeedbacksController;
use app\controllers\ProductsController;


// Implementing environment variable loading
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
session_start();


$app = new Application(dirname(__DIR__));

// Common site routes
$app->router->get('/', [SiteController::class, 'home']);

//Authentication Routes
$app->router->get('/provider-register', [AuthController::class, 'getProviderSignupPage']);
$app->router->post('/provider-register', [AuthController::class, 'registerProvider']);
$app->router->get('/provider-login', [AuthController::class, 'getProviderLoginPage']);
$app->router->post('/provider-login', [AuthController::class, 'loginProvider']);

$app->router->get('/register', [AuthController::class, 'getConsumerSignupPage']);
$app->router->post('/register', [AuthController::class, 'registerConsumer']);
$app->router->get('/login', [AuthController::class, 'getConsumerLoginPage']);
$app->router->post('/login', [AuthController::class, 'loginServiceConsumer']);
$app->router->get('/registration-overview', [AuthController::class, 'registrationOverview']);
$app->router->post('/provider-logout', [AuthController::class, 'providerLogout']);
$app->router->post('/logout', [AuthController::class, 'consumerLogout']);
$app->router->post('/admin-logout', [AuthController::class, 'administratorLogout']);


$app->router->get('/administrator-login', [AuthController::class, 'getAdministratorLoginPage']);
$app->router->post('/administrator-login', [AuthController::class, 'loginAdministrator']);

//DashBoard Routes

// For administrator
$app->router->get('/admin-dashboard', [AdministratorController::class, 'getAdministratorDashboardPage']);
$app->router->get('/admin-dashboard/new-registrations', [AdministratorController::class, 'getNewRegistrationPage']);
$app->router->post('/service-providers/verify', [ServiceProvidersController::class, 'verifyServiceProvider']);
$app->router->get('/admin-dashboard/due-payments', [AdministratorController::class, 'getAdministratorDuePaymentsPage']);
$app->router->post('/admin-dashboard/due-payments', [AdministratorController::class, 'getAdministratorDuePaymentsPage']);
$app->router->get('/admin-dashboard/feedback', [AdministratorController::class, 'getAdministratorFeedbackPage']);

// For product-seller
$app->router->get('/product-seller-dashboard', [DashboardController::class, 'getProductSellerDashboardPage']);
$app->router->get('/product-seller-dashboard/categories', [ProductsController::class, 'getProductSellerChooseCategoryPage']);
$app->router->get('/product-seller-dashboard/products', [ProductsController::class, 'getProductSellerMedFruitsVegPage']);
$app->router->post('/product-seller-dashboard/products/delete', [ProductsController::class, 'deleteProduct']);
$app->router->post('/product-seller-dashboard/products', [ProductsController::class, 'addProducts']);
$app->router->get('/product-seller-dashboard/orders', [OrdersController::class, 'getProductSellerOrdersPage']);
$app->router->get('/product-seller-dashboard/feedback', [FeedbacksController::class, 'getProductSellerFeedbackPage']);
$app->router->get('/product-seller-dashboard/profile', [ProfileController::class, 'getProductSellerProfilePage']);
$app->router->get('/product-seller-dashboard/analytics', [AnalyticsController::class, 'getProductSellerAnalyticsPage']);


// For pharmacy
$app->router->get('/pharmacy-dashboard', [DashboardController::class, 'getPharmacyDashboard']);
$app->router->get('/pharmacy-dashboard/medicines', [MedicinesController::class, 'viewMedPage']);
$app->router->post('/pharmacy-dashboard/medicines', [MedicinesController::class, 'addMed']);
$app->router->post('/pharmacy-dashboard/medicines/delete',[MedicinesController::class,'deleteMedicines']);
$app->router->get('/pharmacy-dashboard/medicines/update',[MedicinesController::class,'getupdateMedicinesForm']);
$app->router->post('/pharmacy-dashboard/medicines/update',[MedicinesController::class,'updateMedicines']);
//$app->router->post('/pharmacy-dashboard/medicines/update-medicines',[MedicinesController::class,'editMedicines']);
$app->router->get('/pharmacy-dashboard/new-orders', [OrdersController::class, 'viewNewOrderPage']);
$app->router->get('/pharmacy-dashboard/new-orders/view', [MedicinesController::class, 'viewMedicineAdvanceInfo']);
$app->router->get('/pharmacy-dashboard/feedback',[FeedbacksController::class,'getPharmacyFeedbackPage']);
$app->router->get('/pharmacy-dashboard/analytics',[AnalyticsController::class,'getPharmacyAnalyticsPage']);
$app->router->get('/pharmacy-dashboard/profile',[ProfileController::class,'getPharmacyProfilePage']);


// For Care Rider
$app->router->get('/care-rider-dashboard', [DashboardController::class, 'getCareRiderDashboard']);
$app->router->get('/care-rider-dashboard/analytics', [AnalyticsController::class, 'getCareRiderAnalyticsPage']);
$app->router->get('/care-rider-dashboard/feedback', [FeedbacksController::class, 'getCareRiderFeedbackPage']);
$app->router->get('/care-rider-dashboard/profile', [ProfileController::class, 'getCareRiderProfilePage']);
$app->router->get('/care-rider-dashboard/new-requests', [CareRiderNewRequestsController::class, 'getNewRequestsPage']);
//                                    Dashboard
$app->router->get('/care-rider-dashboard/timeslots', [CareRiderTimeslotsController::class, 'getCareRiderTimeslotsPage']);
$app->router->post('/care-rider-dashboard/timeslots', [CareRiderTimeslotsController::class, 'addCareRiderTimeslot']);
//                                     Timeslots-delete
$app->router->post('/care-rider-dashboard/timeslots-delete', [CareRiderTimeslotsController::class, 'deleteCareRiderTimeslot']);
//                                    Timeslots-updates
$app->router->get('/care-rider-dashboard/timeslots-update', [CareRiderTimeslotsController::class, 'getUpdatePopup']);
$app->router->post('/care-rider-dashboard/timeslots-update', [CareRiderTimeslotsController::class, 'updateTimeSlot']);
//                                  New-Requests
$app->router->get('/care-rider-dashboard/new-requests', [CareRiderNewRequestsController::class, 'getNewRequestsPage']);
$app->router->get('/care-rider-dashboard/profile', [ProfileController::class, 'getCareRiderProfilePage']);
$app->router->get('/care-rider-dashboard/analytics', [AnalyticsController::class, 'getCareRiderAnalyticsPage']);
$app->router->post('/care-rider-dashboard/new-requests', [CareRiderNewRequestsController::class, 'NewRequests']);
$app->router->get('/care-rider-dashboard/profile', [ProfileController::class, 'getCareRiderProfilePage']);
$app->router->post('/care-rider-dashboard/profile', [ProfileController::class, 'Profile']);
//For Doctor
$app->router->get('/doctor-dashboard', [DashboardController::class, 'getDoctorDashboardPage']);
$app->router->get('/doctor-dashboard/timeslots', [DoctorTimeslotsController::class, 'getDoctorTimeslotsPage']);
$app->router->post('/doctor-dashboard/timeslots', [DoctorTimeslotsController::class, 'addDoctorTimeslots']);
$app->router->get('/doctor-dashboard/appointments', [DoctorAppointmentsController::class, 'getDoctorAppointmentsPage']);
$app->router->get('/doctor-dashboard/patients', [PatientsController::class, 'getDoctorPatientsPage']);
$app->router->get('/doctor-dashboard/analytics', [AnalyticsController::class, 'getDoctorAnalyticsPage']);
$app->router->get('/doctor-dashboard/feedback', [FeedbacksController::class, 'getDoctorFeedbackPage']);
$app->router->get('/doctor-dashboard/profile', [ProfileController::class, 'getDoctorProfilePage']);

//For Consumer
$app->router->get('/consumer-dashboard', [DashboardController::class, 'getConsumerDashboardPage']);
$app->router->get('/consumer-dashboard/feedback',[AnalyticsController::class,'getConsumerFeedbackPage']);
$app->router->get('/consumer-dashboard/analytics',[AnalyticsController::class,'getConsumerAnalyticsPage']);
$app->router->get('/consumer-dashboard/services/care-rider',[CareRiderController::class,'getCareRiderChoosePage']);
$app->router->get('/consumer-dashboard/services/care-rider/request',[CareRiderController::class,'getCareRiderRequestsPage']);
$app->router->get('/consumer-dashboard/products', [ProductsController::class, 'getConsumerProductsPage']);
$app->router->post('/consumer-dashboard/products', [ProductsController::class, 'getConsumerProductsPage']);
$app->router->get('/products/view', [ProductsController::class, 'getConsumerProductOverviewPage']);
$app->router->get('/product-checkout', [ProductsController::class, 'getConsumerProductPayment']);
$app->router->post('/product-checkout', [ProductsController::class, 'getConsumerProductPayment']);
$app->router->get('/consumer-dashboard/products-overview', [ProductsController::class, 'getConsumerProductOverviewPage']);
$app->router->get('/consumer-dashboard/feedback',[FeedbacksController::class,'getConsumerFeedbackPage']);
$app->router->get('/consumer-dashboard/services/doctor', [ProfileController::class, 'getConsumerServicesDoctorPage']);
$app->router->get('/consumer-dashboard/services/doctor/profile', [ProfileController::class, 'getConsumerServicesDoctorProfilePage']);
$app->router->get('/consumer-dashboard/services/doctor/profile/payment', [ProfileController::class, 'getConsumerServicesDoctorProfilePaymentPage']);
$app->router->get('/consumer-dashboard/profile',[ProfileController::class,'getConsumerProfilePage']);
$app->router->get('/consumer-dashboard/services/pharmacy',[ConsumerController::class,'getPharmacyList']);
$app->router->get('/consumer-dashboard/services/pharmacy/payment-receipt',[ConsumerController::class,'getPharmacyPaymentReceipt']);
$app->router->get('/consumer-dashboard/service/pharmacy/pharmacy-dashboard',[ConsumerController::class,'getPharmacyDashboard']);
$app->router->get('/consumer-dashboard/services/care-rider/request/payment',[CareRiderController::class,'getCareRiderPaymentsPage']);
//  Run the application
$app->run();

?>

<!-- /=I am going to implement products update part -->