<?php
class OrderController {
    private $db;

    public function __construct()
    {
        // Establish a database connection
        $this->db = (new Database())->getConnection();
    }
    public function Index() {

        include_once 'app/views/order/orderdetail.php';
    }
    
    public function confirm(){
        include_once 'app/views/order/order.php';
    }
    public function add(){
        
    }
}
?>
