<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register Forms</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .forms-container {
            display: flex;
            justify-content: space-around;
            max-width: 1100px;
            font-weight: bold;
            margin: auto;
            padding: 20px;
        }

        .form-section {
            width: 45%;
        }

        label {
            font-size: 14px;
            margin-left: 50px;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],input[type="password"] {
            width: 80%;
            padding: 10px;
            margin-left: 50px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .checkbox-group {
            margin-left: 50px;
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        button {
            margin:auto;
            position: static;
            padding: 8px;
            display: flex;
        }

        #btn{  
            font-size: 14px;  
            top: 50%;
            margin: 0;
        } 

        select{
            margin-left:50px;
            padding: 9px;
            width: 100px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 30px;
        }

        .form-row{
            display: inline-block;
        }

        h3{
            margin-left:50px;
        }

        #input1{
            margin-left: 30px;
            width: 260px;
        }
    </style>
</head>
<body>
    <div class="forms-container">
        <div class="form-section">
            <h2>Login</h2>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="username">Username:</label>
                <input type="text" name="username" id="login-username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="login-password" required>

                <div class="checkbox-group">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me" id = "btn">Remember Me</label>
                </div>

                <button type="submit" name="login">Log in</button>
            </form>
        </div>

        <div class="form-section">
            <h2>Register</h2>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="register-username">User Name</label>
                <input type="text" name="register-username" id="register-username" required>

                <label for="register-email">User Email *</label>
                <input type="text" name="register-email" id="register-email" required>

                <div class="form-row">
                    <label for="cars">Select Title</label>
                    <select name="cars" id="cars">
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                    </select>
                </div>

                <div class="form-row">
                    <label id = "input1" forms-containeror="register-name">Full Name *</label>
                    <input id = "input1" type="text" name="register-name" id="register-username" required>
                </div>

                <h3>Company Detail</h3>

                <label for="register-companyname">Company Name</label>
                <input type="text" name="register-companyname" id="register-companyname" required>

                <div class="checkbox-group">
                    <input type="checkbox" id="confirm" name="confirm" required>
                    <label for="confirm" id = "btn">I am agree with registration</label>
                </div>

                <button type="submit" name="register-submit">Register</button>
            </form>
        </div>
    </div>

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
        echo "<script type='text/javascript'>alert('Sai tên đăng nhập hoặc mật khẩu.');</script>";
    }
    if (!empty($role)) { //điều kiện: role không bỏ trống.
        echo "<script type='text/javascript'>alert('Welcome, $usr! You are logged in as $role.');</script>";
    }
}
?>
</body>
</html>