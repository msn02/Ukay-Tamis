<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
                <div class="col-md-4 rounded-3 gray_bg shadow mt-3 p-0">
                    <div class="header_style px-4 pt-4 mb-2 rounded-top-3 overflow-hidden">
                        <h2 class="bold_header center_text ">Forgot Password</h2>
                    </div>
                    <form class="form_style p-4 m-0">
                        <!-- user email input -->
                        <div class="mx-2 mt-0">
                            <p>Enter the email associated to your account and we will display your security question.</p>
                        </div>
                        <div class="mb-3">
                            <label for="input_uname" class="form-label ms-1">Email</label>
                            <input type="text" class="form-control" id="input_email" placeholder="Enter your email">
                        </div>
                        
                        <!-- TO DO: Error warning (if email is incorrect/not found) -->
                        <div class="log_sign_btn mt-4 center_align">
                            <button class="btn btn-dark border-0 rounded-1 px-4 py-1 mb-3" onclick="">Verify</button>
                        </div>
                        
                        <!-- security question -->
                        <div class="my-2 sec_question text-center yellow_bg rounded-1">
                            <p class="p-3">Your security question will be shown here</p>
                        </div>

                        <div class="my-3">
                            <label for="input_ans" class="form-label ms-1">Answer</label>
                            <input type="text" class="form-control" id="input_ans" placeholder="Enter your answer">
                        </div>
                        
                        <!-- TO DO: Error warning (if answer is incorrect) -->
                        <!-- submit -->
                        <div class="log_sign_btn mt-4 center_align">
                            <a href="change_pass.php" class="text-decoration-none"><button class="btn btn-dark border-0 rounded-1 px-4 py-1" onclick="">Submit</button></a>
                        </div>

                        <!-- create account -->
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