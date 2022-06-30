<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

require_once('../db/config.php');
require_once('../model/Lrupdate.php');

// connecting with database
$database = new Operations;
$conn = $database->get_config();

$customer = new LrupdateModel($conn);

if(isset($_GET['customer_id']))
{
   // $data =$_GET['customer_id'];

$data = $customer->read_single_customer($_GET['customer_id']);
 
   if($data->rowCount()>0){
    $customers=array();
    $customers['lrupdate_data']=array();
    
    while($row = $data->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $customer_item = array(
            'no_of_data' => $no_of_data,
            'lr_id' =>$lr_id,
            'company_name'=>$company_name,
            'no_of_boxes'=>$no_of_boxes,
            'transport_name'=>$transport_name,
            'courier_no' => $courier_no,
            'customer_id'=> $customer_id,
            'customer_name'=> $customer_name,
            'invoice_number'  => $invoice_number,
            'customer_city'  => $customer_city,
            'invoice_date'  => $invoice_date,
            'invoice_value'=>$invoice_value,
            'booking_person'=>$booking_person,
            'lr_no'=>$lr_no,
            'lr_date'=>$lr_date,
            'cheque_no'=>$cheque_no,
            'cheque_date'=>$cheque_date,
            'eway_bill_no'=>$eway_bill_no,
            'weight'=>$weight,
            'comments'=>$comments,
            'created_date'=>$created_date
       );
        //Push to data
     array_push($customers['lrupdate_data'],$customer_item); 
       
    }
    echo json_encode($customers);

}
   else{
       echo json_encode(['message' => 'No LR Updations data found']);
   }

 }
?>