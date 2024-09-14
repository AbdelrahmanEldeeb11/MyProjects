<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer-to-Peer Car Rental</title>
    <style>
*{
    margin: 0;
    padding: 0;

}

body{
    background: url("images/wood.jpg");
    background-position: center;
    background-size: cover;
}
/* .main{
   
    width: 100%;
     background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%);
    background-position: center;
    background-size: cover;
    height: 109vh; 
    animation: infiniteScrollBg 50s linear infinite;
} */
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
}

ul li{
    list-style: none;
    margin-left: 62px;
    margin-top: 27px;
    font-size: 14px;

}

ul li a{
    text-decoration: none;
    color: black;
    font-family: Arial;
    font-weight: bold;
    transition: 0.4s ease-in-out;

}

ul li a:hover{
    color:#00B7FF;

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
    background: linear-gradient(to top, rgba(255, 251, 251, 0.8)50%,rgba(250, 246, 246, 0.8)50%);
    display: flex;
    align-content: center;
    width: 600px;
    height: 200px;
    margin-top: 100px;
    margin-left: 350px;
}

.box .imgBx{
    width: 150px;
    flex:0 0 150px;
}

.box .imgBx img{
    max-width: 150%;
}

.box .content{
    padding-left: 100px;
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
    width: 240px;
    height: 40px;
   
    background: #00b7ff;
    border:none;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:#2f3e75;
    transition: 0.4s ease;
}




.de{
    float: left;
    clear: left;
    display: block;
    


}


.de li a:hover{
    color:black;

}
.de .lis:hover{
    color: white;
}


.nn{
    width:100px;
    /* background: #00B7FF; */
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

.overview{
    text-align: center;

    margin-top: 40px;
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

#stat{
    margin-left: -8px;
    color:blue;
}
.nn {
  
    background-color: #00B7FF; 

}



   .search-form {
            text-align: center;
            margin-top: 20px; 
        }

        .search-form input[type="text"] {
            padding: 10px;
            width: 200px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .search-form input[type="text"]:focus {
            border-color: #00B7FF;
        }

        .search-form button[type="submit"] {
            padding: 10px 20px;
            background-color: #00B7FF;
            
        }

        .search-form button[type="submit"]:hover {
            background-color: #0077B3; /* Darker shade of blue on hover */
        }

</style>
</head>
<body class="body">

<?php
// Include database connection file
require_once('connection.php');
session_start();

$value = $_SESSION['email'];

$sql = "SELECT * FROM users WHERE EMAIL='$value'";
$result_user = mysqli_query($con, $sql);
$rows_user = mysqli_fetch_assoc($result_user);

// Fetch cars from user_cars table
$sql_cars = "SELECT * FROM usercars WHERE AVAILABLE='Y'";
$cars = mysqli_query($con, $sql_cars);

// Handle search form submission
if (isset($_POST['submit'])) {
    $search_branch = $_POST['branch'];
    $search_capacity = $_POST['capacity'];
    $search_price = $_POST['price'];

    if (!empty($search_branch)){
        $sql2 = "SELECT * FROM cars WHERE branch = '$search_branch' AND AVAILABLE = 'Y'";}

    if (!empty($search_capacity)) {
        $search_capacity = intval($search_capacity);
        $sql_cars .= " AND CAPACITY = $search_capacity";
    }

    if (!empty($search_price)) {
        if ($search_price == '0-50') {
            $sql_cars .= " AND PRICE >= 0 AND PRICE <= 50";
        } elseif ($search_price == '50-100') {
            $sql_cars .= " AND PRICE > 50 AND PRICE <= 100";
        } elseif ($search_price == '100+') {
            $sql_cars .= " AND PRICE > 100";
        }
    }

    $cars = mysqli_query($con, $sql_cars);

    if (mysqli_num_rows($cars) == 0) {
        echo '<script>alert("No cars available based on the selected criteria.")</script>';
    }
}
?>

<div class="cd">
    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">DEEBS</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="cardetails.php">HOME</a></li>
                    <li><a href="peertopeerbook.php">Booking status (peer to peer)</a></li>
                    <li><a href="contactus2.html">CONTACT</a></li>
                    <li><a href="feedback/Feedbacks.php">FEEDBACK</a></li>
                    <li><button class="nn"><a href="index.php">LOGOUT</a></button></li>
                    <li><img src="images/profile.png" class="circle" alt="Alps"></li>
                    <li><p class="phello">HELLO! &nbsp;<a id="pname"><?php echo $rows_user['FNAME']." ".$rows_user['LNAME']?></a></p></li>
                  
                    
                </ul>
                <ul>
        <li><a href="uploaduser.php"><button class="nn">Upload Car +</button></a></li>
    </ul>
            </div>
        </div>

     

        <!-- Search Form -->
        <form method="POST" class="search-form">
            <select name="branch">
            <option value="">Select your city</option>
                <option value="Montreal">Montreal</option>
                <option value="Toronto">Toronto</option>
                <option value="Calgary">Calgary</option>
                <option value="Vancouver">Vancouver</option>
            </select>
            <select name="capacity">
                <option value="">Select Capacity</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <select name="price">
                <option value="">Select Price Range</option>
                <option value="0-50">$0 - $50</option>
                <option value="50-100">$50 - $100</option>
                <option value="100+">$100+</option>
            </select>
            <button type="submit" name="submit">Search</button>
        </form>

        <!-- Cars Overview -->
        <div>
            <h1 class="overview">AVAILABLE CARS</h1>
            <ul class="de">
                <?php while ($result = mysqli_fetch_array($cars)) { ?>
                    <li>
                        <form method="POST">
                            <div class="box">
                                <div class="imgBx">
                                    <img src="images/<?php echo $result['CAR_IMG']?>">
                                </div>
                                <div class="content">
                                    <h1><?php echo $result['CAR_NAME']?></h1>
                                    <h2>Fuel Type: <?php echo $result['FUEL_TYPE']?></h2>
                                    <h2>Capacity: <?php echo $result['CAPACITY']?></h2>
                                    <h2>Rent Per Day: $CA <?php echo $result['PRICE']?></h2>
                                    <h2>City: <?php echo $result['branch']?></h2>
                                    <button type="submit" name="booknow" class="button" style="margin-top: 5px; color: #00B7FF;">
                                        <a href="bookinguser.php?id=<?php echo $result['CAR_ID'];?>">Book</a>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

</body>
</html>
