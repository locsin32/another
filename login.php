<?php
session_start();

// Hardcoded credentials (example)
$valid_username = "admin";
$valid_password = "12345";

$error = "";

// When form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; }
        .login-box {
            width: 300px; padding: 20px; background: white;
            margin: 100px auto; border-radius: 10px; 
            box-shadow: 0px 0px 10px #ccc;
        }
        input { width: 100%; padding: 10px; margin-top: 10px; }
        button { width: 100%; padding: 10px; margin-top: 15px; }
        .error { color: red; margin-top: 10px; }
    </style>
</head>
<body>

<div class="login-box">
    <h3>Login</h3>

    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
