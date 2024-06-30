<?php
    $conn = mysqli_connect('localhost', 'root', '', 'drtools') or die("Connection Faild") . mysqli_connect_error();

    session_start();

    unset($_SESSION['loggedin']);
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);

    // session_destroy();

    header("Location: index.php");

?>

