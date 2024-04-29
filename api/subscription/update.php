<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Subscription.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$subscription = new Subscription($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$subscription->subscription_id  = $data->subscription_id ;
$subscription->user_id  = $data->user_id ;
$subscription->subscription_type = $data->subscription_type;
$subscription->start_date = $data->start_date;
$subscription->end_date = $data->end_date;
$subscription->status = $data->status;

// Update post
if ($subscription->update()) {
    echo json_encode(
        array('message' => 'Suscripcion Actualizada')
    );
} else {
    echo json_encode(
        array('message' => 'Suscripcion No Actualizada')
    );
}
