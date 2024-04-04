<?php
include_once 'app/views/share/header.php';

$totalAll = $_SESSION['totalAll'];
$cartItems = $_SESSION['cartItems'];
$total = 0;
// Hiển thị danh sách sản phẩm trong giỏ hàng
echo "<h2>Your Order</h2>";
echo "<ul>";
foreach ($cartItems as $item) {
    $total = $item->pricec * $item->quantity;
    echo "<li class='m-3'>
            <th>
                <td>
                    <p>Ten hang:       
                        <input readonly name='name' type='text' value='$item->name'/> 
                    </p>
                    <p>So luong:
                        <input readonly name='quantity' type='number' value='$item->quantity'/> 
                    </p> 
                    <p>Gia tien: 
                        <input readonly name='price' type='number' value='$item->pricec'/>
                    </p>
                </td>
            </th>
        </li>";

}
echo "<p class='text-danger'>Total price: <input name='price' type='number' value='$totalAll'/></p>";

echo "<i><a href='/sang5/order/confirm' class='btn btn-primary'>Payment</a></i>";

include_once 'app/views/share/footer.php';
?>