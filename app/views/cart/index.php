<?php
include_once 'app/views/share/header.php';

// Kiểm tra xem session cart có tồn tại không
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Giỏ hàng trống!";
} else {
    $total = 0;
    $totalAll = 0;
    $cartItems = $_SESSION['cart'];
    // Hiển thị danh sách sản phẩm trong giỏ hàng
    echo "<h2>Danh sách giỏ hàng</h2>";
    echo "<ul>";
    foreach ($cartItems as $item) {
        $total = $item->pricec * $item->quantity;
        echo "<li class='m-3'> $item->name 
            
            <form method='post' action='/sang5/cart/updateQuantity/$item->id'>
            <tr>
                <td>
                    
                    <a href='/sang5/cart/decreaseQuantity/$item->id' class='btn btn-primary'>-</a>
                
                    <input name='quantity' type='number' value='$item->quantity'/> <!-- Changed name to quantity -->
                
                    <input name='price' type='number' value='$total'/>

                    <a href='/sang5/cart/increaseQuantity/$item->id' class='btn btn-primary'>+</a>
                </td>
                <td>
                    <a href='/sang5/cart/removeItem/$item->id' class='btn btn-primary'>Remove</a>
                </td>
            </tr>
            </form>
            
            </li>";
            $totalAll += $total;           
    }
    echo "<p class='text-danger'>Total price: <input name='price' type='number' value='$totalAll'/></p>";
    echo "<li class='m-3'><a href='/sang5/product/index' class='btn btn-primary'>Countinue shopping</a></li></hr>";
    echo "<li class='m-3'><a href='/sang5/order/index' class='btn btn-primary'>Checkout</a></li>";
    echo "</ul>";
    $_SESSION['cartItems'] = $cartItems;
    $_SESSION['totalAll'] = $totalAll;
    $_SESSION['total'] = $total;
}

include_once 'app/views/share/footer.php';
?>