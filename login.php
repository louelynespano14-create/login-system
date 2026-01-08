<?php
session_start();
include "db.php";

$msg = ""; // message variable

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = hash("sha256", $_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $msg = "Account does not exist or password is incorrect!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
*{
    box-sizing:border-box;
}

body{
    background:#f5f2ee; 
    font-family: 'Segoe UI', Arial, sans-serif;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
}

.box{
    background:#4b3a3a; 
    padding:40px 35px;
    border-radius:16px;
    width:360px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,.4);
}

h2{
    color:#f5eee6;
    margin-bottom:16px;
    font-size:24px;
}

.msg{
    color:#f87171; 
    font-size:15px;
    margin-bottom:12px;
    font-weight:500;
}

input{
    width:100%; 
    padding:12px;
    margin:10px 0; 
    border-radius:8px;
    border:1px solid #6b4f4f; 
    background:#3b2f2f; 
    color:#f5eee6; 
    font-size:14px;
}

input::placeholder{
    color:#c9b49a; 
}

input:focus{
    outline:none;
    border-color:#d9a066; 
}

button{
    background:#d9a066; 
    border:none;
    padding:12px;
    width:100%;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
    color:#3b2f2f; 
    margin-top:14px;
    font-size:16px;
    transition:.2s;
}

button:hover{
    opacity:.9;
}

p{
    color:#f5eee6; 
    font-size:14px;
    margin-top:18px;
}

a{
    color:#d9a066; 
    text-decoration:none;
    font-weight:500;
}

a:hover{
    text-decoration:underline;
}
</style>
</head>

<body>
<div class="box">
    <h2>Log in</h2>
    <?php if($msg != "") { echo "<p class='msg'>$msg</p>"; } ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Log in</button>
    </form>

    <p>No account? <a href="signup.php">Sign up</a></p>
</div>
</body>
</html>
