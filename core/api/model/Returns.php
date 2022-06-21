<?php
error_reporting(E_ALL);
ini_set('display_error',1);

class ReturnsModel{

    //customer properties
    public $no_of_data;
    public $type;
    public $courier_no;
    public $customer_name;
    public $customer_id;
    public $no_of_boxes;
    public $LR_date;
    public $company_name;
    public $transport_name;
    public $company_city;
    public $box_no;
    public $created_date;

    //database data
    private $connection;
    private $table ='returns_table';

    public function  __construct($db){
        $this->connection = $db;
    }

    public function read_single_customer($no_of_data){
        $this->no_of_data = $no_of_data;

        $query = 'SELECT
        returns_table.no_of_data,
        returns_table.type,
        returns_table.courier_no,
        returns_table.customer_name,
        returns_table.customer_id,
        returns_table.no_of_boxes,
        returns_table.LR_date,
        returns_table.company_name,
        returns_table.transport_name,
        returns_table.customer_city,
        returns_table.box_no,
        returns_table.created_date
        FROM '.$this->table.' LEFT JOIN customer_table ON returns_table.customer_id = customer_table.no_of_data
        WHERE returns_table.customer_id=:customer_id
        ORDER BY returns_table.created_date DESC';

        $customer = $this->connection->prepare($query);
       $customer->bindValue('customer_id',$this->no_of_data, PDO::PARAM_INT);

       $customer->execute();

        return $customer;
    }

   
}
?>