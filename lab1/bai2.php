<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2 Lab 1</title>
</head>
<body>

<h2>Calculator Simple</h2>

<form method="post" action="">
    <label for="a">a:</label>
    <input type="text" name="a" id="a" required>
    <br>

    <label for="b">b:</label>
    <input type="text" name="b" id="b" required>
    <br>

    <input type="submit" name="calculate" value="Calculate">
</form>

<?php
if (isset($_POST['calculate'])) {

    $a = $_POST['a'];
    $b = $_POST['b'];

    
    if (is_numeric($a) && is_numeric($b)) {
        $tong = $a + $b;
        $hieu = $a - $b;
        $tich = $a * $b;
        $thuong = $a / $b;
    } else {
        $result = "<p>Nhập số.</p>";
    }
    echo "<p>Addition: $tong</p>";
    echo "<p>Subtraction: $hieu</p>";
    echo "<p>Multiplication: $tich</p>";
    echo "<p>Division = $thuong</p>";
}
?>

</body>
</html>
