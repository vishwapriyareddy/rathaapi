<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers:*");
header("Access-Control-Allow-Methods: GET, POST");

require_once('../db/config.php');
require_once('../model/Customer.php');

//connecting with database
$database = new Operations;
$conn = $database->get_config();

$customer = new CustomerModel($conn);

$customer->customer_email = isset($_GET['customer_email']) ? $_GET['customer_email'] :die();
$customer->customer_pass = base64_encode(isset($_GET['customer_pass'])?$_GET['customer_pass']:die());

$stmt = $customer->login();

if($stmt->rowCount() > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $customer_arr=array("status"=>true,
    "message"=>"Successfull Login",
    "customer_id"=>$row['customer_id'],
    "customer_email"=>$row['customer_email']);
}else{
    http_response_code(400);
    $customer_arr=array("status"=>false,
    "message"=>"Invalid email or password",
   );
}

print_r(json_encode($customer_arr));
$data = json_decode(file_get_contents('php://input'));

$customer_email='';
$customer_pass='';

if(isset($data)){
    $customer_email = $data->customer_email;
    $customer_pass = $data->customer_pass;
     
}
http_response_code(200);
if($customer_email&&$customer_pass){
    $json = $customers->auth($customer_email, $customer_pass);
     if($json){
         echo $json;
     }else{
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => 'Customer Account not found!'
        ]);
     }
}
//else{
//     echo json_encode([
//         'error' => true,
//         'message' => 'You are missing information!'
//     ]);
// }
?>