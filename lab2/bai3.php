<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 3 Lab 2</title>
</head>
<body>

<h2>Factorial</h2>

<form method="post" action="">
    <label for="n">Enter n =</label>
    <input type="text" name="n" id="n" required>

    <input type="submit" name="calculate" value="Calculate">
</form>

<?php
if (isset($_POST['calculate'])) {

    $n = $_POST['n'];
    $fac = 1;
    
    if (is_numeric($n) && $n > 0) {
        for ($i = 1; $i <= $n; $i++) {
            $fac *= $i;
        }
        echo "<p>Giai thừa của $n là: $fac</p>";
    }elseif ($n < 0){
        $n = -$n;
        for ($i = 1; $i <= $n; $i++) {
        $fac *= $i;
        }
        echo "<p>Giai thừa của -$n là: -$fac</p>";   
    } else {
        echo "<p>Nhập số.</p>";
    }
}
?>

</body>
</html>
