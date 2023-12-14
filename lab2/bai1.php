<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 1 Lab 2</title>
</head>
<body>

<h2>Phương trình bậc nhất ax+b=c</h2>

<form method="post" action="">
    <label for="a"></label>
    <input type="text" name="a" id="a" required>

    <label for="b">x +</label>
    <input type="text" name="b" id="b" required> = 0
    <br>
    <br>

    <input type="submit" name="calculate" value="Calculate">
</form>

<?php
if (isset($_POST['calculate'])) {

    $a = $_POST['a'];
    $b = $_POST['b'];

    
    if (is_numeric($a) && is_numeric($b)) {
        if ($a > 0) {
            if ($b != 0) {
                $result = -$b / $a;
            }else{
                $result = "PT vô số nghiệm";
            }
        }else{
            $result = "PT không có nghiệm";
        }      
    } else {
        $result = "<p>Nhập số.</p>";
    }
    echo "<p>Kết quả = $result</p>";
}
?>

</body>
</html>