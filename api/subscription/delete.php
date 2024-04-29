<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Subscription.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog Usuario object
$subscription = new Subscription($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set usuario_id to update
$subscription->subscription_id = $data->subscription_id;

// Delete Usuario
if ($subscription->delete()) {
  echo json_encode(
    array('message' => 'Suscripcion Eliminada')
  );
} else {
  echo json_encode(
    array('message' => 'Suscripcion No Eliminada')
  );
}
