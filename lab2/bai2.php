<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2 Lab 2</title>
</head>
<body>

<h2>Sum 1-> n</h2>

<form method="post" action="">
    <label for="n">Enter n:</label>
    <input type="text" name="n" id="n" required>

    <input type="submit" name="calculate" value="Calculate">
</form>

<?php
if (isset($_POST['calculate'])) {

    $n = $_POST['n'];
    $sum = 0;
    
    if (is_numeric($n) && $n >= 0) {
        for ($i = 1; $i <= $n; $i++) {
            $sum += $i;
        }
        echo "<p>Sum: $sum</p>";
    }elseif($n < 0){
        echo "<p>Số nhập vào phải lớn hơn 0</p>";
    }else{
        $result = "Nhập số.";
    }
}
?>

</body>
</html>
