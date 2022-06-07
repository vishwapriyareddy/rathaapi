<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

require '../../db/config.php';
require '../../model/Customer.php';


// connecting with database
$database = new Operations;
$conn = $database->get_config();

$customer = new CustomerModel($conn);


if(isset($_GET['no_of_data']))
{
   $data = $customer->read_single_customer($_GET['no_of_data']);
 
   if($data->rowCount()){
    $customers=[];
    
    while($row = $data->fetch(PDO::FETCH_OBJ))
    {
      if($row->customer_status){
        $customers[$row->no_of_data] = [
           'no_of_data' => $row->no_of_data,
           'customer_name' => $row->customer_name,
           'customer_email'=> $row->customer_email,
           'customer_pass'=> $row->customer_pass,
           'customer_city'=> $row->customer_city,
           'customer_status'=> $row->customer_status,
           'GST_NO'  => $row->GST_NO,
        ];
      } 
    }
    echo json_encode($customers);

   }
   else{
       echo json_encode(['message' => 'No post data found']);
   }

}

?>