<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
</head>
<body>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 30px;
    }

    h2 {
        text-align: center;
        font-size: 25px;
    }

    .form-container {
        display: block;
        justify-content: space-between;
        max-width: 800px;
        margin: auto;
    }

    .form-container form {
        flex: 1;
        margin: auto;
        text-align: center;
    }

    .myClass {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        max-width: 300px;
        padding: 8px;
        margin-bottom: 10px;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: white;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>

<h2>Student Names</h2>

<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'ehc';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, ten FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='myClass'>ID: " . $row["id"] . "<br></div>";
        echo "<div class='myClass'>Ten: " . $row["ten"] . "<br></div>";
        echo "<div class='myClass'>-------------------------------------<br></div>";
    }
} else {
    echo "<div class='myClass'>Thông tin không tồn tại.</div>";
}

if (isset($_POST['add'])) {
    $ten = $_POST['name'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];

    if (is_string($ten) && !preg_match('~[0-9]+~', $ten) && strlen($sdt) == 10 && is_numeric($sdt) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $sql = "INSERT INTO students (ten, email, sdt)
        VALUES ('".$ten."', '".$email."', '".$sdt."')";
        mysqli_query($conn, $sql);
        echo "<div class='myClass'>Added student successfully<br></div>";
      }
      else {
        echo "<div class='myClass'><b>Hãy nhập đúng format<br>Tên phải là kí tự a-z hoặc A-Z<br>SDT gồm 10 số<br>Email phải đúng định dạng email</b></div>";
    }
}
?>
<div class="form-container">
<h2>Add Student</h2>
<form method="post" action="">
    <label for="name">Tên:</label>
    <input type="text" name="name" placeholder="Pham Thanh Dat" required><br>

    <label for="email">Email:</label>
    <input type="text" name="email" placeholder="abc@example.com" required><br>
    
    <label for="sdt">SDT:</label>
    <input type="number" name="sdt" placeholder="0123456789" required><br>

    <input type="submit" name="add" value="Add Student">
</form>

<div>
    <h2>Get Student Detail</h2>
    <form method="post" action="">
        <label for="name">ID:</label>
        <input type="text" name="id" placeholder="1" required><br>

        <input type="submit" name="detail" value="Get Detail">
    </form>

<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'ehc';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['detail'])){
    if (is_numeric($_POST['id'])) {
        $sql = "SELECT id, ten, email, sdt FROM students WHERE id='" . $_POST['id'] . "'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
        if ($result) {
            echo "<div class='myClass'>ID: " . $result["id"] . "<br></div>";
            echo "<div class='myClass'>Ten: " . $result["ten"] . "<br></div>";
            echo "<div class='myClass'>Email: " . $result["email"] . "<br></div>";
            echo "<div class='myClass'>SDT: " . $result["sdt"] . "<br></div>";
            echo "<div class='myClass'>-------------------------------------<br></div>";
        } else {
            echo "<div class='myClass'>No student found with ID: " . $_POST['id'] . "<br></div>";
        }
    }else{
        echo "<div class='myClass'>ID phải là số.</div>";
    }
}
?>
</div>
<div>
    <h2>Edit Student Detail</h2>
    <form method="post" action="">
        <label for="id">ID:</label>
        <input type="text" name="id" placeholder="1" required><br>

        <label for="name">Ten:</label>
        <input type="text" name="ten" placeholder="Pham Thanh Dat" required><br>

        <label for="email">Email:</label>
        <input type="text" name="email" placeholder="example@example.com" required><br>

        <label for="sdt">SDT:</label>
        <input type="number" name="sdt" placeholder="0123456789" required><br>

        <input type="submit" name="edit" value="Edit Detail">
    </form>

<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'ehc';

$conn = new mysqli($hostname, $username, $password, $database);

if (isset($_POST['edit'])) {
    $ten = $_POST['name'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $id = $_POST['id'];

    if (is_string($ten) && !preg_match('~[0-9]+~', $ten) && strlen($sdt) == 10 && is_numeric($sdt) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "UPDATE students SET ten=?, email=?, sdt=? WHERE id=?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $ten, $email, $sdt, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<div class='myClass'>Updated student successfully<br></div>";
        } else {
            echo "<div class='myClass'>No changes made or student with ID $id not found<br></div>";
        }

        $stmt->close();
    } else {
        echo "<div class='myClass'><b>Hãy nhập đúng format<br>Tên phải là kí tự a-z hoặc A-Z<br>SDT gồm 10 số<br>Email phải đúng định dạng email</b></div>";
    }
}
?>
</div>
<div>
    <h2>Remove Student</h2>
    <form method="post" action="">
        <label for="name">ID:</label>
        <input type="text" name="id" placeholder="1" required><br>

        <input type="submit" name="remove" value="Remove">
    </form>
    <?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'ehc';
    //add code to remove student from database
    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_POST['remove'])){
        if (is_numeric($_POST['id'])) {
            $sql = "DELETE FROM students WHERE id='" . $_POST['id'] . "'";
            $result = mysqli_query($conn, $sql);
        
            if ($result) {
                echo "<div class='myClass'>Student with ID: " . $_POST['id'] . " has been removed<br>";
            } else {
                echo "<div class='myClass'>No student found with ID: " . $_POST['id'] . "<br></div>";
            }
        }else{
            echo "<div class='myClass'>ID phải là số.</div>";
        }
    }
    ?>
</div>
</div>
</body>
</html>