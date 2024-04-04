<?php
class OderModel{
    private $conn;
    private $table_name = "oders";

    public function __construct($db) {
        $this->conn = $db;
    }

    function save($name, $phone, $email, $address, $total) {
        $error=[];
        if(empty($phone)){
            $error['name'] = "Please enter your Phone!";
        }
        if(empty($address)){
            $error['lastname'] = "Please enter your Email!";
        }
        if(count($error) > 0){
            return $error;
        }
    }

    public function createOder($name, $phone, $email, $address, $total)
    {
        // Kiểm tra ràng buộc đầu vào
        $error=[];
        if(empty($address)){
            $error['address'] = "Please enter your address!";
        }
        if(empty($email)){
            $error['email'] = "Please enter your email!";
        }

        // Truy vấn tạo sản phẩm mới
        $query = "INSERT INTO " . $this->table_name . " (name, phone, email, address, total) VALUES (:name, :phone, :email, :address, :total)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $phone = htmlspecialchars(strip_tags($phone));
        $email = htmlspecialchars(strip_tags($email));
        $address = htmlspecialchars(strip_tags($address));
        $total = htmlspecialchars(strip_tags($total));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':total', $total);


        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
}