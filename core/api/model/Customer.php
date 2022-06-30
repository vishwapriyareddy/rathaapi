<?php
error_reporting(E_ALL);
ini_set('display_error',1);
class CustomerModel{

    //customer properties
    public $no_of_data;
    public $customer_id;
    public $customer_name;
    public $customer_email;
    public $customer_pass;
    public $customer_city;
    public $customer_status;
    public $otp_code;

    //database data
    private $connection;
    private $table ='customer_table';

    public function  __construct($db){
        $this->connection = $db;
    }

    public function read_single_customer($customer_id){
        $this->customer_id = $customer_id;

        $query = 'SELECT
        customer_table.no_of_data,
        customer_table.customer_id,
        customer_table.customer_name,
        customer_table.customer_email,
        customer_table.customer_pass,
        customer_table.customer_city,
        customer_table.customer_status,
        FROM '.$this->table.'
        WHERE customer_table.customer_id=:customer_id
        LIMIT 0,1';

        $customer = $this->connection->prepare($query);
       $customer->bindValue('customer_id',$this->customer_id, PDO::PARAM_STR);

       $customer->execute();

        return $customer;
    }

  
    public function login(){
        $query = "SELECT `customer_id`,`customer_email`,`customer_pass` 
        FROM ".$this->table."
        WHERE customer_email='".$this->customer_email."' AND customer_pass='".$this->customer_pass."' ";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function checkEmail(){
        $query = "SELECT `customer_email` 
        FROM ".$this->table."
        WHERE customer_email='".$this->customer_email."'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }  
    public function forgotPassword($customer_email){
        if(($customer_email!="")){
            $this->customer_email = $customer_email;

            $rand = rand(999999, 111111);

            $query ="UPDATE customer_table SET otp_code = '$rand' WHERE customer_email='".$this->customer_email."'";

            $customer = $this->connection->prepare($query);

            $check= $customer->execute();
 
            return array("status"=>$check,"otp"=>$rand);
        }
        else{
            return array("status"=> "Please fill the email");

        }
    }

    public function newPassword($customer_email,$customer_pass){
      $this->customer_email = $customer_email;
      $password = base64_encode($customer_pass);

      $query ="UPDATE customer_table SET customer_pass = '$password' WHERE customer_email='".$this->customer_email."'";

      $customer = $this->connection->prepare($query);
      
      $check= $customer->execute();

      return array("status"=>$check,"customer_pass"=>$password);
  
    }
    
}
?>