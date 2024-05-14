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
    function verifyPassword($input_password, $db_password)
    {
        // Hash the input password
        $hashed_input_password = md5($input_password);
    
        // Compare the hashed input password with the hashed password from the database
        return $hashed_input_password === $db_password;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];
    
        // Process AJAX request based on action
        switch ($action) {
            case 'changePassword':

                // Handle change password AJAX request
                $oldPassword = $_POST['old_password'];
                $newPassword = $_POST['new_password'];
                $user_id = $_SESSION['user_id'];

                $stmt = $conn->prepare("SELECT password FROM user WHERE user_id = ?");
                $stmt->bind_param('s', $user_id);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($db_password);
                    $stmt->fetch();
                    
                    if($db_password==md5($oldPassword)){
                        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE user_id = ?");
                        $newHashedPassword=md5($newPassword);
                        $stmt->bind_param("ss", $newHashedPassword, $user_id);
                        $stmt->execute();
                        echo true;
                    } else {
                        echo false;
                    }
                }    
                break;
    
            case 'setSecurityQuestions':
                
                //Handle securityQuestion ajax request
                $questionID = $_POST['question_id'];
                $answer = $_POST['answer'];
                $user_id = $_SESSION['user_id'];

                // Check if a record exists in user_security_questions for the specified user_id
                $stmt = $conn->prepare("SELECT * FROM user_security_questions WHERE user_id = ?");
                $stmt->bind_param('s', $user_id);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    // If record exists, update the record with new questionID and answer
                    $stmt = $conn->prepare("UPDATE user_security_questions SET question_id = ?, answer = ? WHERE user_id = ?");
                    $stmt->bind_param("sss", $questionID, $answer, $user_id);
                    $stmt->execute();
                    echo true;

                } else {
                    // If no record exists, insert a new record with user_id, questionID, and answer
                    $stmt = $conn->prepare("INSERT INTO user_security_questions (user_id, question_id, answer) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $user_id, $questionID, $answer);
                    $stmt->execute();
                    echo false;
                }

                break;
    
            case 'changeAddress':
                // Handle change address AJAX request
                $address = $_POST['address'];
                $user_id = $_SESSION['user_id'];
                
                $stmt = $conn->prepare("UPDATE user SET address = ? WHERE user_id = ?");
                $stmt->bind_param("ss", $address, $user_id);
                if ($stmt->execute()) {
                    echo true;
                } else {
                    echo false;
                }
                break;
            case 'changeMeasurements':
                // Handle change measurements AJAX request
                // Variables to receive post
                $height = $_POST['height'];
                $weight = $_POST['weight'];
                $bust = $_POST['bust'];
                $hip = $_POST['hip'];
                $shoe = $_POST['shoe'];
                $clothing = $_POST['clothing'];
                $user_id = $_SESSION['user_id'];

                // Check if a record exists in user_preferences for the specified user_id
                $stmt = $conn->prepare("SELECT * FROM user_preference WHERE user_id = ?");
                $stmt->bind_param('s', $user_id);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    // If record exists, update the measurements for the user_id
                    $stmt = $conn->prepare("UPDATE user_preference SET height = ?, weight = ?, bust_size = ?, hip_size = ?, shoe_size = ?, clothing_size = ? WHERE user_id = ?");
                    $stmt->bind_param("sssssss", $height, $weight, $bust, $hip, $shoe, $clothing, $user_id);
                    $stmt->execute();
                    echo true;
                } else {
                    // If no record exists, insert a new record with user_id and measurements
                    $stmt = $conn->prepare("INSERT INTO user_preference (user_id, height, weight, bust_size, hip_size, shoe_size, clothing_size) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssssss", $user_id, $height, $weight, $bust, $hip, $shoe, $clothing);
                    $stmt->execute();
                    echo true;
                }
                // Process measurements change
                echo "Measurements changed successfully!";
                break;
            
            case 'verifyPassword':
                if ($_POST['action'] === 'verifyPassword') {
                    $password = $_POST['password'];
                    $user_id = $_SESSION['user_id'];
                
                    $stmt = $conn->prepare("SELECT password FROM user WHERE user_id = ?");
                    $stmt->bind_param('s', $user_id);
                    $stmt->execute();
                    $stmt->store_result();
                    if ($stmt->num_rows == 1) {
                        $stmt->bind_result($db_password);
                        $stmt->fetch();
                        
                        if(md5($password) === $db_password){
                            
                            echo true;
                        } else {
                          
                            echo false;
                        }
                    }
                }
                
                // Handle AJAX request for setting verified session
                if ($_POST['action'] === 'setVerifiedSession') {
                    $_SESSION['verified'] = true;
                    echo "Verified session set successfully!";
                }
                break;
    
            default:
                echo "Invalid action";
                break;
        }
    } else {
        
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

                <div id="modal-url-checks">
                <!-- alert modal(s) -->
                    <!--Success-->
                    <div class="px-2 mt-1 mb-0 alert_btn">
                        <div class="d-none w-100 m-0 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            Password succesfully updated!
                            <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>

                    <!--Fail-->
                    <div class="px-2 mt-1 mb-0 alert_btn">
                        <div class="d-none w-100 m-0 alert alert-danger alert-dismissible fade show" id="failed_modal" role="alert">
                            Invalid input! Try again.
                            <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    
                    <div class="px-2 mt-1 mb-0 alert_btn">
                        <div class="d-none w-100 m-0 alert alert-warning alert-dismissible fade show" role="alert">
                            Please fill out all fields.
                            <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    <!--Secuity Questions-->


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
                                <p class="m-0 p-0" id="add-loc"><?php if (isset($_SESSION['address'])) { echo $_SESSION['address']; } ?></p>
                                <div class="mt-2 p-0">
                                    <!-- edit address -->
                                    <div class="pink_btn2 mt-3 mb-0 me-2">
                                        <button class="btn btn-dark border-0 rounded-1" data-bs-toggle="modal" data-bs-target="#address">Edit Address</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2 mt-3 mx-0 p-3 d-flex align-items-stretch justify-content-between card  rounded-2 border-0 hstack">
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
                        <div class="col-12 p-3 measurement_info m-0">
                            <h6 class="border-bottom pb-2 bold_header">My Measurements</h6>
                            <div class="m-0 py-2">
                                <div class="col d-flex justify-content-between">
                                    <p>Height</p>
                                    <p id='h-display' class="bold_header">123</p>
                                </div>
                                <div class="col d-flex justify-content-between">
                                    <p>Weight</p>
                                    <p id='w-display' class="bold_header">123</p>
                                </div>
                                <div class="col d-flex justify-content-between">
                                    <p>Bust Size</p>
                                    <p id='b-display' class="bold_header">123</p>
                                </div>
                                <div class="col d-flex justify-content-between">
                                    <p>Hip Size</p>
                                    <p id='hip-display' class="bold_header">123</p>
                                </div>
                                <div class="col d-flex justify-content-between">
                                    <p>Shoe Size (EU)</p>
                                    <p id='s-display' class="bold_header">123</p>
                                </div>
                                <div class="col d-flex justify-content-between">
                                    <p>Clothing Size</p>
                                    <p id='c-display' class="bold_header">123</p>
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
                        <form class="form_style p-3 m-0" id="change_password_form">
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
                                <input type="password" name="old_password" class="form-control" id="old_pass" placeholder="" required>
                            </div>
                            <div class="mb-3">
                                <label for="input_pass" class="form-label ms-1">New Password</label>
                                <input type="password" name="new_password" class="form-control" id="new_pass" placeholder="Enter your new password" required>
                            </div>
                            <div class="mb-3">
                                <label for="input_pass" class="form-label ms-1">Confirm New Password</label>
                                <input type="password" name="confirm_new_password" class="form-control" id="confirm_new_password" placeholder="Re-enter your new password" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="gray_btn">
                            <button type="button" class="btn btn-secondary rounded-1 border-0" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="pink_btn2">
                        <button type="submit" class="btn btn-dark rounded-1 border-0" data-bs-dismiss="modal">Change Password</button>
                        </div>
                    </div>
                    </form>
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
                        <form class="form_style p-3 m-0" id="#set_security_questions_form" method="POST">
                            <!-- alert success -->
                            <div class="px-0 mb-3 alert_btn d-none">
                                <div class="w-100 m-0 alert alert-success alert-dismissible fade show" role="alert">
                                    Security Question updated successfully!
                                    <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            
                            <div class="px-2 mt-1 mb-0 alert_btn">
                                <div class="d-none w-100 m-0 alert alert-danger alert-dismissible fade show" id="try_again" role="alert">
                                    Error! Try again.
                                    <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>

                            <!-- form -->
                            <div class="px-2 mt-1 mb-0 alert_btn">
                                <div class="d-none w-100 m-0 alert alert-success alert-dismissible fade show" id="verify_success_modal" role="alert">
                                    Password Verified!
                                    <button type="button" class="btn-close m-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="old_pass" class="form-label ms-1">Password</label>
                                <input type="text" class="form-control" id="old_pass1" placeholder="Enter your password">
                            </div>
                            <div class="pink_btn2 center_align">
                                <button id="verify_btn" type="submit" class="btn btn-dark rounded-1 border-0">Verify</button>
                            </div>
                            <div class="mb-3">
                                <label for="sec_ques" class="form-label ms-1">Security Question</label>
                                <select id="sec_ques" class="form-control" required disabled>
                                    <option value="" selected disabled>Select a security question</option>
                                    <?php
                                    $sql = "SELECT * FROM security_questions";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['question_id'] . '">' . $row['question'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="input_ans" class="form-label ms-1">Answer</label>
                                <input type="text" class="form-control" id="input_ans" placeholder="Enter your answer" disabled>
                            </div>

                            <div class="modal-footer">
                            <div class="gray_btn">
                                <button type="button" class="btn btn-secondary rounded-1 border-0" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="pink_btn2">
                                <button type="button" class="btn btn-dark rounded-1 border-0" id="save_question" data-bs-dismiss="modal">Save Changes</button>
                            </div>
                        </div>
                        </form>
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
                        <form class="form_style p-3 m-0" id="#change_address_form">
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

                            <div class="modal-footer">
                                <div class="gray_btn">
                                    <button type="button" class="btn btn-secondary rounded-1 border-0" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="pink_btn2">
                                    <button type="button" class="btn btn-dark rounded-1 border-0" id="save_address"  data-bs-dismiss="modal">Save Changes</button>
                                </div>
                            </div>
                        </form>
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
                        <form class="form_style p-3 m-0" id="#change_measurements_form">
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

                            <div class="modal-footer">
                                <div class="gray_btn">
                                    <button type="button" class="btn btn-secondary rounded-1 border-0" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="pink_btn2">
                                    <button type="button" id='save-measurements' class="btn btn-dark rounded-1 border-0" data-bs-dismiss="modal">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- footer -->
        <?php include 'contact_us.php'?>
    </div>
    <script>
        $(document).ready(function(){
            // Change Password Form
            $('#change_password_form').submit(function(e){
                e.preventDefault();

                var newPassword = $('#new_pass').val();
                var confirmNewPassword = $('#confirm_new_password').val();
                var oldPassword = $('#old_pass').val();

                if (newPassword !==confirmNewPassword){
                    alert("New Passwords Dont Match!")
                }
                else if (newPassword === oldPassword) {
                    alert("New Password cannot be the same as the Old Password!");
                }else {
                    $.ajax({
                        type: 'POST',
                        url: 'account.php',
                        data: {
                            action: 'changePassword', 
                            old_password: oldPassword,
                            new_password: newPassword
                        },
                        success: function(response) {
                        
                        if (response.charAt(0) == true) {
                            $('#failed_modal').addClass('d-none');
                            $('#alert-success').removeClass('d-none').text('Password Successfully Updated');
                        } else {
                            $('#failed_modal').removeClass('d-none');
                            $('#alert-success').addClass('d-none');
                        }
                        },
                        error: function(xhr, status, error) {
                            console.log("error");
                            
                        }
                    });
                }
            });
            // Set Security Questions Form
            $('#save_question').click(function(e){
                e.preventDefault();

                var action = 'setSecurityQuestions';
                var question_id = $('#sec_ques').val();
                var answer = $('#input_ans').val();

                $.ajax({
                    type: 'POST',
                    url: 'account.php',
                    data: {
                        action: action, 
                        question_id: question_id,
                        answer: answer
                    },
                    success: function(response) {
                        if(response.charAt(0) == true){
                            $('#alert-success').text('Security Questions Set!').removeClass('d-none');
                            $('#failed_modal').addClass('d-none');
                            $('#sec_ques').val('');
                            $('#input_ans').val('');
                        }
                        else{
                            $('#failed_modal').removeClass('d-none');
                            $('#securityQ_set').addClass('d-none');
                        }
                    }
                });
            });

            $('#save_address').click(function(e){
                var houseUnit = $('#input_add1').val();
                var barangay = $('#input_brgy').val();
                var city = $('#input_city').val();
                var province = $('#input_prov').val();
                
                var address = houseUnit + ', ' + barangay + ', ' + city + ', ' + province;
            // Generate AJAX request to send address data to account.php for further processing
            $.ajax({
                type: 'POST',
                url: 'account.php',
                data: {
                    action: 'changeAddress',
                    address: address
                },
                success: function(response) {
                    // Handle the response from the server
                    console.log(response);
                    if(response.charAt(0)==true){
                        $('#failed_modal').addClass('d-none');
                        $('#alert-success').removeClass('d-none').text('Address Changed Successfully');
                        $('#add-loc').text(address);
                        //clear fields
                        $('#input_add1').val('');
                        $('#input_brgy').val('');
                        $('#input_city').val('');
                        $('#input_prov').val('');
                    }
                    else{
                        console.log("no");
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error sending address data');
                }
            });
        });

            // Change Measurements Form
            $('#save-measurements').click(function(e){
                e.preventDefault();

                var height = $('#input_height').val();
                var weight = $('#input_weight').val();
                var bust   = $('#input_bust').val();
                var hip    = $('#input_hip').val();
                var shoe   = $('#input_shoe').val();
                var clothing = $('#input_clothing').val();
                var selectedClothingSize = $('#input_clothing option:selected').text();

            $.ajax({
                type: 'POST',
                url: 'account.php',
                data: {
                    action: 'changeMeasurements', 
                    height: height,
                    weight: weight,
                    bust: bust,
                    hip: hip,
                    shoe: shoe,
                    clothing: clothing
                },
                success: function(response) {
                    if(response.charAt(0)==true){
                        console.log(response);
                        $('#alert-success').removeClass('d-none').text('Measurements Updated Successfully');
                        $('#h-display').text(height);
                        $('#w-display').text(weight);
                        $('#b-display').text(bust);
                        $('#hip-display').text(hip);
                        $('#s-display').text(shoe);
                        $('#c-display').text(selectedClothingSize);
                    }else{
                        console.log(response);
                    }
                   
                },
                error: function(xhr, status, error) {
                    console.log('Error changing measurements');
                }
            });

            });

    
        // Verify Button Click Event
            $('#verify_btn').click(function(e){
                    e.preventDefault();

                    var password = $('#old_pass1').val();

                    $.ajax({
                        type: 'POST',
                        url: 'account.php',
                        data: {
                            action: 'verifyPassword', 
                            password: password
                        },
                        success: function(response) {
                            
                            if (response.charAt(0) == true) {
                                //modal edit
                                $('#verify_btn').prop('disabled', true);
                                $('#verify_success_modal').removeClass('d-none');
                                $('#try_again').addClass('d-none');
                                //enable  fields
                                $('#sec_ques').prop('disabled', false);
                                $('#input_ans').prop('disabled', false);
                            } else {
                                $('#try_again').removeClass('d-none');
                            }
                        }
                    });
                });
            });
        
    </script>
</body>
</html>