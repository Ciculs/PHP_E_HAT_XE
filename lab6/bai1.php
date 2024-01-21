<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'ehc';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, ten, email, sdt FROM students";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . "<br>";
        echo "Ten: " . $row["ten"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "SDT: " . $row["sdt"] . "<br>";
        echo "-------------------------------------<br>";
    }
} else {
    echo "Thông tin không tồn tại.";
}
$conn->close();
?>