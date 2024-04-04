<?php
include_once 'app/views/share/header.php';

$totalAll = $_SESSION['totalAll'];
$cartItems = $_SESSION['cartItems'];
$total = 0;
// Hiển thị danh sách sản phẩm trong giỏ hàng
echo "<h2>Confirm information</h2>";
echo "<li class='m-3'>
        <form method='post' action='/sang5/order/add'>
            <th>
                <td>
                    <p>Ho ten:       
                        <input  name='name' type='text'/> 
                    </p>
                    <p>SDT:       
                        <input  name='name' type='phone'/> 
                    </p>
                    <p>Email:       
                        <input  name='name' type='text'/> 
                    </p>
                    <p>Address:       
                        <input  name='name' type='text'/> 
                    </p>
                    <p>Total:       
                        <input readonly name='name' type='text' value = '$totalAll'/> 
                    </p>
                </td>
            </th>
            <i><input type='submit' class='btn btn-primary'></input></i>
        </form>
        </li>";
// echo "<i><a href='#' class='btn btn-primary'>Confirm purchage</a></i>";





include_once 'app/views/share/footer.php';
?>