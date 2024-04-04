<?php
include_once 'app/views/share/header.php';

// Kiểm tra xem session cart có tồn tại không
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Giỏ hàng trống!";
} else {
    // Hiển thị danh sách sản phẩm trong giỏ hàng
    echo "<h2>Danh sách giỏ hàng</h2>";
    echo "<ul>";
    foreach ($_SESSION['cart'] as $item) {
        $total = $item->pricec * $item->quantity;
        echo "<li class='m-3'>$item->name 
            
            <form method='post' action='/php_inclass_m5/cart/updateQuality/$item->id'>
                <a href='/php_inclass_m5/cart/decreaseQuantity/$item->id' class='btn btn-primary'>-</a>
                <input name='quality' type='number' value='$item->quantity'/>
                <a href='/php_inclass_m5/cart/increaseQuantity/$item->id' class='btn btn-primary'>+</a>
                <a href='/php_inclass_m5/cart/removeItem/$item->id' class='btn btn-primary'>Remove</a>
                <p class='h4 text-danger'>$total</p>
            </form>
            
            </li>";
            
    }
    echo "<li class='m-3'><a href='/php_inclass_m5/product/index' class='btn btn-primary'>Countinue shopping</a></li></hr>";
    echo "<li class='m-3'><a href='#' class='btn btn-primary'>Checkout</a></li>";
    echo "</ul>";
    echo "<a href='/php_inclass_m5' class='btn btn-primary'>Back site</a>";
}


include_once 'app/views/share/footer.php';
?>
