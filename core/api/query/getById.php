<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");


require_once('../db/config.php');
require_once('../model/queries.php');


// connecting with database
$database = new Operations;
$conn = $database->get_config();

$customer = new QuerryModel($conn);


if(isset($_GET['customer_id']))
{
   $data = $customer->read_single_customer($_GET['customer_id']);
 
   if($data->rowCount()){
    $customers=[];
    
    while($row = $data->fetch(PDO::FETCH_OBJ))
    {
      
        $customers[$row->no_of_data] = [
           'no_of_data' => $row->no_of_data,
           'querry_id' => $row->querry_id,
           'querry' => $row->querry,
           'querry_status'=> $row->querry_status,
           'customer_id'=> $row->customer_id,
        ];
       
    }
    echo json_encode($customers);

   }
   else{
       echo json_encode(['message' => 'No customer data found']);
   }

}

?>