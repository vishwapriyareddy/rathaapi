<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

require '../../db/config.php';
require '../../model/Lrupdate.php';


// connecting with database
$database = new Operations;
$conn = $database->get_config();

$customer = new LrupdateModel($conn);


if(isset($_GET['customer_id']))
{
   $data = $customer->read_single_customer($_GET['customer_id']);
 
   if($data->rowCount()){
    $customers=[];
    
    while($row = $data->fetch(PDO::FETCH_OBJ))
    {
      
        $customers[$row->no_of_data] = [
           'no_of_data' => $row->no_of_data,
           'company_name'=>$row->company_name,
           'no_of_boxes'=>$row->no_of_boxes,
           'transport_name'=>$row->transport_name,
           'courier_no' => $row->courier_no,
           'customer_id'=> $row->customer_id,
           'customer_name'=> $row->customer_name,
           'invoice_number'  => $row->invoice_number,
           'customer_city'  => $row->customer_city,
           'invoice_date'  => $row->invoice_date,
           'invoice_value'=>$row->invoice_value,
           'booking_person'=>$row->booking_person,
           'lr_no'=>$row->lr_no,
           'lr_date'=>$row->lr_date,
           'cheque_no'=>$row->cheque_no,
           'cheque_date'=>$row->cheque_date,
           'eway_bill_no'=>$row->eway_bill_no,
           'weight'=>$row->weight,
           'comments'=>$row->comments,
           'created_date'=>$row->created_date
        ];
       
    }
    echo json_encode($customers);

   }
   else{
       echo json_encode(['message' => 'No LR Updations data found']);
   }

}
?>