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
        echo "<li class='m-3'>$item->name 
            
            <form method='post' action='/sang5/cart/updateQuality/$item->id'>
                <a href='/sang5/cart/decreaseQuantity/$item->id' class='btn btn-primary'>-</a>
                <input name='quality' type='number' value='$item->quantity'/>
                <a href='/sang5/cart/increaseQuantity/$item->id' class='btn btn-primary'>+</a>
                <a href='/sang5/cart/removeItem/$item->id' class='btn btn-primary'>Remove</a>
            </form>
            
            </li>";
            
    }
    echo "<li class='m-3'><a href='/sang5/product/index' class='btn btn-primary'>Countinue shopping</a></li></hr>";
    echo "<li class='m-3'><a href='#' class='btn btn-primary'>Checkout</a></li>";
    echo "</ul>";

}


include_once 'app/views/share/footer.php';
?>
