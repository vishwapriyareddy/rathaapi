<?php
error_reporting(E_ALL);
ini_set('display_error',1);

class QuerryModel{

    //customer properties
    public $no_of_data;
    public $querry_id;
    public $querry;
    public $querry_status;
    public $customer_id;    
    public $created_date;
    //database data
    private $connection;
    private $table ='customer_queries';

    public function  __construct($db){
        $this->connection = $db;
    }

    public function read_single_customer($no_of_data){
        $this->no_of_data = $no_of_data;

        $query = 'SELECT
        customer_queries.no_of_data,
        customer_queries.querry_id,
        customer_queries.querry,
        customer_queries.querry_status,
        customer_queries.customer_id,
        customer_queries.created_date
        FROM '.$this->table.' LEFT JOIN customer_table ON customer_queries.customer_id = customer_table.no_of_data
        WHERE customer_queries.customer_id=:customer_id
        ORDER BY customer_queries.created_date DESC';

        $customer = $this->connection->prepare($query);
       $customer->bindValue('customer_id',$this->no_of_data, PDO::PARAM_INT);

       $customer->execute();

        return $customer;
    }

    
    // function insertEmployee($querryData){ 		
    //     $querry_id=$querryData["querry_id"];
    //     $querry=$querryData["querry"];
    //     $querry_status=$querryData["querry_status"];		
        
    //     $empQuery="
    //         INSERT INTO ".$this->table." 
    //         SET querry_id='".$querry_id."', querry='".$querry."', skills='".$querry_status."'";

    //         $query_stmt = $this->connection->prepare($empQuery);
    //         $query_stmt->bindValue(':querry_id', $querry_id,PDO::PARAM_STR);
    //         $query_stmt->execute();
    //     if( mysqli_query($this->query_stmt, $empQuery)) {
    //         $messgae = "Querry created Successfully.";
    //         $status = 1;			
    //     } else {
    //         $messgae = "Querry creation failed.";
    //         $status = 0;			
    //     }
    //     $empResponse = array(
    //         'status' => $status,
    //         'status_message' => $messgae
    //     );
    //     header('Content-Type: application/json');
    //     echo json_encode($empResponse);
    // }
    public function insert($querry_id, $querry, $querry_status, $customer_id, $created_date) {
        $sql = 'INSERT INTO customer_queries (querry_id, querry, querry_status,customer_id,created_date) VALUES (:querry_id, :querry, :querry_status, :customer_id, :created_date)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['querry_id' => $querry_id, 'querry' => $querry, 'querry_status' => $querry_status,'customer_id' =>$customer_id,'created_date'=>$created_date]);
        return true;
      }
      public function test_input($data) {
	    $data = strip_tags($data);
	    $data = htmlspecialchars($data);
	    $data = stripslashes($data);
	    $data = trim($data);
	    return $data;
	  }  
      
      public function message($content, $status) {
	    return json_encode(['message' => $content, 'error' => $status]);
	  }



    //   function querryDetails($arr)
    //   {
    //      $query=  "INSERT INTO customer_queries (querry_id, querry, querry_status) VALUES (:querry_id, :querry, :querry_status)";
        
    //       $stmt = $this->connection->prepare($query);
  
    //       $data = $request['data'];
    //       foreach($arr as $item)
    //       {
    //           $stmt->bindValue(':querry_id', $item->querry_id);
    //           $stmt->bindValue(':querry', $item->querry);
    //           $stmt->bindValue(':querry_status', $item->querry_status);
    //         //  $stmt->bindValue(':OrderID', $item[3]);
  
    //         if($stmt->execute()){
    //           return true;
    //       }
    //       else{
    //          $arr = $stmt->errorInfo();
    //           print_r($arr);
    //       }
    //       }
    //   }
}
?>