<?php
class AccountController
{
    private $accountModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }
    // public function Login() {

    //     $database = new Database();
    //     $db = $database->getConnection();

    //     include_once 'app/views/users/login.php';

    // }
    public function Register() {

        $database = new Database();
        $db = $database->getConnection();

        include_once 'app/views/users/register.php';

    }
    public function Save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $firstname = $_POST['firstname'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $email = $_POST['email'] ??'';
            $password = $_POST['password'] ??'';
            $confirmpassword = $_POST['comfirmpassword'] ?? '';



            // if(isset($_POST['id'] )) {
            //     $id = $_POST['id'];
            // }

            // if (!empty($_FILES["image"]['size'])) {
            //     $uploadresult = $this->uploadImage($_FILES["image"]);
            // }

            // if(isset($id)) {
            //     $result = $this->accountModel->updateAccount($id, $firstname, $lastname, $email , $password);
            // }
            // else{
            //     $result = $this->productModel->createProduct($name, $description, $pricec, $uploadresult);
            // }

            $result =  $this->accountModel->createAccount($firstname, $lastname, $email, $password, $confirmpassword);
            if (is_array($result)) {
                $errors = $result;
                include_once 'app/views/users/register.php'; 
            } else {
                header('Location: /Sang5/Product/Index');
            }
        }
    }

    public function updateAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $firstname = $_POST['firstname'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $email = $_POST['email'] ??'';
            $password = $_POST['password'] ??'';
            // $confirmpassword = $_POST['confirmpassword'] ?? '';
            // $uploadresult = false;

            // if (!empty($_FILES["image"]['size'])) {
            //     $uploadresult = $this->uploadImage($_FILES["image"]);
            // }
            $edit = $this->accountModel->updateAccount($id, $firstname, $lastname, $email, $password);

            if ($edit) {
                header('Location: /Sang5/Product/Index');
            } else {
                //thuc hien tuong tu nhu ham luu
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }
    public function Login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
    
            // Kiểm tra xem email và mật khẩu có trống không
            if(empty($email) || empty($password)){
                $error = "Email or Password cannot be empty!";
                include_once 'app/views/users/login.php';
                return;
            }
    
            // Gọi phương thức kiểm tra tài khoản từ model
            $account = $this->accountModel->checkAccount($email, $password);
    
            if ($account) {
                // Nếu tài khoản tồn tại, đặt cookie và chuyển hướng người dùng
                setcookie('user', serialize($account), time() + (86400 * 30), "/"); // 86400 = 1 day
                header('Location: /Sang5/Product/Index');
            } else {
                // Nếu tài khoản không tồn tại, hiển thị lỗi
                $error = "Invalid Email or Password!";
                include_once 'app/views/users/login.php';
            }
        } else {
            include_once 'app/views/users/login.php';
        }
    }
    
    
    
}