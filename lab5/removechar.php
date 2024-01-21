<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove char</title>
</head>
<body>

<h2>Remove char</h2>
    
<form method="post" action="">
    <label for="input">Input:</label>
    <input type="text" name="input" required><br>

    <input type="submit" name="submit" value="Remove Char">
</form>

<?php
if (isset($_POST['submit'])) {
    $input = $_POST['input'];
	$pattern = '/[^0-9.,]/';
	$output = preg_replace("/[^0-9.,]/", '', $input);
	echo "Removed Char: $output\n";
}
?>
</body>
</html>