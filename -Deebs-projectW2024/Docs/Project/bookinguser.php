<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAR BOOKING</title>
    <!-- <link  rel="stylesheet" href=""> -->
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
          
        setTimeout("preventBack()", 0);
          
        window.onunload = function () { null };
    </script>



</head>
<body  background=images/wood.jpg>
<style>
*{
    margin: 0;
    padding: 0;

}

div.main{
    width: 400px;
    margin: 100px auto 0px auto;
}
.btnn{
    width: 240px;
    height: 40px;
    background: #00B7FF;
    border:none;
    margin-top: 30px;
    margin-left: 30px;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:#fff;
    transition: 0.4s ease;
}

.btnn:hover{
    background: #fff;
    color:#00B7FF;
}

.btnn a{
    text-decoration: none;
    color: black;
    font-weight: bold;
}

h2{
    text-align: center;
    padding: 20px;
    font-family: sans-serif;

}
div.register{
    background-color: rgba(0,0,0,0.6);
    width: 100%;
    font-size: 18px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.3);
    box-shadow: 2px 2px 15px rgba(0,0,0,0.3);
    color: #fff;

}

form#register{
    margin: 40px;

}

label{
    font-family: sans-serif;
    font-size: 18px;
    font-style: italic;
}

input#name{
    width:300px;
    border:1px solid #ddd;
    border-radius: 3px;
    outline: 0;
    padding: 7px;
    background-color: #fff;
    box-shadow:inset 1px 1px 5px rgba(0,0,0,0.3);
}

input#dfield{
    width:300px;
    border:1px solid #ddd;
    border-radius: 3px;
    outline: 0;
    padding: 7px;
    background-color: #fff;
    box-shadow:inset 1px 1px 5px rgba(0,0,0,0.3);
}

input#datefield{
    width:300px;
    border:1px solid #ddd;
    border-radius: 3px;
    outline: 0;
    padding: 7px;
    background-color: #fff;
    box-shadow:inset 1px 1px 5px rgba(0,0,0,0.3);
}

*{
    margin: 0;
    padding: 0;

}
.hai{
    width: 100%;
    height: 0px;
    
    
}
.main{
    width: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%);
    background-position: center;
    background-size: cover;

        display: flex;
        justify-content: space-between; 
    
  
}
.navbar{
    width: 1200px;
    height: 75px;
    margin: auto;
}

.icon{
    width:200px;
    float: left;
    height : 70px;
}

.logo{
    color: #00B7FF;
    font-size: 35px;
    font-family: Arial;
    padding-left: 20px;
    float:left;
    padding-top: 10px;

}
.menu{
    width: 400px;
    float: left;
    height: 70px;

}

ul{
    float: left;
    display: flex;
    justify-content: center;
    align-items: center;
    color: black;
}

ul li{
    list-style: none;
    margin-left: 80px;
    margin-top: 20px;
    font-size: 14px;
    color: black;

}

ul li a{
    text-decoration: none;
    color:white;
    font-family: Arial;
    font-weight: bold;
    transition: 0.4s ease-in-out;

}

ul li a:hover{
    color:#00B7FF;

}

.nn{
    width:100px;
    background: #00B7FF;

    border:none;
    height: 40px;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:white;
    transition: 0.4s ease;
    

}

.nn a{
    text-decoration: none;
    color: black;
    font-weight: bold;
    
}

.circle{
    border-radius:48%;
    width:65px;
}

.phello{
    width: 200px;
    margin-left: -50px;
    padding: 0px;
}


.receipt1{
    background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%);
    width:300px;
    background: white;
margin-left:20px;
}

</style>


<?php 

    require_once('connection.php');
    session_start();
 
    $carid=$_GET['id'];

    $sql1="select *from usercars where CAR_ID='$carid'";
    $sql="select *from usercars where CAR_ID='$carid'";
    $cname = mysqli_query($con,$sql);
    $email = mysqli_fetch_assoc($cname);
    
    $value = $_SESSION['email'];
    $sql="select * from users where EMAIL='$value'";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);
    $uemail=$rows['EMAIL'];
    $carprice=$email['PRICE'];
   
    $result_car = mysqli_query($con, $sql1);
    $row_car = mysqli_fetch_assoc($result_car);
    if(isset($_POST['book'])){
       
        $bplace=mysqli_real_escape_string($con,$_POST['place']);
        $bdate=date('Y-m-d',strtotime($_POST['date']));;
        $dur=mysqli_real_escape_string($con,$_POST['dur']);
        $phno=mysqli_real_escape_string($con,$_POST['ph']);
        $des=mysqli_real_escape_string($con,$_POST['des']);
        $rdate=date('Y-m-d',strtotime($_POST['rdate']));
        $owner_name = $row_car['username']; 
        $owner_email=$row_car['email'];
       
         
        if(empty($bplace)|| empty($bdate)|| empty($dur)|| empty($phno)|| empty($des)|| empty($rdate)){
            echo '<script>alert("please fill the place")</script>';

        }
        else{
            if($bdate<$rdate){
            $price=($dur*$carprice);
            $sql="insert into bookingusers (CAR_ID,EMAIL,BOOK_PLACE,BOOK_DATE,DURATION,PHONE_NUMBER,DESTINATION,PRICE,RETURN_DATE,ownername,owneremail) values($carid,'$uemail','$bplace','$bdate',$dur,$phno,'$des',$price,'$rdate','$owner_name','$owner_email')";
            $result = mysqli_query($con,$sql);
            
            if($result){
                
                $_SESSION['email'] =$uemail;
                header("Location: paymentuser.php");
            }
            else{
                echo '<script>alert("please check the connection")</script>';
            }
        }
        else{
            echo  '<script>alert("please enter a correct return date")</script>';
        }
    
        }
    }
    
    ?>



    
       <div class="hai">
            <div class="navbar">
                <div class="icon">
                    <h2 class="logo">DEEBS</h2>
                </div>
                <div class="menu" >
                    <ul>
                        <li ><a href="cardetails.php">HOME</a></li>
                        <li><a href="aboutus2.html">ABOUT</a></li>
                        <li><a href="#">DESIGN</a></li>
                        <li><a href="contactus2.html">CONTACT</a></li>
                        <li><button class="nn"><a href="index.html">LOGOUT</a></button></li>
                        <li><img src="images/profile.png" class="circle" alt="Alps"></li>
                    <li><p class="phello">HELLO! &nbsp;<a id="pname"><?php echo $rows['FNAME']." ".$rows['LNAME']?></a></p></li>

                    
                    </ul>
                </div>
            </div>
       </div>
                
                
         <div class="main"> 
        
        <div class="register">
            <h2>BOOKING</h2>
        <form id="register" method="POST"  >
            <h2>CAR NAME : <?php echo "".$email['CAR_NAME']?></h2>
            <label>  Name: </label>
            <br>
            <input type="text" name="place"
            id="name" placeholder="Enter Your name">
            <br><br>

            <label>BOOKING DATE:</label>
<br>
<input type ="date" name="rdate"
            id="dfield"  min='1899-01-01' placeholder="Enter The Return Date">


            <br><br>

            <label>DURATION (in days): </label>
            <br>
            <input type ="number" id="dur" name="dur" min="1" max="30" 
            id="name" placeholder="Enter Rent Period (in days)">
            <br><br>

            <label>PHONE NUMBER : </label>
            <br>
            <input type="tel" name="ph" maxlength="10"
            id="name" placeholder="Enter Your Phone Number">
            <br><br>
            
            <label>Current address : </label>
            <br>
            <input type="text" name="des"
            id="name" placeholder="Enter Your address">
            <br><br>

            <label>Return date : </label>
            <br>
            <input type ="date" name="rdate"
            id="dfield"  min='1899-01-01' placeholder="Enter The Return Date">
            <br><br>
            <label><input type="checkbox" name="gps" id="gps"> Prepay for gas (+35$)</label>
            <br>
            <label><input type="checkbox" name="insurance" id="insurance"> Insurance(+100$)</label>
            <br><br>
            <div class="receipt">
                <h2>Receipt</h2>
                <div id="priceDetails">
                    <p>Number of Days: <span id="numDays">0</span></p>
                    <p>Price per Day: $<?php echo $carprice; ?></p>
                    <p>Gas: $<span id="gpsPrice">0</span></p>
                    <p>Insurance: $<span id="insurancePrice">0</span></p>
                    <p>Total Price: $<span id="totalPrice">0</span> CAD</p>
                </div>
            </div>
            <input type="submit"  class="btnn" value="BOOK" name="book" >
            
        </form>
     
        <div  >
        <h2>Reviews</h2>
        <?php
         
         $carid=$_GET['id'];
        $sql_feedback = "SELECT * FROM feedbackuser WHERE carid = $carid";
        $result_feedback = mysqli_query($con, $sql_feedback);

        // Display feedbacks as HTML
        if (mysqli_num_rows($result_feedback) > 0) {
            while ($row = mysqli_fetch_assoc($result_feedback)) {
                echo '<div class="feedback">';
                echo '<p><strong>User: </strong>' . $row['EMAIL'] . '</p>';
                echo '<p><strong>Rating: </strong>' . $row['num'] . ' ☆</p>';
                echo '<p><strong>Comment: </strong>' . $row['COMMENT'] . '</p>';
                echo '<p><strong>---------------------------------- </strong></p>';
                echo '</div>';
            }
        } else {
            echo '<p>No feedbacks available for this car.</p>';
        }
        ?>
       
        
    </div>
        
    </div>
    </div>
    
    <script>
        
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
             dd = '0' + dd
        }
        if (mm < 10) {
              mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("datefield").setAttribute("min", today);
        document.getElementById("datefield").setAttribute("max", today);


    </script>
    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
             dd = '0' + dd
        }
        if (mm < 10) {
              mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("dfield").setAttribute("min", today);
        

    
        document.getElementById('dur').addEventListener('input', updatePrice);
    document.getElementById('gps').addEventListener('change', updatePrice);
    document.getElementById('insurance').addEventListener('change', updatePrice);

    function updatePrice() {
        var duration = parseInt(document.getElementById('dur').value);
        var pricePerDay = <?php echo $carprice; ?>;
        var totalPrice = duration * pricePerDay;

        // Calculate additional costs for GPS and insurance
        var gpsPrice = document.getElementById('gps').checked ? 35 : 0;
        var insurancePrice = document.getElementById('insurance').checked ? 100 : 0;

        // Update receipt details
        document.getElementById('numDays').textContent = duration;
        document.getElementById('gpsPrice').textContent = gpsPrice;
        document.getElementById('insurancePrice').textContent = insurancePrice;

        // Calculate total price including additional costs
        totalPrice += gpsPrice + insurancePrice;
        document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
    }


    </script>
    
    
    
    
</body>
</html>