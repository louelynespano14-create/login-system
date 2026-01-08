<?php
include "auth.php"; 
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
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

h1 {
    color: #f5eee6; 
    font-size: 26px;
    margin-bottom: 20px;
}

p {
    color: #f5eee6;
    font-size: 16px;
    margin-bottom: 30px;
}

a.logout {
    display: inline-block;
    background: #d9a066; 
    color: #3b2f2f;
    padding: 12px 25px;
    text-decoration: none;
    font-weight: bold;
    border-radius: 8px;
    transition: 0.2s;
}

a.logout:hover {
    opacity: 0.9;
}
</style>
</head>
<body>
<div class="container">
    <h1>Welcome, <?php echo $_SESSION['user']; ?> 🎉</h1>
    <p>This page is protected.</p>
    <a href="logout.php" class="logout">Logout</a>
</div>
</body>
</html>
