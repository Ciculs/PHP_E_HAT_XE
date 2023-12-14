<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 4 Lab 2</title>
</head>
<body>

<h2>Giá trị lớn nhất , nhỏ nhất của array</h2>

<?php
$my_array = array('EHC', 'HackYourLimits', 'Training');
$max=0;
$min=1000;
for ($i = 0; $i < count($my_array); $i++ ) {
    $len = strlen($my_array[$i]);
    if ($len > $max) {
        $max = $len;
    }
    if($len < $min) {
        $min = $len;
    }
}
echo "minLength = $min; maxLength = $max;"
?>

</body>
</html>