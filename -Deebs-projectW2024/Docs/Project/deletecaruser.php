<?php

require_once('connection.php');
$carid=$_GET['id'];
$sql="DELETE from usercars where CAR_ID=$carid";
$result=mysqli_query($con,$sql);

echo '<script>alert("CAR DELETED SUCCESFULLY")</script>';
echo '<script> window.location.href = "userposting.php";</script>';



?>