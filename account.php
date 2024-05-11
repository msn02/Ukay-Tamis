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
            if (md5($old_password) == $db_password) {
                // If old password matches, proceed with checking new password and confirm password
                if ($new_password == $confirm_new_password) {
                    // If new password and confirm password match, update password in the database
                    $hashed_password = md5($new_password);
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

  
?>

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
    <?php 
        if (isset($_SESSION['logged_in'])) {
            include 'auth_nav_bar.php';
        } else {
            include 'nav_bar.php';
        }
    ?>

    <div class="container-fluid">
        <div class="container">


        <div class="row shadow rounded-2 m-3 gray_bg">

                <!-- Details -->
                <div class="col m-0 py-4 px-3">
                    <!-- Title -->
                    <div class="row m-0 p-3 pb-0 justify-content-between g-3">
                        <div class="col-auto">
                            <h2 class="bold_header ps-0 mb-0 pb-0">Manage Account</h2>
                        </div>

                        <div class="col-auto">
                            <p class="pt-3 mb-0"><a href="account.php?logout" id="logout_btn" class="text-end">Log Out</a></p>
                        </div>
                    </div>

                    <!-- Full Name -->
                    <div class="pt-3 px-5 mt-2 mb-0">
                        <div class="m-0">
                            <h4 class="pink_highlight2 rounded-2 bold_header box_price"> <?php if (isset($_SESSION['first_name']) && ($_SESSION['last_name'])) {echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; } ?> </h4>
                        </div>
                    </div>
                    <!-- User Details -->
                    <div class="pt-3 px-5 mb-0">
                        <div class=" pt-2 pb-0 m-0">
                            <h6 class="bold_header"> Username: <?php if (isset($_SESSION['username'])) { echo $_SESSION['username']; } ?> </h6>
                            <h6 class="bold_header"> Email: <?php if (isset($_SESSION['email'])) { echo $_SESSION['email']; } ?> </h6>
                            <h6 class="bold_header"> Phone Number: <?php if (isset($_SESSION['phone_number'])) { echo $_SESSION['phone_number']; } ?> </h6>
                            <h6 class="bold_header" id="addressDisplay"> Delivery Address:  <?php if (isset($_SESSION['address'])) { echo $_SESSION['address']; } ?> </h6>
                        </div>
                    </div>
                    
                    <!-- Changes -->
                    
                    <div class="pt-3 px-2 mt-2 mb-0 row">
                        <div class="log_sign_btn mt-4 pt-3 px-5 mb-0 col">
                        <button type="button" class="btn btn-dark border-0 rounded-1 px-4 py-1" data-bs-toggle="modal" data-bs-target="#changeAddressModal">Change Address</button>    
                        <button class="btn btn-dark border-0 rounded-1 px-4 py-1" data-bs-toggle="modal" data-bs-target="#preferencesModal">Set up Preferences</button>
                        </div>
                    </div>

                   
                </div>

                <!-- CHANGE PASSWORD -->
                <form class="form_style p-4 m-0" method = "POST" action = "account.php">

                        <div class="border-top col m-0 p-3">
                            <h2 class="bold_header ps-0 mt-5 mb-3 pb-0">Change Password</h2>
                        </div>

                        <div class="ms-3 mb-3">
                            <label for="input_uname" class="form-label">Old Password</label>
                            <input type="password" class="form-control ms-1" id="input_oldPass" name = "old_password" placeholder="Enter new password" required>
                        </div>

                        <div class="ms-3 mb-3">
                            <label for="input_uname" class="form-label">New Password</label>
                            <input type="password" class="form-control ms-1" id="input_uname" name = "new_password" placeholder="Enter new password" required>
                        </div>
                        <div class="ms-3 mb-3">
                            <label for="input_pass" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control ms-1" id="input_pass" name = "confirm_new_password" placeholder="Confirm new password" required>
                        </div>
                        <!-- TO DO: Error warning (if password is incorrect/no account/no username found) -->
                        <div class="log_sign_btn mt-4 ms-3  ">
                            <input class="btn btn-dark border-0 rounded-1 px-4 py-1 ms-1" onclick="" name = "change_pass_btn" value = "Confirm" type = "submit"></input>
                            <button class="btn btn-dark border-0 rounded-1 px-4 py-1" data-bs-toggle="modal" data-bs-target="#preferencesModal">Set up Security Questions</button>
                        </div>

                        <p style="color: red"> <?php if (isset($_GET['error'])) { echo $_GET['error']; } ?> </p>
                        <p style="color: green"> <?php if (isset($_GET['success'])) { echo $_GET['success']; } ?> </p>
                </form>

                <!-- TRANSACTIONS -->
                <div class="col-sm-7 m-0 py-4 px-3">
                    <!-- tag and title -->
                    <div class="row m-0 p-3 pb-0 justify-content-between g-3">
                        <div class="col-sm-10 m-0 p-0">
                            <h2 class="bold_header align-content-center ps-0 mb-0 pb-0">TRANSACTIONS</h2>
                        </div>
                        <div class="d-sm-none d-block m-1"></div>
                    </div>
                    <!-- box price -->
                    <div class="pt-3 px-3 mb-0">
                        <div class="m-0">
                            <h4 class="pink_highlight2 rounded-2 p-3 bold_header box_price">PHP 123</h4>
                        </div>
                    </div>
                    <!-- style description -->
                    <div class="pt-3 px-3 mb-0">
                        <div class="border-top pt-3 pb-0 m-0">
                            <h6 class="bold_header">Style Description</h6>
                            <p class="box_desc m-0 p-0">HEllo</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
       <!-- Modal for changing address -->
       <div class="modal fade" id="changeAddressModal" tabindex="-1" aria-labelledby="changeAddressModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changeAddressModalLabel">Change Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for changing address -->
                        <form id="changeAddressForm" method="POST" action="account.php">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="Unit" class="form-label">House/Unit/Flr #, Bldg Name, Blk or Lot</label>
                                    <input type="text" class="form-control" id="house_unit" name="house_unit" required>

                                    <label for="Baranggay" class="form-label">Baranggay</label>
                                    <input type="text" class="form-control" id="baranggay" name="baranggay" required>
                                </div>

                                <div class="col">
                                    <label for="City" class="form-label">City/Municipality</label>
                                    <input type="text" class="form-control" id="municipality" name="municipality" required>

                                    <label for="Province" class="form-label">Province</label>
                                    <input type="text" class="form-control" id="province" name="province" required>
                                </div>
                            </div>
                            <input type="submit" name="address_change" class="btn btn-primary" value="Save changes"></input>
                        </form>

                    </div>
                </div>
            </div>
        </div>
         <!-- Preference Change Modal -->
        <div class="modal fade" id="preferencesModal" tabindex="-1" aria-labelledby="preferencesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="preferencesModalLabel">Change Preferences</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="account.php">
                            <!-- Add form fields for preferences here -->
                            <div class="mb-3">
                                <label for="height" class="form-label">Height (cm)</label>
                                <input type="number" class="form-control" id="height" name="height" step="0.01" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight (kg)</label>
                                <input type="number" class="form-control" id="weight" name="weight" step="0.01" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="bust_size" class="form-label">Bust Size (cm)</label>
                                <input type="number" class="form-control" id="bust_size" name="bust_size" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="hip_size" class="form-label">Hip Size (cm)</label>
                                <input type="number" class="form-control" id="hip_size" name="hip_size" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="shoe_size" class="form-label">Shoe Size (EU)</label>
                                <input type="number" class="form-control" id="shoe_size" name="shoe_size" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="clothing_size" class="form-label">Clothing Size</label>
                                <select class="form-control" id="clothing_size" name="clothing_size" required>
                                    <option value="">Select Size</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="preferences_change" class="btn btn-primary" value="Save changes"></input>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
        </div>

</body>
</html>
