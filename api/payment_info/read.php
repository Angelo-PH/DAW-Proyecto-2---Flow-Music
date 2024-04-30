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

// Payment_info query
$result = $payment_info->read();
// Get row count
$num = $result->rowCount();

// Check if any Payment_info
if ($num > 0) {
    // Payment_info array
    $payment_infos_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $payment_info_item = array(
            'payment_id' => $payment_id,
            'user_id' => $user_id,
            'cardholder_name' => $cardholder_name,
            'card_number' => $card_number,
            'expiry_month' => $expiry_month,
            'expiry_year' => $expiry_year,
            'created_at' => $created_at
        );

        // Push to "data"
        array_push($payment_infos_arr, $payment_info_item);
    }

    // Turn to JSON & output
    echo json_encode($payment_infos_arr);
} else {
    // No Payment_info found
    echo json_encode(
        array('message' => 'No se han encontrado registros de información de pago.')
    );
}
?>
