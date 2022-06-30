<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

require_once('../db/config.php');
require_once('../model/Cover.php');

// connecting with database
$database = new Operations;
$conn = $database->get_config();

$customer = new CoverModel($conn);

if(isset($_GET['customer_id']))
{
   $data = $customer->read_single_customer($_GET['customer_id']);
 
   if($data->rowCount()>0){
    $customers=array();
    $customers['cover_data']=array();
    
    while($row = $data->fetch(PDO::FETCH_ASSOC))
    { 
      extract($row);
      $customer_item = array(
           'no_of_data' => $no_of_data,
           'cover_type'=>$cover_type,
           'courier_no'=>$courier_no,
           'company_name'=>$company_name,
           'customer_id'=> $customer_id,
           'comment'=>$comment,
           'transport_name'  => $transport_name,
           'created_date'=>$created_date
      );

     //Push to data
     array_push($customers['cover_data'],$customer_item);
    }
    echo json_encode($customers);
    }
     else{
       echo json_encode(['message' => 'No Cover data found']);
     }
}
?>