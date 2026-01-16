<?php
include "auth.php";
include "db.php";

// CREATE ORDER
if(isset($_POST['add'])){
    $customer = $_POST['customer'];
    $coffee = $_POST['coffee'];
    $size = $_POST['size'];
    $qty = $_POST['qty'];

    $stmt = $conn->prepare(
        "INSERT INTO coffee_orders(customer_name, coffee_type, size, quantity) 
         VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("sssi", $customer, $coffee, $size, $qty);
    $stmt->execute();
}

// DELETE ORDER
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM coffee_orders WHERE id=$id");
}

// READ ORDERS
$result = $conn->query("SELECT * FROM coffee_orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Coffee Orders</title>
<style>
body{
    font-family:Segoe UI;
    background:#f5f2ee;
    padding:40px;
}
.container{
    max-width:1000px;
    margin:auto;
    background:#4b3a3a;
    padding:30px;
    border-radius:14px;
    color:#fff;
}
input, select, button{
    padding:10px;
    margin:5px;
    border-radius:6px;
}
table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}
th, td{
    padding:10px;
    border:1px solid #ccc;
    text-align:center;
}
a{
    color:#ffd700;
}
button{
    background:#d9a066;
    border:none;
    font-weight:bold;
}
</style>
</head>

<body>
<div class="container">
<h2>☕ Coffee Shop Orders</h2>

<!-- CREATE FORM -->
<form method="POST">
    <input type="text" name="customer" placeholder="Customer Name" required>

    <select name="coffee" required>
        <option value="">Select Coffee</option>
        <option>Americano</option>
        <option>Latte</option>
        <option>Cappuccino</option>
        <option>Mocha</option>
    </select>

    <select name="size" required>
        <option value="">Size</option>
        <option>Small</option>
        <option>Medium</option>
        <option>Large</option>
    </select>

    <input type="number" name="qty" min="1" placeholder="Qty" required>

    <button name="add">Add Order</button>
</form>

<!-- READ TABLE -->
<table>
<tr>
    <th>ID</th>
    <th>Customer</th>
    <th>Coffee</th>
    <th>Size</th>
    <th>Qty</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['customer_name'] ?></td>
    <td><?= $row['coffee_type'] ?></td>
    <td><?= $row['size'] ?></td>
    <td><?= $row['quantity'] ?></td>
    <td>
        <a href="edit_order.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this order?')">Delete</a>
    </td>
</tr>
<?php } ?>
</table>

<br>
<a href="dashboard.php">  Back to Dashboard</a>
</div>
</body>
</html>
