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
   $data = $customer->forgotPassword($_REQUEST['customer_email']);
  //  if($data->rowCount()){
  //   $customers=[];
    
    // while($row = $data->fetch(PDO::FETCH_OBJ))
    // {

      list($check,$rand)=isset($data); 
  //    echo json_encode($check);
      // if($data==true){

      //   $to = $this->customer_email;
      //   $subject = 'Your OTP is';
      //   $message = '<h1>OTP : <b style="color:blue">'. $rand .'</b><h1>';
      //   $header = 'From:rathna@gmail.com';      
      //   mail($to,$subject,$message,$header);
      
    
      //  }else{
      //   echo json_encode(['message' => 'The mail cannot be sent']);
      //  }
   echo json_encode($data);

  //  }
  //  else{
  //      echo json_encode(['message' => 'No customer data found']);
  //  }
}

?> 
