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
    // Handle change password request
    if(isset($_POST['change_pass_btn'])){
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_new_password = $_POST['confirm_new_password'];
        $user_id = $_SESSION['user_id'];

        // Retrieve the user's current password from the database
        $stmt = $conn->prepare("SELECT password FROM user WHERE user_id = ?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($db_password);
            $stmt->fetch();

            // Verify if the old password matches the password retrieved from the database
            if (hash('sha256', $old_password) == $db_password) {
                // If old password matches, proceed with checking new password and confirm password
                if ($new_password == $confirm_new_password) {
                    // If new password and confirm password match, update password in the database
                    $hashed_password = hash('sha256', $new_password);
                    $update_stmt = $conn->prepare("UPDATE user SET password = ? WHERE user_id = ?");
                    $update_stmt->bind_param("ss", $hashed_password, $user_id);
                    if ($update_stmt->execute()) {
                        // Password changed successfully
                        $action = 'change password'; 
                        $stmt1 = $conn->prepare("INSERT INTO user_logs (user_id, action) VALUES (?, ?)");
                        $stmt1->bind_param("ss", $user_id, $action);
                        $stmt1->execute();
                        header("Location: account.php?success=Password changed successfully");
                        exit();
                    } else {
                        header("Location: account.php?error=Something went wrong");
                        exit();
                    }
                } else {
                    header("Location: account.php?error=New password and confirm password do not match");
                    exit();
                }
            } else {
                header("Location: account.php?error=Incorrect old password");
                exit();
            }
        } else {
            header("Location: account.php?error=User not found");
            exit();
        }
    }
    // Handle change address request
    if(isset($_POST['address_change'])) {
        // Get user ID from session
        $user_id = $_SESSION['user_id'];
    
        // Extract new address information from POST data
        $house_unit = $_POST['house_unit'];
        $baranggay = $_POST['baranggay'];
        $municipality = $_POST['municipality'];
        $province = $_POST['province'];
    
        // Validate address information (optional, add checks for empty fields etc.)
    
        // Construct new address string
        $new_address = "$house_unit, $baranggay, $municipality, $province";
    
        // Prepare update query
        $stmt = $conn->prepare("UPDATE user SET address = ? WHERE user_id = ?");
        $stmt->bind_param("ss", $new_address, $user_id);
    
        // Execute update query
        if ($stmt->execute()) {
        // Update session variable with new address
        $_SESSION['address'] = $new_address;
    
        // Insert record into user_logs for address change
        $action = 'change address';
        $stmt1 = $conn->prepare("INSERT INTO user_logs (user_id, action) VALUES (?, ?)");
        $stmt1->bind_param("ss", $user_id, $action);
        $stmt1->execute();
     }}

     // Handle preference change request
     if(isset($_POST['preferences_change'])) {
        $user_id = $_SESSION['user_id'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $bust_size = $_POST['bust_size'];
        $hip_size = $_POST['hip_size'];
        $shoe_size = $_POST['shoe_size'];
        $clothing_size = $_POST['clothing_size'];

        // Check if user preference already exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM user_preference WHERE user_id = ?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($count);
        $stmt->fetch();

        if ($count > 0) {
            // Update existing user preference
            $stmt = $conn->prepare("UPDATE user_preference SET height = ?, weight = ?, bust_size = ?, hip_size = ?, shoe_size = ?, clothing_size = ? WHERE user_id = ?");
            $stmt->bind_param("ddsssss", $height, $weight, $bust_size, $hip_size, $shoe_size, $clothing_size, $user_id);
        } else {
            // Insert new user preference
            $stmt = $conn->prepare("INSERT INTO user_preference (user_id, height, weight, bust_size, hip_size, shoe_size, clothing_size) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sddssss", $user_id, $height, $weight, $bust_size, $hip_size, $shoe_size, $clothing_size);
        }
        $stmt->execute();
    }
    // Fetch security questions from the database
        $stmt = $conn->prepare("SELECT question_id, question FROM security_questions");
        $stmt->execute();
        $result = $stmt->get_result();

        // Array to store security questions
        $securityQuestions = array();

        // Fetch questions and store them in the array
        while ($row = $result->fetch_assoc()) {
            $securityQuestions[$row['question_id']] = $row['question'];
        }
            
    // Handle security change request
    if(isset($_POST['security_change'])) {
        $user_id = $_SESSION['user_id'];

        // Check if the user already has security questions set
        $stmt = $conn->prepare("SELECT COUNT(*) FROM user_security_questions WHERE user_id = ?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($count);
        $stmt->fetch();

        if ($count > 0) {
            // Delete the old security questions data
            $delete_stmt = $conn->prepare("DELETE FROM user_security_questions WHERE user_id = ?");
            $delete_stmt->bind_param("s", $user_id);
            $delete_stmt->execute();
        }

        // Insert new security questions data
        $question1 = $_POST['security_questions1'];
        $answer1 = $_POST['answer1'];
        $question2 = $_POST['security_questions2'];
        $answer2 = $_POST['answer2'];
        $question3 = $_POST['security_questions3'];
        $answer3 = $_POST['answer3'];

        $insert_stmt = $conn->prepare("INSERT INTO user_security_questions (user_id, question_id, answer) VALUES (?, ?, ?)");

        // Bind parameters and execute for each question
        $insert_stmt->bind_param("sss", $user_id, $question1, $answer1);
        $insert_stmt->execute();
        $insert_stmt->bind_param("sss", $user_id, $question2, $answer2);
        $insert_stmt->execute();
        $insert_stmt->bind_param("sss", $user_id, $question3, $answer3);
        $insert_stmt->execute();

        // Redirect to account page with success message
        header("Location: account.php?success=Security questions updated successfully");
        exit();
    }
?>

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
    <?php 
        if (isset($_SESSION['logged_in'])) {
            include 'auth_nav_bar.php';
        } else {
            include 'nav_bar.php';
        }
    ?>

    <div class="container-fluid gradient_pink m-0 p-0 pt-1">
        <div class="container px-5 py-3">
            <!-- back button -->
            <div class="back_link p-0 mt-2">
                <a class="border-0 ps-2 pb-0 rounded-1 justify-content-start text-decoration-none w-25 mb-4" id="go_back" href="javascript:void(0)"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>
            
            <div class="row py-2 px-1 m-0 justify-content-between">
                <!-- alert modal(s) -->
                <div class="px-2 mt-1 mb-0 alert_btn">
                    <div class="w-100 m-0 alert alert-success alert-dismissible fade show" role="alert">
                        Address succesfully updated!
                        <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <div class="px-2 mt-1 mb-0 alert_btn">
                    <div class="w-100 m-0 alert alert-danger alert-dismissible fade show" role="alert">
                        Invalid input! Try again.
                        <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <div class="px-2 mt-1 mb-0 alert_btn">
                    <div class="w-100 m-0 alert alert-warning alert-dismissible fade show" role="alert">
                        Please fill out all fields.
                        <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>

                <!-- user profile, address, subscription, transactions -->
                <div class="col-sm-8 py-3 px-2 m-0">
                    <div class="row mb-2 mx-0 p-3 d-flex align-items-stretch justify-content-between card rounded-2 border-0 hstack">
                        <!-- user profile -->
                        <div class="col-sm-6 p-3 user_info m-0">
                            <h6 class="border-bottom pb-2 bold_header">My Profile</h6>
                            <div class="m-0 py-2">
                                <h4 class="pink_highlight2 bold_header mb-1 p-0"><?php if (isset($_SESSION['username'])) { echo $_SESSION['username']; } ?></h4>
                                <p class="bold_header"><?php if (isset($_SESSION['email'])) { echo $_SESSION['email']; } ?></p>
                                <div class="mt-2 mb-0 p-0 hstack">
                                    <!-- change pass -->
                                    <div class="pink_btn2 mb-0 mt-3 me-2">
                                        <button class="btn btn-dark border-0 rounded-1" data-bs-toggle="modal" data-bs-target="#change_pass">Change Password</button>
                                    </div>
                                    <!-- edit security questions -->
                                    <div class="gray_btn mb-0 mt-3">
                                        <button class="btn btn-dark border-0 rounded-1" data-bs-toggle="modal" data-bs-target="#sec_question">Set Security Question</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- delivery address -->
                        <div class="col-sm-6 p-3 user_info m-0">
                            <h6 class="border-bottom pb-2 bold_header">Delivery Address</h6>
                            <div class="m-0 py-2">
                                <p class="pink_highlight2 bold_header mb-1 p-0"><?php if (isset($_SESSION['first_name']) && ($_SESSION['last_name'])) {echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; } ?></p>
                                <p class="m-0 p-0"><?php if (isset($_SESSION['phone_number'])) { echo $_SESSION['phone_number']; } ?></p>
                                <p class="m-0 p-0"><?php if (isset($_SESSION['address'])) { echo $_SESSION['address']; } ?></p>
                                <div class="mt-2 p-0">
                                    <!-- edit address -->
                                    <div class="pink_btn2 mt-3 mb-0 me-2">
                                        <button class="btn btn-dark border-0 rounded-1" data-bs-toggle="modal" data-bs-target="#address">Edit Address</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2 mt-3 mx-0 p-3 d-flex align-items-stretch justify-content-between card rounded-2 border-0 hstack">
                        <!-- recent transactions -->
                        <div class="col-sm-12 p-3 user_info m-0">
                            <div class="pink_btn2 row mt-2 p-2 view_more_link">
                                    <h6 class="col bold_header mb-0 p-0 mx-0">Recent Transactions</span></h6>
                                    <a class="col-sm-3 border-0 p-0 rounded-1 justify-content-end text-decoration-none text-end d-none d-sm-block" href="#">View more<i class="bi bi-chevron-right"></i></a>
                            </div>
                                
                            <table class="table">
                                <thead class="text-center">
                                    <tr class="thead_style">
                                        <th scope="col">Order #</th>
                                        <th scope="col">Placed on</th>
                                        <th scope="col-1">Product</th>
                                        <th scope="col-1">ETA</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Payment Method</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($_SESSION['form_data']) && !empty($_SESSION['form_data'])) {
                                    $form_data = $_SESSION['form_data'];
                                } else {
                                    $form_data = array(); // Default value if there's no form data
                                }
                                ?>
                                <?php include ('server/get_recent_transactions.php') ?>
                                
                                <?php 
                                if ($recent_transactions->num_rows > 0) {
                                    while ($row = $recent_transactions->fetch_assoc()) { ?>
                                        <tr class="product_info align-middle">
                                            <!-- product ordered -->
                                            <td scope="row" class="text-center bold_header"><span><?php echo $row['order_number']; ?></span></td>
                                            <td class="text-center"><?php echo $row['timestamp']; ?></td>
                                            
                                            <?php 
                                            if (isset($form_data['checkout_type']) && isset($form_data['product_type']) && isset($form_data['product_id'])) {
                                                if ( ($form_data['checkout_type'] == 'quick' && $form_data['product_type'] == 'style box') && $row['style_box_id'] == $form_data['product_id'] ) { ?>
                                                    <td class="item_img d-flex justify-content-center">
                                                        <img src="resources/<?php echo $form_data['product_img_url'] ?>" class="card m-0" alt="item">
                                                    </td>
                                                <?php }
                                                else if ( ($form_data['checkout_type'] == 'quick' && $form_data['product_type'] == 'item') && $row['item_id'] == $form_data['product_id'] ) { ?>
                                                    <td class="item_img d-flex justify-content-center">
                                                        <img src="resources/<?php echo $form_data['product_img_url'] ?>" class="card m-0" alt="item">
                                                    </td>
                                                <?php }
                                            } else { ?>
                                                <td class="item_img d-flex justify-content-center">
                                                    <img src="resources/coquette.jpg" class="card m-0" alt="item">
                                                </td>
                                            <?php } ?>
                                            
                                            <td class="text-center"><span class=""><?php echo date('Y-m-d', strtotime($row['delivery_date'])); ?></span></td>
                                            <td class="text-center bold_header"><span class="pink_highlight2"><?php echo $row['total_price']; ?></span></td>
                                            <td class="text-center "><span class=""><?php echo $row['payment_method']; ?></span></td>
                                        </tr>
                                    <?php } 
                                } else { ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No transactions available</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- right panel -->
                <div class="col-sm-4 py-3 px-2 m-0">
                    <div class="row mb-2 mx-0 p-3 d-flex align-items-stretch justify-content-between card rounded-2 border-0 hstack">
                        <!-- measurements -->
                        <div class="col-12 p-3 measurement_info m-0">
                            <h6 class="border-bottom pb-2 bold_header">My Measurements</h6>
                            <div class="m-0 py-2">
                                <div class="col d-flex justify-content-between">
                                    <p>Height</p>
                                    <p class="bold_header">123</p>
                                </div>
                                <div class="col d-flex justify-content-between">
                                    <p>Weight</p>
                                    <p class="bold_header">123</p>
                                </div>
                                <div class="col d-flex justify-content-between">
                                    <p>Bust Size</p>
                                    <p class="bold_header">123</p>
                                </div>
                                <div class="col d-flex justify-content-between">
                                    <p>Hip Size</p>
                                    <p class="bold_header">123</p>
                                </div>
                                <div class="col d-flex justify-content-between">
                                    <p>Shoe Size (EU)</p>
                                    <p class="bold_header">123</p>
                                </div>
                                <div class="col d-flex justify-content-between">
                                    <p>Clothing Size</p>
                                    <p class="bold_header">123</p>
                                </div>
                                
                                <!-- edit button -->
                                <div class="mt-2 p-0">
                                    <!-- <div class="pink_btn2 mt-2 me-2">
                                        <button class="btn btn-dark border-0 rounded-1">Edit Profile</button>
                                    </div> -->
                                    <div class="gray_btn mb-0 mt-3">
                                        <button class="btn btn-dark border-0 rounded-1 w-100" data-bs-toggle="modal" data-bs-target="#measurements">Update Measurements</button>
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

        <!-- MODALS -->

        <!-- change password -->
        <div class="modal fade" id="change_pass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="change_pass_lbl" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal_btn">
                        <h3 class="modal-title fs-5 bold_header" id="change_pass_lbl">Change Password</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form_style p-3 m-0">
                            <!-- alert success -->
                            <div class="px-0 mb-3 alert_btn d-none">
                                <div class="w-100 m-0 alert alert-success alert-dismissible fade show" role="alert">
                                    Password updated successfully!
                                    <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            <!-- form -->
                            <div class="mb-3">
                                <label for="input_uname" class="form-label ms-1">Old Password</label>
                                <input type="text" class="form-control" id="old_pass" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="input_pass" class="form-label ms-1">New Password</label>
                                <input type="password" class="form-control" id="new_pass" placeholder="Enter your new password">
                            </div>
                            <div class="mb-3">
                                <label for="input_pass" class="form-label ms-1">Confirm New Password</label>
                                <input type="password" class="form-control" id="new_pass" placeholder="Re-enter your new password">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="gray_btn">
                            <button type="button" class="btn btn-secondary rounded-1 border-0" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="pink_btn2">
                            <button type="button" class="btn btn-dark rounded-1 border-0">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- security questions -->
        <div class="modal fade" id="sec_question" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sec_question_lbl" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal_btn">
                        <h3 class="modal-title fs-5 bold_header" id="sec_question_lbl">Set your Security Question</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form_style p-3 m-0">
                            <!-- alert success -->
                            <div class="px-0 mb-3 alert_btn d-none">
                                <div class="w-100 m-0 alert alert-success alert-dismissible fade show" role="alert">
                                    Security Question updated successfully!
                                    <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            <!-- form -->
                            <div class="mb-3">
                                <label for="old_pass" class="form-label ms-1">Password</label>
                                <input type="text" class="form-control" id="old_pass" placeholder="Enter your password">
                            </div>
                            <div class="pink_btn2 center_align">
                                <button type="button" class="btn btn-dark rounded-1 border-0">Verify</button>
                            </div>
                            <div class="mb-3">
                                <label for="sec_ques" class="form-label ms-1">Security Question</label>
                                <input type="text" class="form-control" id="sec_ques" placeholder="Enter your security question">
                            </div>
                            <div class="mb-3">
                                <label for="input_ans" class="form-label ms-1">Answer</label>
                                <input type="text" class="form-control" id="input_ans" placeholder="Enter your answer">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="gray_btn">
                            <button type="button" class="btn btn-secondary rounded-1 border-0" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="pink_btn2">
                            <button type="button" class="btn btn-dark rounded-1 border-0">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- edit address -->
        <div class="modal fade" id="address" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="address_lbl" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal_btn">
                        <h3 class="modal-title fs-5 bold_header" id="address_lbl">Edit Delivery Address</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form_style p-3 m-0">
                            <!-- alert success -->
                            <div class="px-0 mb-3 alert_btn d-none">
                                <div class="w-100 m-0 alert alert-success alert-dismissible fade show" role="alert">
                                    Delivery Address updated successfully!
                                    <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            <!-- form -->
                            <div class="mb-3">
                                <label for="input_add1" class="form-label ms-1">House Unit/Floor No./Building Name/Block or Lot</label>
                                <input type="text" class="form-control" id="input_add1" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="input_brgy" class="form-label ms-1">Barangay</label>
                                <input type="text" class="form-control" id="input_brgy" placeholder="">
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="input_city" class="form-label ms-1">City/Municipality</label>
                                    <input type="text" class="form-control" id="input_city" placeholder="">
                                </div>
                                <div class="col-sm-6">
                                    <label for="input_prov" class="form-label ms-1">Province</label>
                                    <input type="text" class="form-control" id="input_prov" placeholder="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="gray_btn">
                            <button type="button" class="btn btn-secondary rounded-1 border-0" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="pink_btn2">
                            <button type="button" class="btn btn-dark rounded-1 border-0">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- edit measurements -->
        <div class="modal fade" id="measurements" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="measurements_lbl" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal_btn">
                        <h3 class="modal-title fs-5 bold_header" id="measurements_lbl">Update Measurements</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form_style p-3 m-0">
                            <!-- alert success -->
                            <div class="px-0 mb-3 alert_btn d-none">
                                <div class="w-100 m-0 alert alert-success alert-dismissible fade show" role="alert">
                                    Measurements updated successfully!
                                    <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            <!-- form -->
                            <!-- height and weight -->
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="input_height" class="form-label ms-1">Height (cm)</label>
                                    <input type="text" class="form-control" id="input_height" placeholder="">
                                </div>
                                <div class="col-sm-6">
                                    <label for="input_weight" class="form-label ms-1">Weight (kg)</label>
                                    <input type="text" class="form-control" id="input_weight" placeholder="">
                                </div>
                            </div>
                            <!-- bust and hip size -->
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="input_bust" class="form-label ms-1">Bust Size (cm)</label>
                                    <input type="text" class="form-control" id="input_bust" placeholder="">
                                </div>
                                <div class="col-sm-6">
                                    <label for="input_hip" class="form-label ms-1">Hip Size (kg)</label>
                                    <input type="text" class="form-control" id="input_hip" placeholder="">
                                </div>
                            </div>
                            <!-- shoe and clothing size -->
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="input_shoe" class="form-label ms-1">Shoe Size (EU)</label>
                                    <input type="text" class="form-control" id="input_shoe" placeholder="">
                                </div>
                                <div class="col-sm-6 form_option">
                                    <label for="input_clothing" class="form-label ms-1">Clothing Size (kg)</label>
                                    <select id="input_clothing" class="form-select" aria-label="Default select example">
                                        <option selected>Select your size</option>
                                        <option value="1">Small</option>
                                        <option value="2">Medium</option>
                                        <option value="3">Large</option>
                                        <option value="4">Extra Large</option>
                                        <option value="5">XXL</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="gray_btn">
                            <button type="button" class="btn btn-secondary rounded-1 border-0" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="pink_btn2">
                            <button type="button" class="btn btn-dark rounded-1 border-0">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- footer -->
        <?php include 'contact_us.php'?>
    </div>
</body>
</html>