<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");


require_once('../db/config.php');
require_once('../model/query.php');


// connecting with database
$database = new Operations;
$conn = $database->get_config();

$customer = new QueryModel($conn);


if(isset($_GET['customer_id']))
{
   $data = $customer->read_single_customer($_GET['customer_id']);
 
   if($data->rowCount()>0){
    $customers=array();
    $customers['query_data']=array();
    
    while($row = $data->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $customer_item = array(
            'no_of_data' => $no_of_data,
            'query_id' => $query_id,
            'query' => $query,
            'query_status'=> $query_status,
            'customer_id'=> $customer_id,
        );
      
       //Push to data
     array_push($customers['query_data'],$customer_item);  
       
    }
    echo json_encode($customers);

   }
   else{
       echo json_encode(['message' => 'No customer data found']);
   }

}

?>