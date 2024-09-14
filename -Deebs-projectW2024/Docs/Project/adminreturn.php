<?php

require_once('connection.php');
$carid=$_GET['id'];
$book_id=$_GET['bookid'];
$sql2="SELECT *from booking where BOOK_Id=$book_id";
$result2=mysqli_query($con,$sql2);
$res2 = mysqli_fetch_assoc($result2);
$sql="SELECT *from cars where CAR_ID=$carid";
$result=mysqli_query($con,$sql);
$res = mysqli_fetch_assoc($result);

if($res['AVAILABLE']=='Y')
{
    echo '<script>alert("ALREADY CAR IS RETURNED")</script>';
    echo '<script> window.location.href = "adminbook.php";</script>';
}
else{
    // Update the cars table to set AVAILABLE to 'Y' and branch to the destination from booking table
    $sql4="UPDATE cars SET AVAILABLE='Y', branch='$res2[DESTINATION]' WHERE CAR_ID=$res[CAR_ID]";
    $query2=mysqli_query($con,$sql4);
    // Update the booking table to set BOOK_STATUS to 'RETURNED'
    $sql5="UPDATE booking SET BOOK_STATUS='RETURNED' WHERE BOOK_ID=$res2[BOOK_ID]";
    $query=mysqli_query($con,$sql5);
    echo '<script>alert("CAR RETURNED SUCCESSFULLY")</script>';
    echo '<script> window.location.href = "adminbook.php";</script>';
}  

?>
