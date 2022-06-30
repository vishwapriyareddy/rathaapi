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

if(isset($_GET['customer_id']))
{
   $data = $customer->read_single_customer($_GET['customer_id']);
 
   if($data->rowCount()>0){
    $customers=array();
    $customers['customer_getById']=array();
   
    while($row = $data->fetch(PDO::FETCH_ASSOC))
    {
      extract($row);
      $customer_item = array(
        'no_of_data' => $no_of_data,
        'customer_id' => $customer_id,
        'customer_name' => $customer_name,
        'customer_email'=> $customer_email,
        'customer_city'=> $customer_city,
        'customer_status'=> $customer_status,
     );
     //Push to data
    array_push($customers['customer_getById'],$customer_item); 
    }
    echo json_encode($customers);
   }
   else{
       echo json_encode(['message' => 'No customer data found']);
   }
}

?>