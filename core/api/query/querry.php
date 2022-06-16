<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json");
header('Access-Control-Allow-Headers: X-Requested-With');
header("Access-Control-Allow-Methods: GET");


require_once('../../db/config.php');



// connecting with database
$database = new Operations;
$conn = $database->get_config();
//$requestMethod = $_SERVER["REQUEST_METHOD"];
require_once('../../model/queries.php');
$querr = new QuerryModel($conn);

$api = $_SERVER['REQUEST_METHOD'];
if ($api == 'POST') {
    $querry_id = $querr->test_input($_POST['querry_id']);
    $querry = $querr->test_input($_POST['querry']);
    $querry_status = $querr->test_input($_POST['querry_status']);

    if ($querr->insert($querry_id, $querry, $querry_status)) {
      echo $querr->message('querry added successfully!',false);
    } else {
      echo $querr->message('Failed to add an querry!',true);
    }
  }



?>