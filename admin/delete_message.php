<?php

$conn = mysqli_connect('localhost', 'root', '', 'drtools') or die("Connection Faild") . mysqli_connect_error();

$message_id = $_GET['message_id'];

$sql = "DELETE FROM contactus WHERE message_id = {$message_id}";

if(mysqli_query($conn,$sql))
{
    header("Location: manage_contact_us.php");
}
else
{
    echo "<p style='color:red;margin: 10px 0;'>Can Not Delete The Message Record.</p>";
}

?>