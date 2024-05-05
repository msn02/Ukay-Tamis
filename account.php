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
    <?php include 'nav_bar.php'?>

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
                            <h4 class="pink_highlight2 rounded-2 p-3 bold_header box_price">JUAN DELA CRUZ</h4>
                        </div>
                    </div>
                    <!-- style description -->
                    <div class="pt-3 px-3 mb-0">
                        <div class=" pt-3 pb-0 m-0">
                            <h6 class="bold_header">Username</h6>
                            <h6 class="bold_header">Email</h6>
                        </div>
                    </div>

                    <div class="log_sign_btn mt-4 center_align">
                            <input class="btn btn-dark border-0 rounded-1 px-4 py-1" onclick="" value = "Log out"></input>
                    </div>

                    <div class="log_sign_btn mt-4 center_align">
                            <input class="btn btn-dark border-0 rounded-1 px-4 py-1" onclick="" value = "View Orders"></input>
                    </div>

                    <div class="log_sign_btn mt-4 center_align">
                            <input class="btn btn-dark border-0 rounded-1 px-4 py-1" onclick="" value = "Set up Preferences"></input>
                    </div>
                   
                </div>

                <form class="form_style p-4 m-0">
                        <div class="border-top col-sm-10 m-0 p-0">
                            <h2 class="bold_header align-content-center ps-0 mb-0 pb-0">CHANGE PASSWORD</h2>
                        </div>

                        <div class="mb-3">
                            <label for="input_uname" class="form-label ms-1">Password</label>
                            <input type="text" class="form-control" id="input_uname" name = "new_password" placeholder="Enter new password">
                        </div>
                        <div class="mb-3">
                            <label for="input_pass" class="form-label ms-1">Confirm Password</label>
                            <input type="password" class="form-control" id="input_pass" name = "confirm_new_password" placeholder="Confirm new password">
                        </div>
                        <!-- TO DO: Error warning (if password is incorrect/no account/no username found) -->
                        <div class="log_sign_btn mt-4 center_align">
                            <input class="btn btn-dark border-0 rounded-1 px-4 py-1" onclick="" value = "Confirm"></input>
                        </div>

                    </form>

            </div>


        </div>
    </div>
</body>
</html>