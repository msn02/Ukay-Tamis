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
                    <form class="form_style p-4 m-0">
                        <div class="mb-3">
                            <label for="input_uname" class="form-label ms-1">Username</label>
                            <input type="text" class="form-control" id="input_uname" placeholder="Enter your username">
                        </div>
                        <div class="mb-3">
                            <label for="input_pass" class="form-label ms-1">Password</label>
                            <input type="password" class="form-control" id="input_pass" placeholder="Enter your password">
                            <!-- pass recovery -->
                            <div class="d-flex justify-content-end mt-2 p-0">
                                <a href="forgot_pass.php" class="forgot_pass text-decoration-none">Forgot Password</a>
                            </div>
                        </div>
                        <!-- TO DO: Error warning (if password is incorrect/no account/no username found) -->
                        <div class="log_sign_btn mt-4 center_align">
                            <button class="btn btn-dark border-0 rounded-1 px-4 py-1" onclick="">Log in</button>
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