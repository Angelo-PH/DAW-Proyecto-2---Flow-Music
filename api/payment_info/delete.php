<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Payment_info.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Payment_info object
$payment_info = new Payment_info($db);

// Get payment_id from URL parameters
$payment_info->payment_id = isset($_GET['payment_id']) ? $_GET['payment_id'] : die();

// Delete Payment_info
if ($payment_info->delete()) {
    echo json_encode(
        array('message' => 'Información de pago eliminada exitosamente.')
    );
} else {
    echo json_encode(
        array('message' => 'Error al eliminar la información de pago.')
    );
}
?>
