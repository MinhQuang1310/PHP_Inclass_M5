<?php
class OrderDetailModel{
    private $conn;
    private $table_name = "order_detail";

    public function __construct($db) {
        $this->conn = $db;
    }

    function save($nameproduct, $quantity, $pricec, $address, $total) {
        $error=[];
        if(count($error) > 0){
            return $error;
        }
    }

    public function createOrderDetail($nameproduct, $quantity, $pricec, $address, $total)
    {

        // Truy vấn tạo sản phẩm mới
        $query = "INSERT INTO " . $this->table_name . " (nameproduct, quantity, pricec, address, total) VALUES (:nameproduct, :quantity, :pricec, :address, :total)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($nameproduct));
        $phone = htmlspecialchars(strip_tags($quantity));
        $email = htmlspecialchars(strip_tags($pricec));
        $address = htmlspecialchars(strip_tags($address));
        $total = htmlspecialchars(strip_tags($total));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':name', $nameproduct);
        $stmt->bindParam(':phone', $quantity);
        $stmt->bindParam(':email', $pricec);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':total', $total);


        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
}