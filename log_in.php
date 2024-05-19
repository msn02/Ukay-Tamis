<?php
    // include connection
    include ('server/connection.php');

    // start session
    session_start();

    // define remaining_time and give it a default value
    echo "<script>var remaining_time = 0;</script>";

    // check if the user has tried to log in more than 5 times in the last 5 minutes
    if (isset($_SESSION['failed_login_attempts']) && $_SESSION['failed_login_attempts'] > 5 && 
        isset($_SESSION['last_failed_login']) && (time() - $_SESSION['last_failed_login']) < 300) {
        $remaining_time = 300 - (time() - $_SESSION['last_failed_login']);
        echo "<script>remaining_time = $remaining_time;</script>";
        $_SESSION['error'] = 'Too many failed attempts. Please wait for 5 minutes before trying again.';
    }

    if (isset($_SESSION['logged_in'])) {
        header('location: account.php');
        exit();
    } 
    
    else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if (isset($_POST['login_btn'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Retrieve the salt for the given username
            $stmt_salt = $conn->prepare("SELECT salt FROM user WHERE username = ?");
            $stmt_salt->bind_param("s", $username);
            $stmt_salt->execute();
            $stmt_salt->store_result();

            if ($stmt_salt->num_rows == 1) {
                $stmt_salt->bind_result($salt);
                $stmt_salt->fetch();

                // Append salt to the password and hash it
                $hashed_password = hash('sha256', $password . $salt);

                $stmt = $conn -> prepare ("SELECT user_id, username, email, first_name, last_name, phone_number, address FROM user WHERE username = ? AND password = ? LIMIT 1");
        
                $stmt -> bind_param("ss", $username, $hashed_password);
        
                if ($stmt -> execute()) {
                    $stmt -> bind_result($user_id, $username, $email, $first_name, $last_name, $phone_number, $address);
                    $stmt -> store_result();
        
                    if ($stmt -> num_rows == 1) {
                        $stmt -> fetch();
        
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['username'] = $username;
                        $_SESSION['email'] = $email;
                        $_SESSION['first_name'] = $first_name;
                        $_SESSION['last_name'] = $last_name;
                        $_SESSION['phone_number'] = $phone_number;
                        $_SESSION['address'] = $address;
        
                        $_SESSION['logged_in'] = true;

                        // reset failed login attempts
                        $_SESSION['failed_login_attempts'] = 0;
            
                        // insert record to user_logs
                        $action = 'login'; 
                        $stmt1 = $conn -> prepare ("INSERT INTO user_logs (user_id, action) VALUES (?, ?)");
                        $stmt1 -> bind_param("ss", $user_id, $action);
                        $stmt1 -> execute();
                        
                        header('location: account.php?message=Login successful. Welcome back, ' . $username . ' !');
                    } else {
                        header('location: log_in.php?error=Incorrect Password or Username. Please try again.');
                        // increment failed login attempts
                        $_SESSION['failed_login_attempts'] = isset($_SESSION['failed_login_attempts']) ? $_SESSION['failed_login_attempts'] + 1 : 1;
                        // record the time of the last failed attempt
                        $_SESSION['last_failed_login'] = time();

                        if (isset($_SESSION['failed_login_attempts']) && $_SESSION['failed_login_attempts'] > 5 && 
                            isset($_SESSION['last_failed_login']) && (time() - $_SESSION['last_failed_login']) < 10) {
                            $remaining_time = 10 - (time() - $_SESSION['last_failed_login']);
                            echo "<input type='hidden' id='remaining_time' value='$remaining_time'>";
                            echo "<script>var remaining_time = $remaining_time;</script>";
                            // echo in the console the time remaining
                            $current_time = time();
                            echo "<script>console.log('Time remaining: $current_time seconds');</script>";
                            

                        } else {
                            // If more than 5 minutes have passed since the last failed login, unset the session variables
                            if (isset($_SESSION['last_failed_login'])) {
                                $time_since_last_failed_login = time() - $_SESSION['last_failed_login'];
                                if ($time_since_last_failed_login >= 300) {
                                    unset($_SESSION['failed_login_attempts']);
                                    unset($_SESSION['last_failed_login']);
                                }
                            } else {
                                echo "last_failed_login session variable is not set.<br>";
                            }
                            header('location: log_in.php?error=Incorrect Password or Username. Please try again.');
                        }
                        header('location: log_in.php?error=Incorrect Password or Username. Please try again.');
                    }

                } else {
                    header('location: log_in.php?error=Something went wrong. Please try again.');
                }
            } else {
                header('location: log_in.php?error=Username not found.');
            }
        } else {
            echo ('Login button not clicked.');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/user_auth.css">
</head>
<body class="gray_bg2">
    <!-- navigation bar -->
    <?php 
        if (isset($_SESSION['logged_in'])) {
            include 'auth_nav_bar.php';
        } else {
            include 'nav_bar.php';
        }
    ?>

    <div class="container-fluid gradient_pink px-3 pt-1 center_align">
        <div class="container px-5 py-3 mt-3">
            <!-- back button -->
            <div class="back_link p-0 mt-5">
                <a class="border-0 ps-2 pb-0 rounded-1 justify-content-start text-decoration-none w-25 mb-4" id="go_back" href="javascript:void(0)"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>
            
            <div class="row center_align pt-0 px-5 pb-5 mt-3">
                <div class="col-md-4 rounded-3 gray_bg shadow mt-3 p-0">
                    <div class="header_style px-4 pt-4 mb-2 rounded-top-3 overflow-hidden">
                        <h2 class="bold_header center_text ">LOG IN</h2>
                    </div>

                    <form class="form_style p-4 m-0" method="POST" action="log_in.php">
                        <!-- error message -->
                        <p id="timer" ><?php
                        if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']); // remove the error message after displaying it
                        }
                        ?></p>
                        <div class="mb-3">
                            <label for="input_uname" class="form-label ms-1">Username</label>
                            <input type="text" class="form-control" id="input_uname" name = "username" placeholder="Enter your username" required>
                        </div>
                        <div class="mb-3">
                            <label for="input_pass" class="form-label ms-1">Password</label>
                            <input type="password" class="form-control" id="input_pass" name = "password" placeholder="Enter your password" required>
                            <!-- pass recovery -->
                            <div class="d-flex justify-content-end mt-2 p-0">
                                <a href="forgot_pass.php" class="forgot_pass text-decoration-none">Forgot Password</a>
                            </div>
                        </div>
                        <!-- TO DO: Error warning (if password is incorrect/no account/no username found) -->
                        <div class="log_sign_btn mt-4 center_align">
                            <button class="btn btn-dark border-0 rounded-1 px-4 py-1" type = "submit" name = "login_btn" value = "Login">Log in</button>
                        </div>
                        <div class="center_align mt-4 mb-0 p-0">
                            <p>Don't have an account? <span class="sign_up_link"><a href="sign_up.php" class="text-decoration-none">Create an Account</a></span></p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>
<script>
    window.onload = function() {
        var submitButton = document.querySelector('button[name="login_btn"]');
        var countdown = setInterval(function() {
            if (remaining_time > 0) {
                submitButton.disabled = true;
                remaining_time--;
                var minutes = Math.floor(remaining_time / 60);
                var seconds = remaining_time % 60;
                document.getElementById('timer').innerHTML = "Too many failed attempts. Please wait " + minutes + " minutes and " + seconds + " seconds before trying again.";
                submitButton.disabled = true;

                // console.log the remaining time
                console.log('Time remaining: ' + remaining_time + ' seconds');
            } else {
                clearInterval(countdown);
                document.getElementById('timer').innerHTML = "You can try to log in again.";
                submitButton.disabled = false;
            }
        }, 1000);
    }
</script>
</html>
