<?php
if(isset($_POST['addcar'])) {
    require_once('connection.php');

    // Fetch user information based on session email
    session_start();
    $value = $_SESSION['email'];
    $sql_user = "SELECT FNAME, EMAIL FROM users WHERE EMAIL='$value'";
    $result_user = mysqli_query($con, $sql_user);
    $row_user = mysqli_fetch_assoc($result_user);

    // Validate uploaded image
    $img_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];

    if($error === 0) {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "jpeg", "png", "webp", "svg");
        if(in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'images/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            // Get form data
            $carname = mysqli_real_escape_string($con, $_POST['carname']);
            $ftype = mysqli_real_escape_string($con, $_POST['ftype']);
            $capacity = mysqli_real_escape_string($con, $_POST['capacity']);
            $price = mysqli_real_escape_string($con, $_POST['price']);
            $branch = mysqli_real_escape_string($con, $_POST['branch']);

            // Add car to usercars table with associated user details
            $query = "INSERT INTO usercars (CAR_NAME, FUEL_TYPE, CAPACITY, PRICE, CAR_IMG, AVAILABLE, branch, username, email) 
                      VALUES ('$carname', '$ftype', $capacity, $price, '$new_img_name', 'Y', '$branch', '{$row_user['FNAME']}', '{$row_user['EMAIL']}')";
            $res = mysqli_query($con, $query);

            if($res) {
                echo '<script>alert("New Car Added Successfully!!")</script>';
                echo '<script>window.location.href = "uploaduser.php";</script>';
            } else {
                echo '<script>alert("Error: Failed to add car")</script>';
                echo '<script>window.location.href = "uploaduser.php";</script>';
            }
        } else {
            echo '<script>alert("Cannot upload this type of image")</script>';
            echo '<script>window.location.href = "uploaduser.php";</script>';
        }
    } else {
        $em = "Unknown error occurred";
        header("Location: uploaduser.php?error=$em");
    }
} else {
    echo "false";
}
?>
