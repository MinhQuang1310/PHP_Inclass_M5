<?php
class ProductModel{
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }
    

    function readAll() {
        $query = "SELECT id, name, description, pricec, image FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getProductById($id)
    {
        $query = "SELECT * FROM ". $this->table_name." where id = $id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function createProduct($name, $description, $pricec, $image)
    {
        // Kiểm tra ràng buộc đầu vào
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        }
        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống';
        }
        if (!is_numeric($pricec) || $pricec < 0) {
            $errors['pricec'] = 'Giá sản phẩm không hợp lệ';
        }
        if ($image==false){
            $errors['image'] = 'Vui lòng chọn ảnh hợp lệ';
        }

        if (count($errors) > 0) {
            return $errors;
        }

        

        // Truy vấn tạo sản phẩm mới

        $query = "INSERT INTO " . $this->table_name . " (name, description, pricec, image) VALUES (:name, :description, :pricec, :image)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $pricec = htmlspecialchars(strip_tags($pricec));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':pricec', $pricec);
        $stmt->bindParam(':image', $image);


        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    

    public function updateProduct($id, $name, $description, $pricec, $image) {
        if($image){
            $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, pricec=:pricec, image=:image WHERE id=:id";
        }
        else {
            $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, pricec=:pricec WHERE id=:id";
        }
       
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $id = htmlspecialchars(strip_tags($id));
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $pricec = htmlspecialchars(strip_tags($pricec));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':pricec', $pricec);
        if($image){
            $stmt->bindParam(':image', $image);
        }
        
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}