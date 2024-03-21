<?php
class AccountModel{
    private $conn;
    private $table_name = "account";

    public function __construct($db) {
        $this->conn = $db;
    }
    

    // function readAll() {
    //     $query = "SELECT id, firstname, lastname, email, password, image FROM " . $this->table_name;

    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();

    //     return $stmt;
    // }


    function save($firstname, $lastname, $email, $password, $confirmpassword) {
        $error=[];
        if(empty($firstname)){
            $error['firstname'] = "Please enter your First Name!";
        }
        if(empty($lastname)){
            $error['lastname'] = "Please enter your Last Name!";
        }
        if(empty($email)){
            $error['email'] = "Please enter your Email!";
        }
        if(empty($password)){
            $error['password'] = "Please enter Password!";
        }
        if(empty($confirmpassword)){
            $error['comfirmpassword'] = "Please confirm your Password!";
        }
        if(count($error) > 0){
            return $error;
        }
    }

    // public function getAccountById($id)
    // {
    //     $query = "SELECT * FROM ". $this->table_name." where id = $id";

    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->fetch(PDO::FETCH_OBJ);
    //     return $result;
    // }

    public function createAccount($firstname, $lastname, $email, $password, $comfirmpassword)
    {
        // Kiểm tra ràng buộc đầu vào
        $error=[];
        if(empty($firstname)){
            $error['firstname'] = "Please enter your First Name!";
        }
        if(empty($lastname)){
            $error['lastname'] = "Please enter your Last Name!";
        }
        if(empty($email)){
            $error['email'] = "Please enter your Email!";
        }
        if(empty($password)){
            $error['password'] = "Please enter Password!";
        }
        if(empty($comfirmpassword)){
            $error['comfirmpassword'] = "Please confirm your Password!";
        }
        if(count($error) > 0){
            return $error;
        }

        // Mã hóa mật khẩu
        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

        // Truy vấn tạo sản phẩm mới
        $query = "INSERT INTO " . $this->table_name . " (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $firstname = htmlspecialchars(strip_tags($firstname));
        $lastname = htmlspecialchars(strip_tags($lastname));
        $email = htmlspecialchars(strip_tags($email));
        $password = htmlspecialchars(strip_tags($password));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);


        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    

    public function updateAccount($id, $firstname, $lastname, $email, $password) {
        // if($image){
        //     $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, pricec=:pricec, image=:image WHERE id=:id";
        // }
        // else {
        //     $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, pricec=:pricec WHERE id=:id";
        // }
        $query = "UPDATE " . $this->table_name . " SET firstname=:firstname, lastname=:lastname, email=:email, password=:password WHERE id=:id";
       
        $stmt = $this->conn->prepare($query);

        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        // Làm sạch dữ liệu
        $id = htmlspecialchars(strip_tags($id));
        $firstname = htmlspecialchars(strip_tags($firstname));
        $lastname = htmlspecialchars(strip_tags($lastname));
        $email = htmlspecialchars(strip_tags($email));
        $password = htmlspecialchars(strip_tags($password));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        // if($image){
        //     $stmt->bindParam(':image', $image);
        // }
        
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}