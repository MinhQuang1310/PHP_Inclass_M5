<?php
class CartController
{

    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function updateQuality($productId)
    {
      // Check if cart session exists
      if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        header('Location: /php_inclass_m5/cart/show'); // Redirect to cart view if empty
      }
    
      // Validate form data
      if (!isset($_POST['action']) || $_POST['action'] !== 'update') {
        header('Location: /php_inclass_m5/cart/show'); // Redirect on invalid action
      }
    
      $originalQuantity = (int) $_POST['originalQuantity']; // Cast to integer
      $newQuantity = (int) ($_POST['quantity'] ?? $originalQuantity); // Use submitted quantity or original if not provided
    
      // Validate new quantity (optional): Ensure it's not negative and minimum of 1
      if ($newQuantity < 1) {
        $newQuantity = 1; // Set minimum quantity to 1 (optional)
      }
    
      // Update quantity in cart session
      foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem->id == $productId) {
          $cartItem->quantity = $newQuantity;
          break;
        }
      }
    
      // Redirect back to cart view
      header('Location: /php_inclass_m5/cart/show');
    }
    
    // public function updateQuality($id)
    // {
    //     $newQuantity = $_POST['quality'];
    //     foreach ($_SESSION['cart'] as &$item) {
    //         if ($item->id == $id) {
    //             $item->quantity = $newQuantity;

    //             break;
    //         }
    //     }
    //     header('Location: /php_inclass_m5/cart/show');
    // }
    public function decreaseQuantity($id)
    {
        // Start the session if not already started
        if (!isset($_SESSION)) {
            session_start();
        }

        // Check if the cart session exists and is not empty
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            // Loop through the cart items
            foreach ($_SESSION['cart'] as &$item) {
                if ($item->id == $id) {
                    // Decrease the quantity by 1 if it's greater than 1
                    if ($item->quantity > 1) {
                        $item->quantity--;
                    }
                    break;
                }
            }
        }

        // Redirect back to the cart page or wherever appropriate
        header('Location: /php_inclass_m5/cart/show');
        exit();
    }

    public function increaseQuantity($id)
    {
        // Start the session if not already started
        if (!isset($_SESSION)) {
            session_start();
        }

        // Check if the cart session exists and is not empty
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            // Loop through the cart items
            foreach ($_SESSION['cart'] as &$item) {
                if ($item->id == $id) {
                    // Increase the quantity by 1
                    $item->quantity++;
                    break;
                }
            }
        }

        // Redirect back to the cart page or wherever appropriate
        header('Location: /php_inclass_m5/cart/show');
        exit();
    }
    public function Add($id)
    {
        // Khởi tạo một phiên cart nếu chưa tồn tại
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Lấy sản phẩm từ ProductModel bằng $id
        $product = $this->productModel->getProductById($id);
        $product->quantity = 1;
        // Nếu sản phẩm tồn tại, thêm vào giỏ hàng
        if ($product) {
            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            $productExist = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item->id == $id) {
                    $item->quantity++;
                    $productExist = true;
                    break;
                }
            }
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới vào
            if (!$productExist) {
                $product->quantity = 1;
                $_SESSION['cart'][] = $product;
            }

            header('Location: /php_inclass_m5/cart/show');
        } else {
            echo "Không tìm thấy sản phẩm với ID này!";
        }
    }
    public function removeItem($id)
    {
        // Start the session if not already started
        if (!isset($_SESSION)) {
            session_start();
        }

        // Check if the cart session exists and is not empty
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            // Loop through the cart items
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item->id == $id) {
                    // Remove the item from the cart
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
        }

        // Redirect back to the cart page or wherever appropriate
        header('Location: /php_inclass_m5/cart/show');
        exit();
    }
    function show()
    {
        include_once 'app/views/cart/index.php';
    }
}
