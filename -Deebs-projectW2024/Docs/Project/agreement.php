<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Agreement</title>
    <style>
 h1{
margin-left: 600px;
 }
 body{
    background:#00B7FF url("images/paym.jpg") center/cover;
 }
    </style>
</head>
<body>

<?php
    require_once('connection.php');
    session_start();
    $email = $_SESSION['email'];

    $sql_renter = "SELECT * FROM users WHERE EMAIL='$email'";
    $result_renter = mysqli_query($con, $sql_renter);
    $renter_data = mysqli_fetch_assoc($result_renter);

    // Fetch Vehicle information from the database
    $sql_vehicle = "SELECT * FROM cars WHERE CAR_ID=(SELECT CAR_ID FROM booking WHERE EMAIL='$email' ORDER BY BOOK_ID DESC LIMIT 1)";
    $result_vehicle = mysqli_query($con, $sql_vehicle);
    $vehicle_data = mysqli_fetch_assoc($result_vehicle);

    $sql_booking = "SELECT * FROM booking WHERE EMAIL='$email' ORDER BY BOOK_ID DESC LIMIT 1";
    $result_booking = mysqli_query($con, $sql_booking);
    $booking_data = mysqli_fetch_assoc($result_booking);
?>


<h1>Car Rental Agreement</h2>
<div id="agreement">
<p>Rental Agreement Number: <?php echo $vehicle_data['CAR_ID']; ?><br></p>


<h3>1. Renter's Information:</h3>
<p>
    Name: <?php echo $renter_data['FNAME'] . ' ' . $renter_data['LNAME']; ?><br>
    Email Address: <?php echo $renter_data['EMAIL']; ?><br>
    Driver's License Number: <?php echo $renter_data['LIC_NUM']; ?><br>
    Contact Number: <?php echo $renter_data['PHONE_NUMBER']; ?><br>
</p>


<h3>2. Vehicle Information:</h3>
<p>
    Make: <?php echo $vehicle_data['CAR_NAME']; ?><br>
    Model: <?php echo $vehicle_data['CAR_NAME']; ?><br>
    FUEL TYPE: <?php echo $vehicle_data['FUEL_TYPE']; ?><br>
    Vehicle Identification Number (VIN): <?php echo $vehicle_data['CAR_ID']; ?><br>
</p>


<h3>3. Rental Details:</h3>
<p>
    Rental Start Date: <?php echo $booking_data['BOOK_DATE']; ?><br>
    Rental End Date: <?php echo $booking_data['RETURN_DATE']; ?><br>
    Pick-up Location: <?php echo $booking_data['DESTINATION']; ?><br>
    Drop-off Location: <?php echo $booking_data['DESTINATION']; ?><br>
    Rental Period: <?php echo $booking_data['DURATION']; ?> days<br>
    Rental Rate: <?php echo $booking_data['PRICE']; ?>/day<br>
   
    4. Rental Terms and Conditions:

The Renter acknowledges receiving the vehicle described above in good condition and agrees to return it to the Rental Company in the same condition, subject to normal wear and tear.
The Renter agrees to use the vehicle solely for personal or business purposes and not for any illegal activities.
The Renter agrees to pay the Rental Company the agreed-upon rental rate for the specified rental period. Additional charges may apply for exceeding the mileage limit, late returns, fuel refueling, or other damages.
The Renter agrees to bear all costs associated with traffic violations, tolls, and parking fines incurred during the rental period.
The Renter acknowledges that they are responsible for any loss or damage to the vehicle, including theft, vandalism, accidents, or negligence, and agrees to reimburse the Rental Company for all repair or replacement costs.
The Renter agrees to return the vehicle to the designated drop-off location at the agreed-upon date and time. Failure to do so may result in additional charges.
The Rental Company reserves the right to terminate this agreement and repossess the vehicle without prior notice if the Renter breaches any terms or conditions of this agreement.
The Renter acknowledges receiving and reviewing a copy of the vehicle's insurance coverage and agrees to comply with all insurance requirements during the rental period.
<br><br><h3>5. Indemnification:</h3>

The Renter agrees to indemnify and hold harmless the Rental Company, its employees, agents, and affiliates from any claims, liabilities, damages, or expenses arising out of or related to the Renter's use of the vehicle.
<br><br>
<h3>6. Governing Law:</h3>

This Agreement shall be governed by and construed in accordance with the laws of [Jurisdiction]. Any disputes arising under or related to this Agreement shall be resolved exclusively by the courts of [Jurisdiction].
<br><br>
<h3>7. Entire Agreement:</h3>

This Agreement constitutes the entire understanding between the parties concerning the subject matter hereof and supersedes all prior agreements and understandings, whether written or oral.
<br><br>

<h3>8. Signatures:</h3>

The parties hereto have executed this Agreement as of the date first written above.
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        padding: 20px;
    }
    
    input[type="text"] {
        width: 300px;
        padding: 10px;
        border: none;
        border-radius: 20px;
        margin-bottom: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
    }
    
    input[type="text"]:focus {
        outline: none;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    }
    
    input[type="text"]::placeholder {
        color: #aaa;
    }
</style>
<form action="POST">
    <br>
    <label for="company_signature">Signature:</label><br>
    <input type="text" name="company_signature" placeholder="Company Signature"><br>
    
    <label for="company_print_name">Print Name:</label><br>
    <input type="text" name="company_print_name" placeholder="Company Print Name"><br>
    
    <label for="company_date">Date:</label><br>
    <input type="text" name="company_date" placeholder="Company Date"><br>
    
    <label for="renter">Renter:</label><br>
    <input type="text" name="renter" placeholder="Renter"><br>
    
    <label for="renter_signature">Signature:</label><br>
    <input type="text" name="renter_signature" placeholder="Renter Signature"><br>
    
    <label for="renter_print_name">Print Name:</label><br>
    <input type="text" name="renter_print_name" placeholder="Renter Print Name"><br>
    
    <label for="renter_date">Date:</label><br>
    <input type="text" name="renter_date" placeholder="Renter Date"><br>
    <a href="cardetails.php" style="margin-left:600px; background-color:black; color:white; border-radius:50px; font-size:20px; padding:10px 20px; text-decoration:none;">Submit</a>

</form>
</p>

</div>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    var agreementElement = document.getElementById("agreement");
    if (agreementElement) {
        agreementElement.style.backgroundColor = "#f0f0f0";
        agreementElement.style.padding = "20px";
        agreementElement.style.border = "1px solid #ccc";
        agreementElement.style.borderRadius = "10px";
        agreementElement.style.margin = "100px";
    }
});

</script>
</html>
