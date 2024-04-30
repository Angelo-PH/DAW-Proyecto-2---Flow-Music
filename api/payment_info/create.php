<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Payment_info.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Payment_info object
$payment_info = new Payment_info($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Assign data to Payment_info object properties
$payment_info->user_id = $data->user_id;
$payment_info->cardholder_name = $data->cardholder_name;
$payment_info->card_number = $data->card_number;
$payment_info->expiry_month = $data->expiry_month;
$payment_info->expiry_year = $data->expiry_year;

// Create Payment_info
if ($payment_info->create()) {
    echo json_encode(
        array('message' => 'Información de pago creada exitosamente.')
    );
} else {
    echo json_encode(
        array('message' => 'Error al crear la información de pago.')
    );
}
?>
