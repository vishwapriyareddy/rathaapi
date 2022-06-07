<!-- <?php
error_reporting(E_ERROR);
header("Access-Control-Allow-Orgin:*");
header("Access-Control-Allow-Header: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD']!= 'GET') :
     http_response_code(405);
     echo json_encode([
         'success' => 0,
         'message' => 'Bad Request Detected Only get method is allowed',
     ]);
     exit;
    endif;
    
require_once('../db/config.php');

$database = new Operations;
$conn = $database->get_config();


if (isset($_GET['no_of_data'])) {
     $customer_id = filter_var($_GET['no_of_data'],FILTER_VALIDATE_INT,[
        'options' => [
            'default' => 'all_customers',
            'min_range' => 1
        ]
    ]);
  }

try {
    $sql = is_numeric($customer_id) ? "SELECT * FROM `customer_table` WHERE id='$customer_id'":
    "SELECT * FROM `customer_table`";
    $smt = $conn->prepare($sql);
    
    $smt->execute();

    if ($smt->rowCount() > 0) :
        $data  = null;
    if (is_numeric($customer_id)) {
        $data = $smt -> fetch(PDO::FETCH_ASSOC);
    } else {
        $data= $smt -> fetchAll(PDO::FETCH_ASSOC);
    }
    echo json_encode([
            'success' => 1,
            'data' => $data
        ]); else:
        echo json_encode([
            'success' => 0,
            'message' => 'No record Found!'
        ]);
    endif;
}
 catch(PDOException $e){
     http_response_code(500);
     echo json_encode([
    'success' => 0,
    'message' => $e->getMessage()
]);
 
     exit;
 }

?> -->