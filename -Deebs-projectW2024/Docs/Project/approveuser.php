<?php

require_once('connection.php');
$bookid = $_GET['id'];
$sql = "SELECT * FROM bookingusers WHERE BOOK_Id=$bookid";
$result = mysqli_query($con, $sql);
$res = mysqli_fetch_assoc($result);
$car_id = $res['CAR_ID'];
$sql2 = "SELECT * FROM usercars WHERE CAR_ID=$car_id";
$carres = mysqli_query($con, $sql2);
$carresult = mysqli_fetch_assoc($carres);
$email = $res['EMAIL'];
$carname = $carresult['CAR_NAME'];
$hisname=$res['BOOK_PLACE'];
$owneremail=$res['owneremail'];
$ownername=$res['ownername'];

if ($carresult['AVAILABLE'] == 'Y') {
    if ($res['BOOK_STATUS'] == 'APPROVED' || $res['BOOK_STATUS'] == 'RETURNED') {
        echo '<script>alert("ALREADY APPROVED")</script>';
        echo '<script>window.location.href = "userbooking.php";</script>';
    } else {
        $query = "UPDATE bookingusers SET BOOK_STATUS='APPROVED' WHERE BOOK_ID=$bookid";
        $queryy = mysqli_query($con, $query);
        $sql2 = "UPDATE usercars SET AVAILABLE='N' WHERE CAR_ID=$res[CAR_ID]";
        $query2 = mysqli_query($con, $sql2);

        if ($queryy && $query2) {
            $to_email = $email;
            $subject = "Car Rental Approval";
            $message = "Dear $hisname ,\n\nYour car booking with ID $bookid and booking date of $res[BOOK_DATE] has been approved by the car's owner. You have booked $carname. You may contact the owner $ownername at $owneremail to arrange for pickup . Below are the details:\n\nCar Name: $carname\nBooked Place: $res[DESTINATION]\nBooked Date: $res[BOOK_DATE]\nDuration: $res[DURATION]\nPhone Number: $res[PHONE_NUMBER]\nDestination: $res[DESTINATION]\nReturn Date: $res[RETURN_DATE]\n\nPlease refer to your online portal for more information. ";
            $encoded_subject = rawurlencode($subject);
            $encoded_message = rawurlencode($message);
            echo "<a id='mailto-link' style='display:none;' href='mailto:$to_email?subject=$encoded_subject&body=$encoded_message'>Email</a>";
            echo "<script>document.getElementById('mailto-link').click();</script>";
            echo '<script>alert("APPROVED SUCCESSFULLY. Email sent to '.$to_email.' with instructions to contact you for pickup arrangement.")</script>';
            echo '<script>window.location.href = "userbooking.php";</script>';
        } else {
            echo '<script>alert("Failed to approve booking!")</script>';
            echo '<script>window.location.href = "userbooking.php";</script>';
        }
        exit; // Stop further execution
    }
} else {
    echo '<script>alert("CAR IS NOT AVAILABLE")</script>';
    echo '<script>window.location.href = "userbooking.php";</script>';
    exit; // Stop further execution
}

?>
