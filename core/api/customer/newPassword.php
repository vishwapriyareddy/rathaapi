<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

require_once('../db/config.php');
require_once('../model/Customer.php');

// connecting with database
$database = new Operations;
$conn = $database->get_config();


$customer = new CustomerModel($conn);

if(isset($_REQUEST['customer_email']))
{
   $data = $customer->newPassword($_REQUEST['customer_email'],$_REQUEST['customer_pass']);
      list($check,$password)=isset($data); 
     echo json_encode($data);
}
?>