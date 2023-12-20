<?php
//index.php

if(!isset($_COOKIE["username"]))
{
    echo "<script type='text/javascript'>alert('Welcome, $usr! You are logged in as $role.Cookies is not set.');</script>";
    header("location:bai3.php");
}

?>
<html>
<head>
<title>Cookies check</title>
</head>
<body>
<style>
    .container{
        margin: auto;
        font-size: 20px;
    }
    button {
        margin:auto;
        position: static;
        padding: 8px;
        display: flex;
    }
</style>
<br />
<div class="container">
<h2 align="center">Your cookies:</h2>
<p align="center">Username: <?php echo $_COOKIE["username"]; ?></p>
<p align="center">Password: <?php echo $_COOKIE["password"]; ?></p>
<p align="center">Role: <?php echo $_COOKIE["role"]; ?></p>
<br />
<form method="post">
    <button type="submit" name="logout">Logout</button>
</form>
<?php
if(isset($_COOKIE["username"]))
{
    $usr = $_COOKIE['username'];
    $cookies = $_COOKIE['password'];
    $role = $_COOKIE['role'];
    echo "<script type='text/javascript'>alert('Welcome, $usr! You are logged in as $role.Cookies is $cookies.');</script>";
}
if(isset($_POST["logout"])){
    header("location:logout.php");
}
?>
</div>
</body>
</html>