<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json");
header('Access-Control-Allow-Headers: X-Requested-With');
header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once('../db/config.php');

// connecting with database
$database = new Operations;
$conn = $database->get_config();
$requestMethod = $_SERVER["REQUEST_METHOD"];
require_once('../model/queries.php');
$querr = new QuerryModel($conn);

$api = $_SERVER['REQUEST_METHOD'];
if ($api == 'POST') {
    $querry_id = $querr->test_input($_POST['querry_id']);
    $querry = $querr->test_input($_POST['querry']);
    $querry_status = $querr->test_input($_POST['querry_status']);
    $customer_id = $querr->test_input($_POST['customer_id']);
    if ($querr->insert($querry_id, $querry, $querry_status,$customer_id)) {
      echo $querr->message('querry added successfully!',false);
    } else {
      echo $querr->message('Failed to add an querry!',true);
    }
  }


//   $a = file_get_contents("php://input");
// $data = json_decode($a, true);

// if($querr->querryDetails($data)){

//     http_response_code(200);
//     echo json_encode(array(
//         "message" => "All rows of querry Details are inserted.",

//     ));
// }
// else{

//     http_response_code(400);
//     echo json_encode(array("message" => "Sorry! Error while inserting rows of querry details"));
// }


?>