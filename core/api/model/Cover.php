<?php
error_reporting(E_ALL);
ini_set('display_error',1);

class CoverModel{

    //customer properties
    public $no_of_data;
    public $id;
    public $type;
    public $courier_no;
    public $company_name;
    public $customer_name;
    public $customer_city;
    public $customer_id;
    public $comments;
    public $customer_querry;
    public $transport_name;
    public $created_date;

    //database data
    private $connection;
    private $table ='cover';

    public function  __construct($db){
        $this->connection = $db;
    }

    public function read_single_customer($customer_id){
        $this->customer_id = $customer_id;
        
        $query = 'SELECT
        cover.no_of_data,
        cover.type,
        cover.courier_no,
        cover.company_name,
        cover.customer_name,
        cover.customer_city,
        cover.customer_id,
        cover.comments,
        cover.transport_name,
        cover.created_date
        FROM '.$this->table.' LEFT JOIN customer_table ON cover.customer_id = customer_table.customer_id
        WHERE cover.customer_id=:customer_id
        ORDER BY cover.created_date DESC';

        $customer = $this->connection->prepare($query);
        $customer->bindValue('customer_id',$this->customer_id, PDO::PARAM_STR);

      $customer->execute();
     
      return $customer;
    }

}
?>