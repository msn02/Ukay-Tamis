<?php
    // include connection.php
    include ('server/connection.php');
    
    // start the session
    session_start();
    
    // if no form has been submitted, set the selected tier to the default value
    if (!isset($_POST["tier"])) {
        $_POST["tier"] = "Starter Pack";
        $_SESSION["selected_tier"] = $_POST["tier"];
    } else {
        $_SESSION["selected_tier"] = $_POST["tier"];
    }

    // include get_sub_price.php
    include ('server/get_sub_price.php');

    while ($row = $result -> fetch_assoc()) {
        $key = $_SESSION['selected_tier'] . '_' . $row['plan_duration'];
        $sub_price[$key] = array(
            'plan_tier' => $row["plan_tier"], // use the plan_tier from the current row
            'plan_duration' => $row['plan_duration'],
            'price' => $row['price'],
            'monthly_price' => $row['monthly_price']
        );

        // if the plan_tier of the current row matches the selected tier, add the details to the selected_tier_details array
        if ($row["plan_tier"] == $_SESSION['selected_tier']) {
            $selected_tier_details[] = $sub_price[$key];
        }
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/subscription.css">
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

    <div class="container-fluid gradient_pink px-0 pt-1">
        <div class="container px-5 py-3 mt-0">
            <!-- back button -->
            <div class="back_link ps-5 py-2 m-0">
                <a class="border-0 rounded-1 justify-content-start text-decoration-none w-25" id="go_back" href="javascript:void(0)"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>

            <!-- subscription header -->
            <div class="row m-2 p-0 d-flex justify-content-center">
                <div class="col-sm-8 gray_bg rounded-3 p-0 m-2 text-center overflow-hidden">
                    
                <div class="header_style px-4 pt-3 pb-2 m-0 ">
                    <h5 class="bold_header">CHOOSE A TIER</h5>
                </div>
                <form method="POST" action="subscription_price.php" id="tierForm">
                
                <div class="row py-3 px-4 d-flex justify-content-evenly">
                        <!-- loop through the tiers -->
                        <?php include('server/get_sub_tier_details.php'); ?>
                        <?php foreach ($sub_tier_details as $index => $detail) { ?>
                            <!-- tier card -->
                            <div class="col-sm-4 img_style p-2">
                                <div class="card rounded-1 border-1 m-0 p-0 overflow-hidden">
                                    <div class="card-body tier_card mb-0">
                                        <div class="star_icon">
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <h6 class="card-title bold_header mt-2"> <?php echo $detail['plan_tier'] ?> </h6>
                                        <p class="card-text mb-0"> <?php echo $detail['plan_tier_description'] ?> </p>
                                    </div>
                                        <div class="card-body pink_btn2 mt-0 p-2">
                                            <input type="radio" class="btn-check" name="tier" id="tier<?php echo $index ?>" value="<?php echo $detail['plan_tier'] ?>" autocomplete="off" 
                                            <?php 
                                                if ((isset($_POST['tier']) && $_POST['tier'] == $detail['plan_tier']) || (!isset($_POST['tier']) && $detail['plan_tier'] == 'Starter Pack')) {
                                                    echo 'checked';
                                                } 
                                            ?>>
                                            <label class="btn btn-secondary w-100 m-0 p-2 rounded-1" for="tier<?php echo $index ?>">
                                                <span class="radio-btn-text">SELECT</span>
                                            </label>
                                        </div>
                                    </div>
                             </div>
                        <?php } ?>
                </div>
                </form>
                    <!-- subscription plan -->
                    <div class="header_style2 px-4 pt-3 pb-2 m-0 ">
                        <h5 class="bold_header">CHOOSE YOUR <span class="green_highlight">SUBSCRIPTION PLAN</span></h5>
                    <!-- loop through the prices -->
                    <form method = "POST" action = "subscription_price.php">
                        </div>
                            <div class="row py-3 px-4 d-flex justify-content-evenly">
                            <!-- prices -->
                            <?php foreach ($selected_tier_details as $key => $price) { ?>
                                <!-- plan card -->
                                <div class="col-sm-4 img_style p-2">
                                    <div class="card rounded-1 border-1 m-0 p-0 overflow-hidden">
                                        <div class="card-body price_card mb-0">
                                            <h2 class="pink_highlight2 bold_header"><?php echo $price['monthly_price'] ?>/<sup>mo</sup></h2>
                                            <h6 class="card-title month_title mt-2"><?php echo $price['plan_duration'] ?></h6>
                                        </div>
                                        <div class="card-body pink_btn2 mt-0 p-2">
                                            <input type="radio" class="btn-check" name="price" id="3_mon" autocomplete="off" checked>
                                            <label class="btn btn-secondary w-100 m-0 p-2 rounded-1" for="3_mon">
                                                <span class="radio-btn-text">SELECT</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </form>
                </div>

                <!-- package details container -->
                <div class="col-sm-3 gray_bg rounded-2 px-4 py-3 m-2">
                    <div class="row mt-3 border-bottom">
                        <h6 class="border-bottom pb-2 bold_header mb-3">Package Details</h6>
                        <!-- package details -->
                        <div class="row mb-3 center_align m-0 p-0">
                            <div class="card price_badge p-3 m-0 package_info">
                                <h6 class="bold_header mb-1">PREMIUM Tier</h6>
                                <p class="bold_header mb-2">6 Months</p>
                                <p class="card-text mb-0">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                    <!-- total -->
                    <div class="row p-0 mb-0 mt-3 cart_info">
                        <div class="col-6">
                            <p class="bold_header">TOTAL</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="pink_highlight bold_header">PHP 156</p>
                        </div>
                    </div>
                    <div class="pink_btn2 pb-3">
                        <a href="checkout.php"><button class="btn btn-secondary border-0 rounded-1 w-100">CHECKOUT</button></a>
                    </div>
                </div>
            </div>
        </div>
    <!-- footer -->
    <?php include 'footer.php'?>
    </div>
</body>
    <!-- include scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name="tier"]').change(function(e) {
                e.preventDefault(); // prevent the form from being submitted normally
        
                var selectedTier = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'subscription_price.php',
                    data: {tier: selectedTier},
                    async: false,
                    success: function() {
                        $('#tierForm').submit(); // submit the form using JavaScript
                    }
                });
            });
        });
    </script>
</html>