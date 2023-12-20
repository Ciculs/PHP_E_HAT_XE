<?php
    setcookie("username", "", time() - (86400 * 7 + 3600),"/");
    setcookie("password", "", time() - (86400 * 7 + 3600),"/");
    setcookie("role", "", time() - (86400 * 7 + 3600),"/");
    header("location:index.php");
?>