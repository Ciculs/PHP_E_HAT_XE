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

        p{
            margin-left: 10%;
            position: static;
            color:#8d8d91;
            font-size: 15px;
            margin-bottom: 5px;
            font-weight:normal;
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
                <input type="text" name="username" id="login-username" pattern ="[A-Za-z0-9]+" title = "Sai định dạng" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="login-password" required>

                <div class="checkbox-group">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me" name = "remember-me" id = "btn">Remember Me</label>
                </div>

                <button type="submit" name="login">Log in</button>
            </form>
        </div>

        <div class="form-section">
            <h2>Register</h2>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="register-username">User Name</label>
                <input type="text" name="register-username" id="register-username" placeholder="JohnWeak1234" pattern ="[A-Za-z0-9]+" title = "Sai định dạng" required>

                <label for="register-email">User Email *</label>
                <input type="text" name="register-email" id="register-email" placeholder="@gmail.com" required>

                <label for="register-password">Password</label>
                <input type="password" name="register-password" id="register-password" placeholder="Password" required>

                <label for="register-cfpassword">Confirm Password</label>
                <input type="password" name="register-cfpassword" id="register-cfpassword" placeholder="Confirm password" required>

                <div class="form-row">
                    <label for="cars">Select Title</label>
                    <select name="cars" id="cars">
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                    </select>
                </div>

                <div class="form-row">
                    <label id = "input1" forms-containeror="register-name">Full Name *</label>
                    <input id = "input1" placeholder="John Weak" type="text" name="register-name" id="register-username" pattern="[a-zA-Z]+.{2,}" title="Tối thiểu 2 kí tự và tiếng việt không dấu." required>
                </div>

                <h3>Company Detail</h3>

                <p>Provide detail about your company</p>

                <label for="register-companyname">Company Name</label>
                <input type="text" name="register-companyname" id="register-companyname" pattern ="[A-Za-z0-9]+" title = "Sai định dạng"required>

                <div class="checkbox-group">
                    <input type="checkbox" id="confirm" name="confirm" required>
                    <label for="confirm" id = "btn">I am agree with registration</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="admin" name="admin">
                    <label for="admin" name ='admin' id = "btn">Admin user</label>
                </div>

                <button type="submit" name="register">Register</button>
            </form>
        </div>
    </div>

<?php
//MYSQL
$host = "sql12.freemysqlhosting.net";
$username = "sql12671566";
$password = "LGfIY14PwP";
$database = "sql12671566";
$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    echo "<script type='text/javascript'>alert('Connection Failed.');</script>";
}

if (isset($_POST['login'])) {
    $usr = "";
    $role = "";
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($dbUsername, $dbPassword, $dbrole);
        $stmt->fetch();

        if ($password == $dbPassword) {
            $usr = $dbUsername;
            $role = $dbrole;
        } else {
            echo "<script type='text/javascript'>alert('Incorrect password.');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('User not found.');</script>";
    }

    $stmt->close();

    if (isset($_POST['remember-me']) && !empty($role)) {
        $hashedPassword = md5($password);
        setcookie('is_logged', true, time() + 3600, '/');
        setcookie('username_logged', $username, time() + 3600, '/');
        setcookie("password", $hashedPassword, time() + 3600, '/');
        $cookies = $_COOKIE['password'];
        echo "<script type='text/javascript'>alert('Welcome, $usr! You are logged in as $role.Site remembered your cookies.This is your cookies:$cookies.');</script>";
    }elseif(!empty($role)) {
        echo "<script type='text/javascript'>alert('Welcome, $usr! You are logged in as $role.');</script>";
    }
}

if (isset($_POST['register'])){
    $username = $_POST['register-username'];
    $password = $_POST['register-password'];
    $cfpassword = $_POST['register-cfpassword'];
    $email = $_POST['register-email'];
    $fullname = $_POST['register-name'];
    $company = $_POST['register-companyname'];

    function isExists($email, $username, $conn) {
        $stmt = $conn->prepare("SELECT username, email FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    if (isset($_POST['admin'])) {
        $roletest = 'admin';
    }else{
        $roletest = "user";
    }
    
    //func
    function isStrongPassword($password) {
        //uppercase
        if (!preg_match('/[A-Z]/', $password)) { 
            return false;
        }
        
        //lowercase
        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }
    
        //special character
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            return false;
        }
    
        //1 số
        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }
    
        //8 characters
        if (strlen($password) < 8) {
            return false;
        }
        return true;
    }

    if(!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $username) && $user){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (isExists($email, $username, $conn)) {
                echo "<script type='text/javascript'>alert('Exists.');</script>";
            } else {
                if (isStrongPassword($password)) {
                    if ($cfpassword != $password){
                        echo "<script type='text/javascript'>alert('Confirm password and password not the same.');</script>";
                    }else{
                        $sql = "INSERT INTO users (username, password, email, company, fullname, role) VALUES ('$username', '$cfpassword', '$email', '$company', '$fullname' , '$roletest')";
                        if ($conn->query($sql) === TRUE) {
                            echo "<script type='text/javascript'>alert('Registration successful.');</script>";
                        }
                    }  
                } else {
                    echo "<script type='text/javascript'>alert('Password not strong enough.');</script>";
                }
            }
        }else{
            echo "<script type='text/javascript'>alert('Invalid email address.');</script>";
        }
    }else{
        echo "<script type='text/javascript'>alert('Username không hợp lệ.');</script>";
    }
}
$conn->close();
?>
</body>
</html>