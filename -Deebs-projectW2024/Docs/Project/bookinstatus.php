<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKING STATUS</title>
</head>
<body>
<style>

*{
    margin: 0;
    padding: 0;

}

body{
    background: url("images/wood.jpg");
    background-position: center;
   
}
.box{
    
    position:center;    
    top: 50%;
    left: 50%;
    padding: 20px;
    box-sizing: border-box;
    background: #fff;
    border-radius: 4px;
    box-shadow: 0 5px 15px rgba(0,0,0,.5);
    background: linear-gradient(to top, rgba(255, 251, 251, 1)70%,rgba(250, 246, 246, 1)90%);
    display: flex;
    align-content: center;
    width: 700px;
    height: 250px;
    margin-top: 100px;
    margin-left: 350px;
  
    
}


.box .content{
    margin-left: 5px;
    font-size: larger;
}

.box .button{
    width: 240px;
    height: 40px;
    background: #00B7FF;
    border:none;
    margin-top: 30px;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:#fff;
    transition: 0.4s ease;
}

.utton{
    width: 200px;
    height: 40px;
   
    background: #00B7FF;
    border:none;
    font-size: 18px;
    border-radius: 5px;
    cursor: pointer;
    color:#fff;
    transition: 0.4s ease;
    margin-top: 10px;
    margin-left: 10px;
}
.utton a{
    text-decoration: none;
    color: white;
    font-weight: bold;
}

ul{
    float: left;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 100px;
}

ul li{
    list-style: none;
    margin-left: 200px;
    margin-top: -130px;
    font-size: 35px;

}
.name{
    font-weight: bold;
}
.sign-agreement {
    width: 250px;
    height: 40px;
    background: #00B7FF;
    border: none;
    margin-top: 20px;
    font-size: 18px;
    margin-left:600px;
}

.sign-agreement a {
    text-decoration: none;
    color: black;
    font-weight: bold;
}
</style>


<?php
require_once('connection.php');
session_start();
$email = $_SESSION['email'];

$sql = "SELECT * FROM booking WHERE EMAIL='$email' ORDER BY BOOK_ID DESC LIMIT 1";
$name = mysqli_query($con, $sql);
$rows = mysqli_fetch_assoc($name);

if ($rows == null) {
    echo '<script>alert("There are no booking details")</script>';
    echo '<script>window.location.href = "cardetails.php";</script>';
} else {
    $car_id = $rows['CAR_ID'];
    $sql3 = "SELECT * FROM cars WHERE CAR_ID='$car_id'";
    $name3 = mysqli_query($con, $sql3);
    $rows3 = mysqli_fetch_assoc($name3);
?>

<ul>
    <li><button class="utton"><a href="cardetails.php">Go to Home</a></button></li>
    <li class="name"></li>
</ul>

<div class="box">
    <div class="content">
        <h1>CAR NAME: <?php echo $rows3['CAR_NAME']; ?></h1><br>
        <h1>NO OF DAYS: <?php echo $rows['DURATION']; ?></h1><br>
        <h1>BOOKING STATUS: <?php echo $rows['BOOK_STATUS']; ?></h1><br>
    </div>
</div>

<?php
    if ($rows['BOOK_STATUS'] == 'APPROVED') {
        echo "<button class='sign-agreement' onclick='returnCar({$rows["CAR_ID"]}, {$rows["BOOK_ID"]})'>Return Car</button>";
    } else {
        echo '<button class="sign-agreement"><a href="agreement.php">Sign Rental Agreement Here</a></button>';
        echo '<button class="sign-agreement"><a href="feedback/Feedbacks.php">Rate your experience!</a></button>';
        
    }
}
?>

<script>
function returnCar(carId, bookId) {
    var confirmation = confirm("Are you sure you want to return the car?");
    if (confirmation) {
        // Send AJAX request to adminreturn.php to process car return
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "adminreturn.php?id=" + carId + "&bookid=" + bookId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Handle successful response
                    alert("Car returned successfully!");
                   
                    location.reload(); // Reload the page to reflect changes 
                } else {
                    // Handle error response
                    alert("Failed to return car. Please try again.");
                }
            }
        };
        xhr.send();
    }
}
</script>

</body>
</html>
