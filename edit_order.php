<?php
include "auth.php";
include "db.php";

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM coffee_orders WHERE id=$id");
$order = $result->fetch_assoc();

if(isset($_POST['update'])){
    $customer = $_POST['customer'];
    $coffee = $_POST['coffee'];
    $size = $_POST['size'];
    $qty = $_POST['qty'];

    $conn->query("UPDATE coffee_orders 
        SET customer_name='$customer',
            coffee_type='$coffee',
            size='$size',
            quantity='$qty'
        WHERE id=$id
    ");

    header("Location: orders.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Coffee Order</title>
<style>
* {
    box-sizing: border-box;
}

body {
    background: #f5f2ee;
    font-family: 'Segoe UI', Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: #4b3a3a;
    padding: 40px 35px;
    border-radius: 16px;
    width: 400px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,.4);
}

h2 {
    color: #f5eee6;
    font-size: 26px;
    margin-bottom: 20px;
}

input, select {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #6b4f4f;
    background: #3b2f2f;
    color: #f5eee6;
    font-size: 14px;
}

input::placeholder, select option {
    color: #c9b49a;
}

input:focus, select:focus {
    outline: none;
    border-color: #d9a066;
}

button {
    background: #d9a066;
    border: none;
    padding: 12px;
    width: 100%;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    color: #3b2f2f;
    margin-top: 14px;
    font-size: 16px;
    transition: .2s;
}

button:hover {
    opacity: .9;
}

a {
    display: inline-block;
    margin-top: 15px;
    color: #d9a066;
    text-decoration: none;
    font-weight: 500;
}

a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>
<div class="container">
    <h2>Edit Coffee Order</h2>

    <form method="POST">
        <input type="text" name="customer" value="<?= $order['customer_name'] ?>" placeholder="Customer Name" required>

        <select name="coffee" required>
            <option value="">Select Coffee</option>
            <option <?= $order['coffee_type'] == 'Americano' ? 'selected' : '' ?>>Americano</option>
            <option <?= $order['coffee_type'] == 'Latte' ? 'selected' : '' ?>>Latte</option>
            <option <?= $order['coffee_type'] == 'Cappuccino' ? 'selected' : '' ?>>Cappuccino</option>
            <option <?= $order['coffee_type'] == 'Mocha' ? 'selected' : '' ?>>Mocha</option>
        </select>

        <select name="size" required>
            <option value="">Select Size</option>
            <option <?= $order['size'] == 'Small' ? 'selected' : '' ?>>Small</option>
            <option <?= $order['size'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
            <option <?= $order['size'] == 'Large' ? 'selected' : '' ?>>Large</option>
        </select>

        <input type="number" name="qty" value="<?= $order['quantity'] ?>" placeholder="Quantity" min="1" required>

        <button name="update">Update Order</button>
    </form>

    <a href="orders.php"> Back to Orders</a>
</div>
</body>
</html>
