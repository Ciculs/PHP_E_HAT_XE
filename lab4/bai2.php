<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload an Image</title>
</head>
<body>
    <h2>Upload an Image</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <input type="file" name="file" id="file" required><br>

        <input type="submit" name = "file" value="Upload File">
    </form>
<style>
    body{
        text-align: center;
    }
</style>
</body>
</html>


<?php
$uploadDir = "uploads/";
$uploadedFile = "";

if (isset($_POST['file'])) {
    $uploadedFile = $uploadDir . basename($_FILES["file"]["name"]);
    $uploadOk = true;

    if (file_exists($uploadedFile)) {
        echo "File đã tồn tại.";
        $uploadOk = false;
    }

    $allowed = ["jpg", "jpeg", "png", "gif"];
    $extension = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
    if (!in_array($extension, $allowed)) {
        echo "<script type='text/javascript'>alert('Invalid file type.');</script>";
        $uploadOk = false;
    }

    if ($uploadOk) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadedFile)) {
            echo "File uploaded successfully.";
        } else {
            echo "Đã xảy ra lỗi.";
        }
    } else {
        echo "File not uploaded.";
    }
    
    if (!empty($uploadedFile) && file_exists($uploadedFile)) {
        echo "<br>";
        echo "<img src=\"$uploadedFile\">";
    }
}
?>