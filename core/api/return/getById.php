<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

require '../../db/config.php';
require '../../model/Returns.php';


// connecting with database
$database = new Operations;
$conn = $database->get_config();

$customer = new ReturnsModel($conn);


if(isset($_GET['customer_id']))
{
   $data = $customer->read_single_customer($_GET['customer_id']);
 
   if($data->rowCount()){
    $customers=[];
    
    while($row = $data->fetch(PDO::FETCH_OBJ))
    {
      
        $customers[$row->no_of_data] = [
           'no_of_data' => $row->no_of_data,
           'type'=>$row->type,
           'courier_no'=>$row->courier_no,
           'customer_name'=>$row->customer_name,
           'customer_id' => $row->customer_id,
           'no_of_boxes'=> $row->no_of_boxes,
           'LR_date'=> $row->LR_date,
           'company_name'=>$row->company_name,
           'transport_name'  => $row->transport_name,
           'customer_city'  => $row->customer_city,
           'box_no'  => $row->box_no,
           'created_date'=>$row->created_date
        ];
       
    }
    echo json_encode($customers);

   }
   else{
       echo json_encode(['message' => 'No returns data found']);
   }

}
?>