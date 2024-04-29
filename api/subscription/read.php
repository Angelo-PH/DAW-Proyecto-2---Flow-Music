<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Subscription.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog Subscription object
$subscription = new Subscription($db);

// Blog Usuario query
$result = $subscription->read();
// Get row count
$num = $result->rowCount();

// Check if any Usuario
if ($num > 0) {
    // Usuario array
    $subscription_arr = array();
    // $usuarios_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $subscription_item = array(
            'subscription_id' => $subscription_id,
            'user_id' => $user_id,
            'subscription_type' => $subscription_type,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => $status,
        );

        // Push to "data"
        array_push($subscription_arr, $subscription_item);
        // array_push($usuarios_arr['data'], $usuarios_item);
    }

    // Turn to JSON & output
    echo json_encode($subscription_arr);
} else {
    // No User.
    echo json_encode(
        array('message' => 'No se han encontrado Suscripciones.')
    );
}
