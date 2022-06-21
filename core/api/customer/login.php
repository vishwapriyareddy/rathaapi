<?php
error_reporting(E_ALL);
ini_set('display_error',1);

header("Access-Control-Allow-Orgin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers:*");
header("Access-Control-Allow-Methods: GET, POST");

require_once('../db/config.php');
require_once('../model/Customer.php');

//$conn = mysqli_connect('localhost','root','','rathanadb');
// private $db_name = 'u808660409_rathna_pharma';
    // private $db_username = 'u808660409_libsitservices';
    // private $db_password = 'Lead2022@';

    //connecting with database
$database = new Operations;
$conn = $database->get_config();

  $customer = new CustomerModel($conn);

//  $customer_email = $_POST['customer_email'];

//  $customer_pass =base64_encode($_POST['customer_pass']);

//  $sql = "SELECT * FROM customer_table WHERE customer_email ='".$customer_email."' AND customer_pass ='".$customer_pass."'";
 
//  $result = mysqli_query($conn,$sql);
//  $count = mysqli_num_rows($result);

//  if($count == 1){
//      echo json_encode('Success');
//  }else{
//      echo json_encode("failed");
//  }

$customer->customer_email = isset($_GET['customer_email']) ? $_GET['customer_email'] :die();

$customer->customer_pass = base64_encode(isset($_GET['customer_pass'])?$_GET['customer_pass']:die());

//$customer->customer_email = $_REQUEST['customer_email'];
//$customer->customer_pass = base64_encode($_REQUEST['customer_pass']);


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

// function msg($success,$status,$message,$extra = []){
//     return array_merge([
//         'success' => $success,
//         'status' => $status,
//         'message' => $message
//     ],$extra);
// }

// $data = json_decode(file_get_contents("php://input"));
// $returnData = [];

// // IF REQUEST METHOD IS NOT EQUAL TO POST
// if($_SERVER["REQUEST_METHOD"] != "POST"):
//     $returnData =   msg(0,404,'Page Not Found!');

// // CHECKING EMPTY FIELDS
// elseif(!isset($data->customer_email) 
//     || !isset($data->customer_pass)
//     || empty(trim($data->customer_email))
//     || empty(trim($data->customer_pass))
//     ):

//    // $fields = ['fields' => ['customer_email','customer_pass']];
//  //$returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);

// // IF THERE ARE NO EMPTY FIELDS THEN-
// else:
//     $customer_email = trim($data->customer_email);
//     $customer_pass = trim($data->customer_pass);

//     // CHECKING THE customer_EMAIL FORMAT (IF INVALID FORMAT)
//     if(!filter_var($customer_email, FILTER_VALIDATE_EMAIL)):
//         $returnData = msg(0,422,'Invalid Email Address!');
    
//     // IF customer_PASS IS LESS THAN 8 THE SHOW THE ERROR
//     elseif(strlen($customer_pass) < 8):
//         $returnData = msg(0,422,'Your password must be at least 8 characters long!');

//     // THE USER IS ABLE TO PERFORM THE LOGIN ACTION
//     else:
//         try{
            
//             $fetch_user_by_email = "SELECT * FROM `customer_table` WHERE `customer_email`=:customer_email";
//             $query_stmt = $conn->prepare($fetch_user_by_email);
//             $query_stmt->bindValue(':customer_email', $customer_email,PDO::PARAM_STR);
//             $query_stmt->execute();

//             // IF THE USER IS FOUNDED BY EMAIL
//             if($query_stmt->rowCount()):
//                 $row = $query_stmt->fetch(PDO::FETCH_ASSOC);
//                 $check_password = password_verify($customer_pass, $row['customer_pass']);

//                 // VERIFYING THE PASSWORD (IS CORRECT OR NOT?)
//                 // IF PASSWORD IS CORRECT THEN SEND THE LOGIN TOKEN
//                 if($check_password):

//                     // $jwt = new JwtHandler();
//                     // $token = $jwt->jwtEncodeData(
//                     //     'http://localhost/php_auth_api/',
//                     //     array("user_id"=> $row['id'])
//                     // );
                    
//                     $returnData = [
//                         'success' => 1,
//                         'message' => 'You have successfully logged in.',
//                         //'token' => $token
//                     ];

//                 // IF INVALID PASSWORD
//                 else:
//                     $returnData = msg(0,422,'Invalid Password!');
//                 endif;

//             // IF THE USER IS NOT FOUNDED BY EMAIL THEN SHOW THE FOLLOWING ERROR
//             else:
//                 $returnData = msg(0,422,'Invalid Email Address!');
//             endif;
//         }
//         catch(PDOException $e){
//             $returnData = msg(0,500,$e->getMessage());
//         }


//     endif;

// endif;

// echo json_encode($returnData);





// try{
//     $database = new Operations;
// $conn = $database->get_config();
//     $hash_password= $customer->customer_pass=(isset($_POST['customer_pass'])); //Password encryption 
//     $stmt = $conn->prepare("SELECT * FROM customer_table WHERE (customer_email=:customer_email ) AND customer_pass=:hash_password");
//     $stmt->bindParam("customer_email", $customer_email,PDO::PARAM_STR) ;
//     $stmt->bindParam("customer_pass", $hash_password,PDO::PARAM_STR) ;
//     $stmt->execute();
//     $count=$stmt->rowCount();
//     $data=$stmt->fetch(PDO::FETCH_OBJ);
//     $conn = null;
//     if($count)
//     {
//     $_SESSION['uid']=$data->uid; // Storing user session value
//     return true;
//     }
//     else
//     {
//     return false;
//     }
//     }
//     catch(PDOException $e) {
//     echo '{"error":{"text":'. $e->getMessage() .'}}';
//     }
    
?>