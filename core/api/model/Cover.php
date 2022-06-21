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

    public function read_single_customer($no_of_data){
        $this->no_of_data = $no_of_data;

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
        FROM '.$this->table.' LEFT JOIN customer_table ON cover.customer_id = customer_table.no_of_data
        WHERE cover.customer_id=:customer_id
        ORDER BY cover.created_date DESC';

        $customer = $this->connection->prepare($query);
       $customer->bindValue('customer_id',$this->no_of_data, PDO::PARAM_INT);

       $customer->execute();

        return $customer;
    }

    // function updateCustomer($customer){ 		
    //     if($customer["id"]) {
    //         $customer_querry=$customer["customer_querry"];
          
    //         $customerQuery="
    //             UPDATE ".$this->table." 
    //             SET customer_querry='".$customer_querry."'' 
    //             WHERE id = '".$customer["id"]."'";
    //             echo $customerQuery;
    //         if( mysqli_query($this->dbConnect, $customerQuery)) {
    //             $messgae = "Employee updated successfully.";
    //             $status = 1;			
    //         } else {
    //             $messgae = "Employee update failed.";
    //             $status = 0;			
    //         }
    //     } else {
    //         $messgae = "Invalid request.";
    //         $status = 0;
    //     }
    //     $customerResponse = array(
    //         'status' => $status,
    //         'status_message' => $messgae
    //     );
    //     header('Content-Type: application/json');
    //     echo json_encode($customerResponse);
    // }
     
}
?>