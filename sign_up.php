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
    <?php include 'nav_bar.php'?>

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
                    <form class="row form_style px-4 py-3 g-2">
                        <!-- personal details -->
                        <div class="col-sm-6 rounded-2 p-3">
                            <h6 class="bold_header">User Information</h6>
                            <div class="mb-3">
                                <label for="input_fname" class="form-label ms-1">First Name</label>
                                <input type="text" class="form-control" id="input_fname" placeholder="Enter your first name">
                            </div>
                            <div class="mb-3">
                                <label for="input_lname" class="form-label ms-1">Last Name</label>
                                <input type="text" class="form-control" id="input_lname" placeholder="Enter your last name">
                            </div>
                            <div class="mb-3">
                                <label for="input_add" class="form-label ms-1">Address</label>
                                <input type="text" class="form-control" id="input_add" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="input_num" class="form-label ms-1">Phone Number</label>
                                <input type="text" class="form-control" id="input_num" placeholder="E.g, 09123456789">
                            </div>
                            <div class="mb-3">
                                <label for="input_email" class="form-label ms-1">Email</label>
                                <input type="email" class="form-control" id="input_email" placeholder="Enter your email">
                            </div>
                        </div>
                        
                        <!-- account credentials -->
                        <div class="col-sm-6 border rounded-2 p-3">
                            <h6 class="bold_header">Account Credentials</h6>
                            <div class="mb-3">
                                <label for="input_uname" class="form-label ms-1">Username</label>
                                <input type="text" class="form-control" id="input_uname" placeholder="Enter your username">
                            </div>
                            <div class="mb-3">
                                <label for="input_pass" class="form-label ms-1">Password</label>
                                <input type="password" class="form-control" id="input_pass" placeholder="Password must be more than 8 characters">
                            </div>
                            <div class="mb-3">
                                <label for="re_pass" class="form-label ms-1">Confirm Password</label>
                                <input type="password" class="form-control" id="re_pass" placeholder="Re-enter your password">
                            </div>
                            <div class="form-check form_condi">
                                <input class="form-check-input" type="checkbox" value="" id="checkbox_agree">
                                <label class="form-check-label" for="checkbox_agree">
                                    By creating an account, you agree to the <a href="#" class="pink_highlight2 text-decoration-none">Terms and Conditions</a> and <a href="#" class="pink_highlight2 text-decoration-none">Privacy Policy</a> of UKAY TAMIS.
                                </label>
                            </div>
                        </div>
                        <!-- TO DO: Error warning (if password is not more than 8 characters) -->
                        <div class="log_sign_btn mt-4 center_align">
                            <button class="btn btn-dark border-0 rounded-1 px-4 py-1" onclick="" id="signup_btn" disabled>Sign up</button>
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