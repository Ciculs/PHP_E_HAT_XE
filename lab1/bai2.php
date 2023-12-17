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
        if ($b!=0){
            $thuong = $a / $b;
        }else{
            $thuong = "Vô nghiệm";
        }
        echo "<br>";
        echo "Addition:". ($a+$b) ."<br>";
        echo "Subtraction:". ($a-$b) ."<br>";
        echo "Multiplication:". ($a*$b) ."<br>";
        echo "Division: $thuong";
    } else {
        $result = "Nhập số.";
        echo "<p>Loi: $result</p>";
    }
}
?>

</body>
</html>
