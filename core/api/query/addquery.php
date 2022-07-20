<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json");
header('Access-Control-Allow-Headers: X-Requested-With');
header("Access-Control-Allow-Methods: GET");

require_once('../db/config.php');

// connecting with database
$database = new Operations;
$conn = $database->get_config();
$requestMethod = $_SERVER["REQUEST_METHOD"];
require_once('../model/query.php');
$querr = new QueryModel($conn);

$api = $_SERVER['REQUEST_METHOD'];
if (($api == 'POST')) {
    
  
    $query = $querr->test_input($_POST['query']);
    $query_status = $querr->test_input($_POST['query_status']);
    $customer_id = $querr->test_input($_POST['customer_id']);
    $created_date = $querr->test_input($_POST['created_date']);


    if ($querr->insert( $query, $query_status, $customer_id, $created_date)) {
        echo $querr->message('query added successfully!', false);
    } else {
          echo $querr->message('Failed to add an query!', true);
    }

  }
?>