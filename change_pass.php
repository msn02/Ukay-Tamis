<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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
                        <h2 class="bold_header center_text ">Reset Password</h2>
                    </div>
                    <form class="form_style p-4 m-0">
                        <!-- user email input -->
                        <div class="mb-3">
                            <label for="new_pass" class="form-label ms-1">New Password</label>
                            <input type="text" class="form-control" id="new_pass" placeholder="Enter your new password">
                        </div>
                        
                        <div class="my-3">
                            <label for="re_pass" class="form-label ms-1">Confirm Password</label>
                            <input type="text" class="form-control" id="re_pass" placeholder="Re-enter new password">
                        </div>
                        
                        <!-- submit -->
                        <div class="log_sign_btn mt-4 center_align mb-4">
                            <button class="btn btn-dark border-0 rounded-1 px-4 py-1" onclick="">Change Password</button>
                        </div>

                        <!-- TO DO: add modal for confirmation of password reset -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>