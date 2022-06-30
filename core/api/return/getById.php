<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

require_once('../db/config.php');
require_once('../model/Returns.php');

// connecting with database
$database = new Operations;
$conn = $database->get_config();

$customer = new ReturnsModel($conn);

if(isset($_GET['customer_id']))
{
   $data = $customer->read_single_customer($_GET['customer_id']);
 
   if($data->rowCount()>0){
    $customers=array();
    $customers['returns_data']=array();
    
    while($row = $data->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $customer_item = array( 'no_of_data' => $no_of_data,
        'type'=>$type,
        'courier_no'=>$courier_no,
        'customer_name'=>$customer_name,
        'customer_id' => $customer_id,
        'no_of_boxes'=> $no_of_boxes,
        'LR_date'=> $LR_date,
        'company_name'=>$company_name,
        'transport_name'  => $transport_name,
        'customer_city'  => $customer_city,
        'box_no'  => $box_no,
        'created_date'=>$created_date);
     
        //Push to data
        array_push($customers['returns_data'],$customer_item);    
       
    }
    echo json_encode($customers);

   }
   else{
       echo json_encode(['message' => 'No returns data found']);
   }

}
?>