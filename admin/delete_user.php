<?php

$conn = mysqli_connect('localhost', 'root', '', 'drtools') or die("Connection Faild") . mysqli_connect_error();

$user_id = $_GET['id'];

$sql = "DELETE FROM users WHERE id = {$user_id}";

if(mysqli_query($conn,$sql))
{
    header("Location: manage_user.php");
}
else
{
    echo "<p style='color:red;margin: 10px 0;'>Can Not Delete The User Record.</p>";
}

?>