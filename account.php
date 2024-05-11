<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/account.css">
</head>
<body class="gray_bg2">
    <!-- navigation bar -->
    <?php include 'nav_bar.php'?>

    <div class="container-fluid gradient_pink m-0 p-0 pt-1">
        <div class="container px-5 py-3">
            <!-- back button -->
            <div class="back_link p-0 mt-2">
                <a class="border-0 ps-2 pb-0 rounded-1 justify-content-start text-decoration-none w-25 mb-4" id="go_back" href="javascript:void(0)"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>
            
            <div class="row py-2 px-1 m-0 justify-content-between">
                <!-- user profile, address, subscription, transactions -->
                <div class="col-sm-8 py-3 px-2 m-0">
                    <div class="row mb-2 mx-0 p-3 d-flex align-items-stretch justify-content-between card rounded-2 border-0 hstack">
                        <!-- user profile -->
                        <div class="col-sm-6 p-3 user_info m-0">
                            <h6 class="border-bottom pb-2 bold_header">My Profile</h6>
                            <div class="m-0 py-2">
                                <h4 class="pink_highlight2 bold_header mb-1 p-0">Juan Dela Cruz</h4>
                                <p class="bold_header">example@email.com</p>
                                <div class="mt-2 mb-0 p-0 hstack">
                                    <!-- change pass -->
                                    <div class="pink_btn2 mb-0 mt-3 me-2">
                                        <button class="btn btn-dark border-0 rounded-1">Change Password</button>
                                    </div>
                                    <div class="gray_btn mb-0 mt-3">
                                        <button class="btn btn-dark border-0 rounded-1">Set Security Questions</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- delivery address -->
                        <div class="col-sm-6 p-3 user_info m-0">
                            <h6 class="border-bottom pb-2 bold_header">Delivery Address</h6>
                            <div class="m-0 py-2">
                                <p class="pink_highlight2 bold_header mb-1 p-0">Juan Dela Cruz</p>
                                <p class="m-0 p-0">09123456789</p>
                                <p class="m-0 p-0">69075 Louann Turnpike, West Mariella, KY 01624</p>
                                <div class="mt-2 p-0">
                                    <!-- edit address -->
                                    <div class="pink_btn2 mt-3 mb-0 me-2">
                                        <button class="btn btn-dark border-0 rounded-1">Edit Address</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2 mt-3 mx-0 p-3 d-flex align-items-stretch justify-content-between card rounded-2 border-0 hstack">
                        <!-- recent transactions -->
                        <div class="col-sm-12 p-3 user_info m-0">
                            <h6 class="border-bottom pb-2 bold_header">Recent Transactions</h6>
                            <table class="table">
                                <thead class="text-center">
                                    <tr class="thead_style">
                                        <th scope="col">Order #</th>
                                        <th scope="col">Placed on</th>
                                        <th scope="col-1">Product</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="product_info align-middle">
                                        <!-- product ordered -->
                                        <td scope="row">12345</td>
                                        <td class="text-center">05/10/24</td>
                                        <td class="item_img d-flex justify-content-center">
                                            <img src="resources/coquette.jpg" class="card m-0" alt="item">
                                        </td>
                                        <td class="text-center bold_header"><span class="pink_highlight2 ">PHP 123</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- right panel -->
                <div class="col-sm-4 py-3 px-2 m-0">
                    <div class="row mb-2 mx-0 p-3 d-flex align-items-stretch justify-content-between card rounded-2 border-0 hstack">
                        <!-- measurements -->
                        <div class="col-12 p-3 user_info m-0">
                            <h6 class="border-bottom pb-2 bold_header">My Measurements</h6>
                            <div class="m-0 py-2">
                                <div class="col mb-2 d-flex justify-content-between">
                                    <p>Height</p>
                                    <p class="bold_header">123</p>
                                </div>
                                <div class="col mb-2 d-flex justify-content-between">
                                    <p>Weight</p>
                                    <p class="bold_header">123</p>
                                </div>
                                <div class="col mb-2 d-flex justify-content-between">
                                    <p>Bust</p>
                                    <p class="bold_header">123</p>
                                </div>
                                <div class="col mb-2 d-flex justify-content-between">
                                    <p>Waist</p>
                                    <p class="bold_header">123</p>
                                </div>
                                <div class="col mb-2 d-flex justify-content-between">
                                    <p>Hips</p>
                                    <p class="bold_header">123</p>
                                </div>
                                
                                <!-- edit button -->
                                <div class="mt-2 p-0">
                                    <!-- <div class="pink_btn2 mt-2 me-2">
                                        <button class="btn btn-dark border-0 rounded-1">Edit Profile</button>
                                    </div> -->
                                    <div class="gray_btn mb-0 mt-3">
                                        <button class="btn btn-dark border-0 rounded-1 w-100">Edit Measurements</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- subscriptions -->
                        <div class="col-12 p-3 subscription_info m-0">
                            <h6 class="border-bottom pb-2 bold_header">My Subscription</h6>
                            <!-- subscription details -->
                            <div class="row my-3 center_align m-0 p-0">
                                <div class="card border-0 price_badge p-3 m-0 package_info">
                                    <h6 class="bold_header mb-1">PREMIUM Tier</h6>
                                    <p class="bold_header mb-2">6 Months</p>
                                    <p class="card-text mb-0">Ends on <span class="bold_header">November 10, 2024</span></p>
                                </div>
                                <div class="gray_btn mt-3 mb-0 p-0">
                                    <button class="btn btn-dark border-0 rounded-1 w-100" disabled>Cancel Subscription</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- footer -->
        <?php include 'footer.php'?>
    </div>
</body>
</html>