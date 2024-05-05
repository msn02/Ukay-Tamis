<?php
    // include connection
    include ('server/connection.php');

    // start session
    session_start();

    if (isset($_SESSION['logged_in'])) {
        header('location: account.php');
        exit();
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['login_btn'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
    
            $stmt = $conn -> prepare ("SELECT user_id, username, email, first_name, last_name FROM user WHERE username = ? AND password = ? LIMIT 1");
    
            $stmt -> bind_param("ss", $username, $password);
    
            if ($stmt -> execute()) {
                $stmt -> bind_result($user_id, $username, $email, $first_name, $last_name);
                $stmt -> store_result();
    
                if ($stmt -> num_rows == 1) {
                    $stmt -> fetch();
    
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['first_name'] = $first_name;
                    $_SESSION['last_name'] = $last_name;
                    $_SESSION['logged_in'] = true;
    
                    header('location: account.php?message=Login successful. Welcome back, ' . $username . ' !');
                } else {
                    header('location: log_in.php?error=Could not verify your account. Please try again.');
                }
            } else {
                header('location: log_in.php?error=Something went wrong. Please try again.');
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
    <?php include 'nav_bar.php'?>

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
                        <p><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

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
                            <input class="btn btn-dark border-0 rounded-1 px-4 py-1" type = "submit" name = "login_btn" value = "Login"></input>
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
</html>