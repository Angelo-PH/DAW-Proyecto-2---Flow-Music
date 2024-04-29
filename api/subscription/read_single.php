<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Subscription.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate subscription object
$subscription = new Subscription($db);

// Get ID
$subscription->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

// Get subscription
$subscription->read_single();

// Create array
$subscription_arr = array(
    'subscription_id' => $subscription->subscription_id,
     'user_id' => $subscription->user_id,
     'subscription_type' => $subscription->subscription_type,
     'start_date' => $subscription->start_date,
     'end_date' => $subscription->end_date,
     'status' => $subscription->status
);

// Make JSON
print_r(json_encode($subscription_arr));
