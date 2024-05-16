<?php
    // include connection and start session
    include ('server/connection.php');
    session_start();

    // redirect if not logged in
    if (!isset($_SESSION['logged_in'])) {
        header("Location: log_in.php");
        exit();
    }

    // retrieve subscription details
    $sub_tier = $_SESSION['selected_tier'];
    $sub_tier_desc = $_SESSION['plan_tier_description'];
    $sub_duration = $_POST['plan_duration'];
    $sub_price = $_POST['total_price'];
    $user_id = $_SESSION['user_id'];

    // store the subscription details in the session
    $_SESSION['sub_price'] = $sub_price;
    $_SESSION['sub_tier'] = $sub_tier;
    $_SESSION['sub_duration'] = $sub_duration;
    
     // check if form submitted
    if (isset($_POST['subscribe'])) {

        // get the payment method
        $payment_method = $_POST['payment_method'];

        // $stmt = $conn -> prepare("SELECT plan_id FROM subscription_plan WHERE plan_tier = ? AND plan_duration = ?");
        // $stmt -> bind_param("ss", $_SESSION['sub_tier'], $_SESSION['sub_duration']);
        // $stmt -> execute();
        // $result = $stmt -> get_result();
        // $row = $result -> fetch_assoc();
        $plan_id = $_POST['plan_id'];

        $_SESSION['plan_id'] = $plan_id;

        echo '<script>console.log("'. $plan_id .'")</script>';

        // insert the subscription details to the database
        $stmt = $conn -> prepare ("INSERT INTO subscription (user_id, plan_id) VALUES (?, ?)");
        // bind the parameters
        $stmt -> bind_param("ss", $_SESSION['user_id'], $_SESSION['plan_id']);
        // insert the order items to the order_items table
        if ($stmt -> execute()) {
            echo '<script>alert("Subscription successful")</script>';
            header("Location: account.php?subscribe=success");
            exit();
        } else {
            echo '<script>console.log("Failed to add transaction")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/checkout.css">
</head>
<body class="gray_bg2">
    <!-- navigation bar -->
    <?php include ('checkout_nav_bar.php')?>

    <div class="container-fluid gradient_pink px-3 pt-1">
        <div class="container px-5 py-3 mt-0">
            <!-- back button -->
            <div class="back_link ps-5 py-2 m-0">
                <a class="border-0 rounded-1 justify-content-start text-decoration-none w-25" id="go_back" href="javascript:void(0)"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>
            <div class="row m-2 p-0 d-flex justify-content-center">
                <!-- checkout -->
                <div class="col-sm-8 gray_bg rounded-2 px-4 py-2 m-2">
                    <h3 class="bold_header mb-3 pb-3 border-bottom mt-3">Checkout</h3>
                    
                    <?php include ('server/get_sub_plan_details.php') ?>

                    
                    
                    <table class="table">
                        <thead>
                            <tr class="thead_style">
                                <th scope="col-1">Image</th>
                                <th scope="col-7">Subscription Tier</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Subscription Details</th>
                                <th scope="col">Monthly Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="product_info align-middle">
                                <!-- product ordered -->
                                <th scope="row" class="item_img d-flex justify-content-center">
                                    <img src="resources/theme_logo.png" class="card m-0" alt="item">
                                </th>
                                <td><?php echo $row['plan_tier']; ?></td>
                                <td class="text-center"><?php echo $row['plan_duration']; ?></td>
                                <td class="text-center"><?php echo $row['plan_tier_description']; ?></td>
                                <td class="text-center bold_header"><span class="pink_highlight2 "><?php echo $row['monthly_price']; ?></span></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- proceed checkout -->
                <div class="col-sm-3 gray_bg rounded-2 px-4 py-3 m-2">
                    <!-- delivery details -->
                    <div class="row mt-3 mb-2 pb-2 border-bottom">
                        <h6 class="border-bottom pb-2 bold_header">Order Information</h6>
                        <div class="delivery_info p-3 card my-2">
                            <h6>DELIVERY ADDRESS</h6>
                            <div class="">
                                <p class="bold_header mb-1 p-0"><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?></p>
                                <p class="m-0 p-0"><?php echo $_SESSION['phone_number']?></p>
                                <p class="m-0 p-0"><?php echo $_SESSION['address']?></p>
                            </div>
                        </div>
                        <div class="gray_btn mt-2">
                            <a href="account.php"><button class="btn btn-dark border-0 rounded-1 w-100">Change Delivery Address</button></a>
                        </div>
                    </div>
                    <!-- cart info -->
                    <div class="row mt-3 p-0 mb-0 cart_info">
                        <div class="col-6">
                            <p>Order Date</p>
                        </div>
                        <div class="col-6 text-end">
                            <p><?php echo date('Y-m-d H:i:s'); ?></p>
                        </div>
                    </div>
                    <div class="row p-0 mb-2 cart_info border-bottom">
                        <div class="col-6">
                            <p class="bold_header">TOTAL</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="pink_highlight bold_header"><?php echo 'PHP ' . $_SESSION['sub_price']?></p>
                        </div>
                    </div>
                    <div class="row pt-2 m-0">
                        <div class="payment_details filter_content px-0">
                        <form method = "POST" action = "subscription_checkout.php">
                            <h6 class="bold_header">Select your Payment Method</h6>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="payment_method" type="radio" value="Cash on Delivery" id="Cash">
                                <label class="form-check-label ms-1" for="small">Cash on Delivery</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="payment_method" type="radio" value="GCash" id="GCash">
                                <label class="form-check-label ms-1" for="small">GCash</label>
                            </div>
                        </div>
                    </div>
                    <div class="pink_btn2 mt-3 pb-2">
                        <input hidden name="plan_id" value="<?php echo $row['plan_id'] ?>">
                        <button class="btn btn-dark border-0 rounded-1 w-100" type="submit" name="subscribe">CONFIRM ORDER</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>