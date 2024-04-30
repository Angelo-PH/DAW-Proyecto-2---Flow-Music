<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Payment_info.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Payment_info object
$payment_info = new Payment_info($db);

// Get ID from URL
$payment_info->payment_id = isset($_GET['payment_id']) ? $_GET['payment_id'] : die();

// Get single Payment_info
$payment_info->read_single();

// Create array
$payment_info_arr = array(
    'payment_id' => $payment_info->payment_id,
    'user_id' => $payment_info->user_id,
    'cardholder_name' => $payment_info->cardholder_name,
    'card_number' => $payment_info->card_number,
    'expiry_month' => $payment_info->expiry_month,
    'expiry_year' => $payment_info->expiry_year,
    'created_at' => $payment_info->created_at
);

// Make JSON response
echo json_encode($payment_info_arr);
?>
