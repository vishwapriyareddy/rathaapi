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

$customer->customer_email = isset($_GET['customer_email']) ? $_GET['customer_email'] :die();


$stmt = $customer->checkEmail();

if($stmt->rowCount() > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(isset($_REQUEST['customer_email']))
{
   $data = $customer->forgotPassword($_REQUEST['customer_email']);
       
    list($check,$rand)=isset($data); 
       
      if($data==true){
        // $to = $this->customer_email;
        // $subject = 'Your OTP is';
        // $message = '<h1>OTP : <b style="color:blue">$data['otp']</b><h1>';
        // $header = 'From:vishwapriyareddy24798@gmail.com';      
        // mail($to,$subject,$message,$header);
        echo json_encode($data);
       }else{
        echo json_encode(['message' => 'The mail cannot be sent']);
       }
}

   
}else{
    http_response_code(400);
    echo json_encode(["status"=>false,
    "message"=>"Invalid email",
   ]);
}

?> 
