<?php
class Operations
{   
    // private $db_name = 'u808660409_rathna_pharma';
    // private $db_username = 'u808660409_libsitservices';
    // private $db_password = 'Lead2022@';
    private $db_host = 'localhost';
    private $db_name = 'rathanadb';
    private $db_username = 'root';
    private $db_password = '';
    private $connection = null;
    public function get_config()
    {
      
        try {
            $connection = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_username, $this->db_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            echo "Issue -> Connection failed: " . $e->getMessage();
            exit;
        }
    
    }

}