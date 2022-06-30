<?php
error_reporting(E_ALL);
ini_set('display_error',1);

class LrupdateModel{

    //customer properties
    public $no_of_data;
    public $lr_id;
    public $company_name;
    public $no_of_boxes;
    public $transport_name;
    public $courier_no;
    public $customer_id;
    public $customer_name;
    public $customer_city;
    public $invoice_number;
    public $invoice_date;
    public $invoice_value;
    public $booking_person;
    public $lr_no;
    public $lr_date;
    public $cheque_no;
    public $cheque_date;
    public $eway_bill_no;
    public $weight;
    public $comments;
    public $created_date;

    //database data
    private $connection;
    private $table ='lr_updation';

    public function  __construct($db){
        $this->connection = $db;
    }

    public function read_single_customer($customer_id){
        $this->customer_id = $customer_id;

        $query = 'SELECT
        lr_updation.no_of_data,
        lr_updation.lr_id,
        lr_updation.company_name,
        lr_updation.no_of_boxes,
        lr_updation.transport_name,
        lr_updation.courier_no,
        lr_updation.customer_id,
        lr_updation.customer_name,
        lr_updation.customer_city,
        lr_updation.invoice_number,
        lr_updation.invoice_date,
        lr_updation.invoice_value,
        lr_updation.booking_person,
        lr_updation.lr_no,
        lr_updation.lr_date,
        lr_updation.cheque_no,
        lr_updation.cheque_date,
        lr_updation.eway_bill_no,
        lr_updation.weight,
        lr_updation.comments,
        lr_updation.created_date
        FROM '.$this->table.' LEFT JOIN customer_table ON lr_updation.customer_id = customer_table.customer_id
        WHERE lr_updation.customer_id=:customer_id
        ORDER BY lr_updation.created_date DESC';

        $customer = $this->connection->prepare($query);
        $customer->bindValue('customer_id',$this->customer_id, PDO::PARAM_STR);

       $customer->execute();

        return $customer;
    }
}
?>