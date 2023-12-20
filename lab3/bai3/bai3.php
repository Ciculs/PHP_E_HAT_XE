<?php
//<-----------------MYSQL CONNECTION---------------------->
$host = "sql12.freemysqlhosting.net";
$username = "sql12671566";
$password = "LGfIY14PwP";
$database = "sql12671566";
$conn = new mysqli($host, $username, $password, $database);
//thiết lập kết nối với sql bằng thông tin đã cho

if ($conn->connect_error) {
    die("<script type='text/javascript'>alert('Connection Failed.');</script>"); 
}
//báo lỗi nếu có.

//<---------------------LOGIN----------------------------->
if (isset($_POST['login'])) {
    $usr = "";
    $role = "";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedpassword = md5("$password");

    $stmt = $conn->prepare("SELECT username, password, role FROM users WHERE username = ?"); //mysql prepare.
    $stmt->bind_param("s", $username);//gắn username vào "?"
    $stmt->execute();//thực thi
    $stmt->store_result();//lưu dữ liệu
    //--> Tránh SQL Injection

    
    if ($stmt->num_rows > 0) { //check nếu số row > 0 , đồng nghĩa với đúng tên đăng nhập.
        $stmt->bind_result($dbUsername, $dbPassword, $dbrole); //gán username , password, role từ db vào biến.
        $stmt->fetch();//release các biến.

        if ($password == $dbPassword) {//check nếu pass nhập vào = pass trên db.
            $usr = $dbUsername;
            $role = $dbrole;
            if(isset($_POST['remember-me'])){
                setcookie('username', $dbUsername, time() + (86400 * 7), "/");
                setcookie('password', $hashedpassword, time() + (86400 * 7), "/");
                setcookie('role', $role, time() + (86400 * 7), "/");
                header("location:index.php");
            }else{
                echo "<script type='text/javascript'>alert('Welcome, $usr! You are logged in as $role.Cookies is not set.');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Sai tên đăng nhập hoặc mật khẩu.');</script>";
        }
    } else { //sai username
        echo "<script type='text/javascript'>alert('Sai tên đăng nhập hoặc mật khẩu.');</script>";
    }

    $stmt->close();
}

//<------------------------------REGISTER----------------------------------->
if (isset($_POST['register'])){
    $username = $_POST['register-username'];
    $password = $_POST['register-password'];
    $cfpassword = $_POST['register-cfpassword'];
    $email = $_POST['register-email'];
    $fullname = $_POST['register-name'];
    $company = $_POST['register-companyname'];

    function isExists($email, $username, $conn) { //check username và email trên database xem có tồn tại không.
        $stmt = $conn->prepare("SELECT username, email FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0; //nếu đã tốn tại thì row > 0.
        $stmt->close();
        return $exists;
    }

    if (isset($_POST['admin'])) { //cấp quyền checkbox
        $roletest = 'admin';
    }else{
        $roletest = "user";
    }
    
    //func
    function isStrongPassword($password) { //password requirements.
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

    if(!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $username)){ //check xem username có kí tự đặc biệt không.
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //check email có đúng định dạng không.
            if (isExists($email, $username, $conn)) { //check xem tài khoản hoặc email có trùng không.
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
            margin-bottom: 10px;
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
            margin-bottom: 10px;
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
                <label for="username">Username:</label> <!-- Pattern dùng để lọc input -->
                <input type="text" name="username" id="login-username" pattern ="[a-zA-Z0-9]+" title = "Sai định dạng" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="login-password" required>

                <div class="checkbox-group">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me" name ="remember-me" id = "btn">Remember Me</label>
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
                        <option value="Mr.">Mr.</option><!-- Hiện tại không muốn ghi cái này vào db -->
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
</body>
</html>