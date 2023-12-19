<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>
<body>

<h2>Login Form</h2>
    
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" name="login" value="Login">
</form>

<?php
$admin = ['username' => 'admin', 'password' => '123123']; //add user admin voi password
$user = ['username' => 'user', 'password' => '123456']; //user thuong

if (isset($_POST['login'])) {
    $usr = "";
    $role = "";
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == $admin['username'] && $password == $admin['password']){
        $usr = $admin['username'];
        $role = "Admin";
    }elseif ($username == $user['username'] && $password == $user['password']){
        $usr = $user['username'];
        $role = "User";
    }else{
        echo "Sai tên đăng nhập hoặc mật khẩu.";
    }
    if (!empty($role)) { //điều kiện: role không bỏ trống.
        echo "Welcome, $usr! You are logged in as $role.";
    }
}
?>

</body>
</html>