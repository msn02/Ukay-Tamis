<?php
    include ('server/connection.php');

    session_start();

    if(!isset($_SESSION['logged_in'])){
        header("Location: log_in.php");
        exit();
    }

    if(isset($_GET['logout'])){
        if (isset($_SESSION['logged_in'])) {

            $user_id = $_SESSION['user_id'];
            $action = 'logout'; 

            // insert record to user_logs
            $stmt1 = $conn -> prepare ("INSERT INTO user_logs (user_id, action) VALUES (?, ?)");
            $stmt1 -> bind_param("ss", $user_id, $action);
            $stmt1 -> execute();

            unset($_SESSION['logged_in']);
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            unset($_SESSION['first_name']);
            unset($_SESSION['last_name']);
            session_destroy();
            header("Location: log_in.php");
            exit();
        }
    }

    if(isset($_POST['change_pass_btn'])){
        $new_password = $_POST['new_password'];
        $confirm_new_password = $_POST['confirm_new_password'];
        $user_id = $_SESSION['user_id'];

        // if password do not match
        if ($new_password != $confirm_new_password) {
            header("Location: account.php?error=Password does not match");
        }
    
        // if password is less than 8 characters
        else if (strlen($new_password) < 8) {
            header("Location: account.php?error=Password must be at least 8 characters");
        }

        // if there are no errors
        else {
            $hashed_password = md5($new_password);
            $stmt = $conn -> prepare ("UPDATE user SET password = ? WHERE user_id = ?");
            $stmt -> bind_param("ss", $hashed_password, $user_id);
            $stmt -> execute();

            // insert record to user_logs
            $action = 'change password'; 

            $stmt1 = $conn -> prepare ("INSERT INTO user_logs (user_id, action) VALUES (?, ?)");
            $stmt1 -> bind_param("ss", $user_id, $action);
            $stmt1 -> execute();

            if ($stmt -> execute()) {
                header("Location: account.php?success=Password changed successfully");
            } else {
                header("Location: account.php?error=Something went wrong");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/about.css">
</head>
<body class="gray_bg">
    <!-- navigation bar -->
    <?php 
        if (isset($_SESSION['logged_in'])) {
            include 'auth_nav_bar.php';
        } else {
            include 'nav_bar.php';
        }
    ?>

    <div class="container-fluid">
        <div class="container">


        <div class="row shadow rounded-2 m-3 gray_bg">

                <!-- product details -->
                <div class="col-sm-7 m-0 py-4 px-3">
                    <!-- tag and title -->
                    <div class="row m-0 p-3 pb-0 justify-content-between g-3">
                        <div class="col-sm-10 m-0 p-0">
                            <h2 class="bold_header align-content-center ps-0 mb-0 pb-0">ACCOUNT INFO</h2>
                        </div>
                        <div class="d-sm-none d-block m-1"></div>
                    </div>
                    <!-- box price -->
                    <div class="pt-3 px-3 mb-0">
                        <div class="m-0">
                            <h4 class="pink_highlight2 rounded-2 p-3 bold_header box_price"> <?php if (isset($_SESSION['first_name']) && ($_SESSION['last_name'])) {echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; } ?> </h4>
                        </div>
                    </div>
                    <!-- style description -->
                    <div class="pt-3 px-3 mb-0">
                        <div class=" pt-3 pb-0 m-0">
                            <h6 class="bold_header"> <?php if (isset($_SESSION['username'])) { echo $_SESSION['username']; } ?> </h6>
                            <h6 class="bold_header"> <?php if (isset($_SESSION['email'])) { echo $_SESSION['email']; } ?> </h6>
                            <h6 class="bold_header"> phone: <?php if (isset($_SESSION['phone_number'])) { echo $_SESSION['phone_number']; } ?> </h6>
                            <h6 class="bold_header"> address:  <?php if (isset($_SESSION['address'])) { echo $_SESSION['address']; } ?> </h6>
                        </div>
                    </div>

                    <p><a href = "account.php?logout" id = "logout_btn">Log Out<a></p>

                    <div class="log_sign_btn mt-4 center_align">
                            <button class="btn btn-dark border-0 rounded-1 px-4 py-1" onclick="">Set up Preferences</button>
                    </div>
                   
                </div>

                <!-- CHANGE PASSWORD -->
                <form class="form_style p-4 m-0" method = "POST" action = "account.php">

                <p style="color: red"> <?php if (isset($_GET['error'])) { echo $_GET['error']; } ?> </p>
                <p style="color: green"> <?php if (isset($_GET['success'])) { echo $_GET['success']; } ?> </p>


                        <div class="border-top col-sm-10 m-0 p-0">
                            <h2 class="bold_header align-content-center ps-0 mb-0 pb-0">CHANGE PASSWORD</h2>
                        </div>

                        <div class="mb-3">
                            <label for="input_uname" class="form-label ms-1">Password</label>
                            <input type="password" class="form-control" id="input_uname" name = "new_password" placeholder="Enter new password" required>
                        </div>
                        <div class="mb-3">
                            <label for="input_pass" class="form-label ms-1">Confirm Password</label>
                            <input type="password" class="form-control" id="input_pass" name = "confirm_new_password" placeholder="Confirm new password" required>
                        </div>
                        <!-- TO DO: Error warning (if password is incorrect/no account/no username found) -->
                        <div class="log_sign_btn mt-4 center_align">
                            <input class="btn btn-dark border-0 rounded-1 px-4 py-1" onclick="" name = "change_pass_btn" value = "Confirm" type = "submit"></input>
                        </div>
                </form>

                <!-- TRANSACTIONS -->
                <div class="col-sm-7 m-0 py-4 px-3">
                    <!-- tag and title -->
                    <div class="row m-0 p-3 pb-0 justify-content-between g-3">
                        <div class="col-sm-10 m-0 p-0">
                            <h2 class="bold_header align-content-center ps-0 mb-0 pb-0">TRANSACTIONS</h2>
                        </div>
                        <div class="d-sm-none d-block m-1"></div>
                    </div>
                    <!-- box price -->
                    <div class="pt-3 px-3 mb-0">
                        <div class="m-0">
                            <h4 class="pink_highlight2 rounded-2 p-3 bold_header box_price">PHP 123</h4>
                        </div>
                    </div>
                    <!-- style description -->
                    <div class="pt-3 px-3 mb-0">
                        <div class="border-top pt-3 pb-0 m-0">
                            <h6 class="bold_header">Style Description</h6>
                            <p class="box_desc m-0 p-0">HEllo</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
</body>
</html>