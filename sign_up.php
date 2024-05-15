<?php
    // include connection
    include 'server/connection.php';

    // start session
    session_start();

    // if the user is already logged in, redirect to account page
    if (isset($_SESSION['logged_in'])) {
        header('location:account.php');
        exit;
    // if the request method is GET, clear the session data
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        unset($_SESSION['form_data']);
    // if the request method is POST, continue with sign 
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['signup_btn'])) {
            // get user input
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $address = $_POST['address'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // store form data in session
            $_SESSION['form_data'] = $_POST;
            
            // if password do not match
            if ($password != $confirm_password) {
                $error_password_unmatch = true;
            }
        
            // if password is less than 8 characters
            else if (strlen($password) < 8) {
                $error_password_length = true;
            }
        
            // create error if the checkbox is not checked
            else if (!isset($_POST['checkbox_agree'])) {
                $error_checkbox = true;
            }
        
            // if there are no errors
            else {
                // check if email already exists
                $stmt1 = $conn -> prepare ("SELECT count(*) FROM user WHERE email = ?");
                $stmt1 -> bind_param("s", $email);
                $stmt1 -> execute();
                $stmt1 -> store_result();
                $stmt1 -> bind_result($num_rows);
                $stmt1 -> fetch();
        
                if ($num_rows > 0) {
                    $error_email_exists = true;

                    $stmt1 -> close();
                    $conn -> close();
                } else {
                    // check if username already exists
                    $stmt2 = $conn -> prepare ("SELECT count(*) FROM user WHERE username = ?");
                    $stmt2 -> bind_param("s", $username);
                    $stmt2 -> execute();
                    $stmt2 -> store_result();
                    $stmt2 -> bind_result($num_rows);
                    $stmt2 -> fetch();
        
                    if ($num_rows > 0) {
                        $error_username_exists = true;

                        $stmt2 -> close();
                        $conn -> close();
                    } else {
                        // insert user into database if no errors
                        $stmt = $conn -> prepare ("INSERT INTO user (username, email, password, first_name, last_name, phone_number, address) 
                                                   VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $hashed_password = hash('sha256', $password);
                        $stmt -> bind_param("sssssss", $username, $email, $hashed_password, $first_name, $last_name, $phone_number, $address);
        
                        if ($stmt -> execute()) {
                    
                            unset($_SESSION['form_data']);

                            $_SESSION['email'] = $email;
                            $_SESSION['username'] = $username;
                            $_SESSION['first_name'] = $first_name;
                            $_SESSION['last_name'] = $last_name;
                            $_SESSION['phone_number'] = $phone_number;
                            $_SESSION['address'] = $address;
                            $_SESSION['logged_in'] = true;
        
                            $error_signup_success = true;

                            header('location:account.php?register=You have successfully registered!');
                        } else {
                            // error if sign up fails
                            $error_signup_fail = true;
                        }
                    }
                }
            }
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
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

    <div class="container-fluid gradient_pink px-3 pt-1">
        <div class="container px-5 py-3">
            <!-- back button -->
            <div class="back_link p-0 mt-2">
                <a class="border-0 ps-2 pb-0 rounded-1 justify-content-start text-decoration-none w-25 mb-4" id="go_back" href="javascript:void(0)"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>
            
            <div class="row center_align pt-0 px-5 pb-5 mt-3">
                <div class="col-md-8 rounded-3 gray_bg shadow mt-3 p-0">
                    <div class="header_style px-4 pt-4 mb-2 rounded-top-3 overflow-hidden">
                        <h2 class="bold_header center_text ">SIGN UP</h2>
                    </div>

                    <!-- sign up form -->
                    <form class="register_form row form_style px-4 py-3 g-2" method = "POST" action = "sign_up.php">

                        <!-- Display a message depending on the error -->
                        <?php if (isset($error_password_unmatch)): ?>
                            <!-- If passwords do not match -->
                            <div class="alert alert-warning py-3 mb-3 d-flex justify-content-between" role="alert">
                                <div class="alert_mes">Password does not match!</div>
                                <button class='btn-close' data-bs-dismiss='alert' aria-label='Close' type='button'></button>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($error_password_length)): ?>
                            <!-- If the password is less than 8 characters -->
                            <div class="alert alert-danger py-3 mb-3 d-flex justify-content-between" role="alert">
                                <div class="alert_mes">Password must be more than 8 characters!</div>
                                <button class='btn-close' data-bs-dismiss='alert' aria-label='Close' type='button'></button>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($error_checkbox)): ?>
                            <!-- If the checkbox has not been clicked -->
                            <div class="alert alert-danger py-3 mb-3 d-flex justify-content-between" role="alert">
                                <div class="alert_mes">Please agree to the terms and conditions!</div>
                                <button class='btn-close' data-bs-dismiss='alert' aria-label='Close' type='button'></button>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($error_email_exists)): ?>
                            <!-- If there is an existing account with the same email -->
                            <div class="alert alert-danger py-3 mb-3 d-flex justify-content-between" role="alert">
                                <div class="alert_mes">Email already exists!</div>
                                <button class='btn-close' data-bs-dismiss='alert' aria-label='Close' type='button'></button>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($error_username_exists)): ?>
                            <!-- If the username already exists -->
                            <div class="alert alert-danger py-3 mb-3 d-flex justify-content-between" role="alert">
                                <div class="alert_mes">Username already exists!</div>
                                <button class='btn-close' data-bs-dismiss='alert' aria-label='Close' type='button'></button>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($error_signup_success)): ?>
                            <!-- If the sign-up is successful -->
                            <div class="alert alert-success py-3 mb-3 d-flex justify-content-between" role="alert">
                                <div class="alert_mes">Sign up successful!</div>
                                <button class='btn-close' data-bs-dismiss='alert' aria-label='Close' type='button'></button>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($error_signup_fail)): ?>
                            <!-- If the sign up fails-->
                            <div class="alert alert-danger py-3 mb-3 d-flex justify-content-between" role="alert">
                                <div class="alert_mes">An error occurred!</div>
                                <button class='btn-close' data-bs-dismiss='alert' aria-label='Close' type='button'></button>
                            </div>
                        <?php endif; ?>

                        <!-- personal details -->
                        <div class="col-sm-6 rounded-2 p-3">
                            <h6 class="bold_header">User Information</h6>
                            <div class="mb-3">
                                <label for="input_fname" class="form-label ms-1">First Name</label>
                                <input type="text" class="form-control" id="input_fname" name="first_name" placeholder="Enter your first name" value = "<?php echo isset($_SESSION['form_data']['first_name']) ? $_SESSION['form_data']['first_name'] : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="input_lname" class="form-label ms-1">Last Name</label>
                                <input type="text" class="form-control" id="input_lname" name="last_name" placeholder="Enter your last name" value = "<?php echo isset($_SESSION['form_data']['last_name']) ? $_SESSION['form_data']['last_name'] : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="input_add" class="form-label ms-1">Address</label>
                                <input type="text" class="form-control" id="input_add" name="address" placeholder="" value = "<?php echo isset($_SESSION['form_data']['address']) ? $_SESSION['form_data']['address'] : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="input_num" class="form-label ms-1">Phone Number</label>
                                <input type="text" class="form-control" id="input_num" name="phone_number" placeholder="E.g, 09123456789" value = "<?php echo isset($_SESSION['form_data']['phone_number']) ? $_SESSION['form_data']['phone_number'] : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="input_email" class="form-label ms-1">Email</label>
                                <input type="email" class="form-control" id="input_email" name="email" placeholder="Enter your email" value = "<?php echo isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : ''; ?>" required>
                            </div>
                        </div>
                        
                        <!-- account credentials -->
                        <div class="col-sm-6 border rounded-2 p-3">
                            <h6 class="bold_header">Account Credentials</h6>
                            <div class="mb-3">
                                <label for="input_uname" class="form-label ms-1">Username</label>
                                <input type="text" class="form-control" id="input_uname" name="username" placeholder="Enter your username" value = "<?php echo isset($_SESSION['form_data']['username']) ? $_SESSION['form_data']['username'] : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="input_pass" class="form-label ms-1">Password</label>
                                <input type="password" class="form-control" id="input_pass" name="password" placeholder="Password must be more than 8 characters" required>
                            </div>
                            <div class="mb-3">
                                <label for="re_pass" class="form-label ms-1">Confirm Password</label>
                                <input type="password" class="form-control" id="re_pass" name="confirm_password" placeholder="Re-enter your password" required>
                            </div>
                            <div class="form-check form_condi">
                                <input class="form-check-input" type="checkbox" value="" name="checkbox_agree" id="checkbox_agree" required>
                                <label class="form-check-label" for="checkbox_agree">
                                    By creating an account, you agree to the <a href="#" class="pink_highlight2 text-decoration-none">Terms and Conditions</a> and <a href="#" class="pink_highlight2 text-decoration-none">Privacy Policy</a> of UKAY TAMIS.
                                </label>
                            </div>
                        </div>
                        <!-- TO DO: Error warning (if password is not more than 8 characters) -->
                        <div class="log_sign_btn mt-4 center_align">
                            
                            <button class="btn btn-dark border-0 rounded-1 px-4 py-1" onclick="" type = "submit" id="signup_btn" name="signup_btn" value = "Sign Up">Sign up</button>
                        </div>
                        <div class="center_align mt-4 mb-0 p-0">
                            <p>Aready have an account? <span class="sign_up_link"><a href="log_in.php" class="text-decoration-none">Log In</a></span></p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>
</html>