<?php
    // include the connection.php file
    include ('server/connection.php');

    // start the session
    session_start();

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
    <?php 
        if (isset($_SESSION['logged_in'])) {
            include 'auth_nav_bar.php';
        } else {
            include 'nav_bar.php';
        }
    ?>

    <div class="container-fluid gradient_pink px-3 pt-1">
        <div class="container px-5 py-3 mt-0">
            <!-- back button -->
            <div class="back_link ps-5 py-2 m-0">
                <a class="border-0 rounded-1 justify-content-start text-decoration-none w-25" id="go_back" href="javascript:void(0)"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>
            <div class="row m-2 p-0 d-flex justify-content-center">
                <!-- checkout -->
                <div class="col-sm-8 gray_bg rounded-2 px-4 py-2 m-2">
                    <h3 class="bold_header mb-3 pb-3 border-bottom mt-3">Order Details</h3>
                    <table class="table">
                        <thead>
                            <tr class="thead_style">
                                <th scope="col-1">Image</th>
                                <th scope="col-7">Product Name</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Item Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($_SESSION['cart'] as $key => $value) { ?>
                            <tr class="product_info align-middle">
                                <!-- product ordered -->
                                <th scope="row" class="item_img d-flex justify-content-center">
                                    <img src="resources/<?php echo $value['product_img_url']; ?>" class="card m-0" alt="item">
                                </th>
                                <td><?php echo $value['product']; ?></td>
                                <td class="text-center"><?php echo $value['product_price']; ?></td>
                                <td class="text-center"><?php echo $value['product_quantity']?></td>
                                <td class="text-center bold_header"><span class="pink_highlight2 "><?php echo 'PHP ' . $value['product_price'] * $value['product_quantity']; ?></span></td>
                            </tr>
                            <?php } ?>

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
                    </div>
                    <!-- cart info -->
                    <div class="row mt-3 p-0 mb-0 cart_info">
                        <div class="col-6">
                            <p>Order Date</p>
                        </div>
                        <div class="col-6 text-end">
                            <p><?php echo date('Y-m-d H:i:s'); ?></p>
                        </div>

                        <div class="col-6">
                            <p>Order ID</p>
                        </div>
                        <div class="col-6 text-end">
                            <p><?php echo 'ORD-' . date('Ymd') . '-000017'; ?></p>
                        </div>

                    </div>
                    <div class="row p-0 mb-0 cart_info">
                        <div class="col-6">
                            <p>Total items</p>
                        </div>
                        <div class="col-6 text-end">
                            <p><?php echo $_SESSION['total_items']?></p>
                        </div>
                    </div>
                    <div class="row p-0 mb-0 cart_info">
                        <div class="col-6">
                            <p class="bold_header">SHIPPING FEE</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="bold_header">100</p>
                        </div>
                    </div>
                    <div class="row p-0 mb-2 cart_info border-bottom">
                        <div class="col-6">
                            <p class="bold_header">TOTAL</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="pink_highlight bold_header"><?php echo 'PHP ' . $_SESSION['grand_total']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>