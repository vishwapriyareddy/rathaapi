<?php
error_reporting(E_ALL);
ini_set('display_error',1);

class QueryModel{

    //customer properties
    public $no_of_data;
    public $query_id;
    public $query;
    public $query_status;
    public $customer_id;    
    public $created_date;
    //database data
    private $connection;
    private $table ='customer_query';

    public function  __construct($db){
        $this->connection = $db;
    }

    public function read_single_customer($customer_id){
        $this->customer_id = $customer_id;

        $query = 'SELECT
        customer_query.no_of_data,
        customer_query.query_id,
        customer_query.query,
        customer_query.query_status,
        customer_query.customer_id,
        customer_query.created_date
        FROM '.$this->table.' LEFT JOIN customer_table ON customer_query.customer_id = customer_table.customer_id
        WHERE customer_query.customer_id=:customer_id
        ORDER BY customer_query.created_date DESC';

        $customer = $this->connection->prepare($query);
       $customer->bindValue('customer_id',$this->customer_id, PDO::PARAM_STR);

       $customer->execute();

        return $customer;
    }
    
    public function insert($query_id, $query, $query_status, $customer_id, $created_date) {
       if ($query_id!=""&&$query!=""&&$query_status!=""&&$customer_id!=""&&$created_date!="") {
           $sql = 'INSERT INTO customer_query (query_id, query, query_status,customer_id,created_date) VALUES (:query_id, :query, :query_status, :customer_id, :created_date)';
           $stmt = $this->connection->prepare($sql);
           $stmt->execute(['query_id' => $query_id, 'query' => $query, 'query_status' => $query_status,'customer_id' =>$customer_id,'created_date'=>$created_date]);
           return true;
       }else{
        return false;
       }
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



}
?>