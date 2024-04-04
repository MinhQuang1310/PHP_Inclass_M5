<?php
class ProductController{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }
    public function Index() {

        $database = new Database();
        $db = $database->getConnection();

        $product = new ProductModel($db);
        
        $stmt = $product->readAll();

        include_once 'app/views/product/list.php';
        

    }
    public function add() {
        include_once 'app/views/product/add.php';
    }


    public function uploadImage($file) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Kiểm tra xem file có phải là hình ảnh thực sự hay không
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    
        // Kiểm tra kích thước file
        if ($file["size"] > 500000) { // Ví dụ: giới hạn 500KB
            $uploadOk = 0;
        }
    
        // Kiểm tra định dạng file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }
    
        // Kiểm tra nếu $uploadOk bằng 0
        if ($uploadOk == 0) {
            return false;
        } else {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return $targetFile;
            } else {
                return false;
            }
        }
    }
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $pricec = $_POST['pricec'] ?? '';
            $uploadresult = false;

            if(isset($_POST['id'] )) {
                $id = $_POST['id'];
            }

            if (!empty($_FILES["image"]['size'])) {
                $uploadresult = $this->uploadImage($_FILES["image"]);
            }

            if(isset($id)) {
                $result = $this->productModel->updateProduct($id, $name, $description, $pricec , $uploadresult);
            }
            else{
                $result = $this->productModel->createProduct($name, $description, $pricec, $uploadresult);
            }
            if (is_array($result)) {
                $errors = $result;
                include_once 'app/views/product/add.php'; // Đường dẫn đến file form sản phẩm
            } else {
                header('Location: /php_inclass_m5/Product/Index');
            }
        }
    }
    public function edit($id)
    {
        $product = $this->productModel->getProductById($id);

        if ($product) {
            include_once 'app/views/product/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $pricec = $_POST['pricec'];
            $description = $_POST['description'];
            $uploadresult = false;

            if (!empty($_FILES["image"]['size'])) {
                $uploadresult = $this->uploadImage($_FILES["image"]);
            }
            $edit = $this->productModel->updateProduct($id, $name, $description, $pricec, $uploadresult);

            if ($edit) {
                header('Location: /php_inclass_m5/Product/Index');
            } else {
                //thuc hien tuong tu nhu ham luu
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }
}