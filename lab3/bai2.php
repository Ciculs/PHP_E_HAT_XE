<?php
// Initialize variables
$registeredUsers = [];  // Store registered users in-memory (for demonstration purposes)

// Check if the register form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Get registration form data
    $regUsername = $_POST["reg_username"];
    $regPassword = $_POST["reg_password"];

    // Check if the username is already registered
    if (isset($registeredUsers[$regUsername])) {
        echo "Username already taken. Choose a different one.";
    } else {
        // Register the new user
        $registeredUsers[$regUsername] = ['username' => $regUsername, 'password' => $regPassword];
        echo "Registration successful! You can now log in.";
    }
}

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Get login form data
    $loginUsername = $_POST["login_username"];
    $loginPassword = $_POST["login_password"];

    // Check if the entered credentials are valid
    if (isset($registeredUsers[$loginUsername]) && $registeredUsers[$loginUsername]['password'] == $loginPassword) {
        echo "Login successful! Welcome, $loginUsername.";
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register Forms</title>
</head>
<body>
    <h2>Register Form</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="reg_username">Username:</label>
        <input type="text" name="reg_username" required><br>

        <label for="reg_password">Password:</label>
        <input type="password" name="reg_password" required><br>

        <input type="submit" name="register" value="Register">
    </form>

    <h2>Login Form</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="login_username">Username:</label>
        <input type="text" name="login_username" required><br>

        <label for="login_password">Password:</label>
        <input type="password" name="login_password" required><br>

        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>