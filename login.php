<?php
session_start();

$conn = new mysqli("localhost", "root", "", "testdb");
if ($conn->connect_error) { die("DB error"); }

$error = "";

if (isset($_POST['login'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];

    $q = "SELECT * FROM users WHERE username='$u' AND password='$p'";
    $r = $conn->query($q);

    if ($r->num_rows == 1) {
        $_SESSION['user'] = $u;
    } else {
        $error = "Invalid login";
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
body { font-family: Arial; background: #f5f5f5; }
.box {
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

<div class="box">
<?php if (!isset($_SESSION['user'])) { ?>

<h3>Login</h3>
<?php if ($error) echo "<p class='error'>$error</p>"; ?>

<form method="POST">
    <input type="text" name="username" placeholder="Enter Username" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <button name="login">Login</button>
</form>

<?php } else { ?>

<h3>Welcome, <?php echo $_SESSION['user']; ?></h3>
<form method="POST">
    <button name="logout">Logout</button>
</form>

<?php } ?>
</div>

</body>
</html>
