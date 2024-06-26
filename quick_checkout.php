
<?php
    // include connection and start session
    include ('server/connection.php');
    session_start();

    // redirect if not logged in
    if (!isset($_SESSION['logged_in'])) {
        header("Location: log_in.php");
        exit();
    }
    // Set the grand total
    $_SESSION['grand_total'] = $_POST['product_price'] + 100;

     // check if form submitted
    if (isset($_POST['quick_order'])) {
        // Retrieve product details
        $product_id = $_POST['product_id'];
        $product = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_type = $_POST['product_type'];
        $product_quantity = $_POST['product_quantity'];
 
        // if payment method is not selected
        if (empty($_POST['payment_method'] && !isset($_POST['payment_method']))) {
            echo '<script>alert("Please select a payment method")</script>';
        }
        // get the payment method
        $payment_method = $_POST['payment_method'];
        // insert the transaction details to the database
        $stmt = $conn -> prepare ("INSERT INTO transaction (user_id, total_items, total_price, payment_method) VALUES (?, ?, ?, ?)");
        // bind the parameters
        $stmt -> bind_param("ssss", $_SESSION['user_id'], $product_quantity, $_POST['grand_total'], $payment_method);
        // insert the order items to the order_items table
        if ($stmt -> execute()) {
            // get the transaction id
            $transaction_id = $conn -> insert_id;
            // if the product is an item
            if ($product_type == 'item') {
                // update the item table
                $stmt = $conn -> prepare ("UPDATE item SET transaction_id = ? WHERE item_id = ? AND item_name = ?");
                $stmt -> bind_param("sss", $transaction_id, $product_id, $product);
                // insert the order item to the order_product table
                $stmt1 = $conn->prepare("INSERT INTO order_product (transaction_id, item_id, item_name, item_price) VALUES (?, ?, ?, ?)");
                $stmt1->bind_param("ssss", $transaction_id, $product_id, $product, $product_price);
            // if the product is a style box
            } else if ($product_type == 'style box') {
                // add the style box to the style_box_transaction table
                $stmt = $conn -> prepare ("INSERT INTO style_box_transaction (transaction_id, style_box_id, style_box_quantity) VALUES (?, ?, ?)");
                $stmt -> bind_param("sss", $transaction_id, $product_id, $product_quantity);
                // insert the order item to the order_product table
                $stmt1 = $conn -> prepare ("INSERT INTO order_product (transaction_id, style_box_id, style_box_name, style_box_price, style_box_quantity) VALUES (?, ?, ?, ?, ?)");
                $stmt1 -> bind_param("sssss", $transaction_id, $product_id, $product, $product_price, $product_quantity);
            }
            // execute the queries
            if ($stmt -> execute() && $stmt1 -> execute()) {
                echo '<script>console.log("Order item added successfully")</script>';
            } else {
                echo '<script>console.log("Failed to add order item")</script>';
            }
        } else {
            echo '<script>console.log("Failed to add transaction")</script>';
        }

        // store data from the form
        $_SESSION['form_data'] = $_POST;

        // redirect to the checkout success page
        echo '<script>alert("Order successful")</script>';
        header("Location: account.php?order=success");
        exit();
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
                            <tr class="product_info align-middle">
                                <!-- product ordered -->
                                <th scope="row" class="item_img d-flex justify-content-center">
                                    <img src="resources/<?php echo $_POST['product_img_url']; ?>" class="card m-0" alt="item">
                                </th>
                                <td><?php echo $_POST['product']; ?></td>
                                <td class="text-center"><?php echo $_POST['product_price']; ?></td>
                                <td class="text-center"><?php echo $_POST['product_quantity']?></td>
                                <td class="text-center bold_header"><span class="pink_highlight2 "><?php echo 'PHP ' . $_POST['product_price'] * $_POST['product_quantity']; ?></span></td>
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
                    <div class="row p-0 mb-0 cart_info">
                        <div class="col-6">
                            <p>Total items</p>
                        </div>
                        <div class="col-6 text-end">
                            <p><?php echo $_POST['product_quantity']?></p>
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
                    <div class="row pt-2 m-0">
                        <div class="payment_details filter_content px-0">
                        <form method = "POST" action = "quick_checkout.php">
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
                        <input type="hidden" name="transaction_id" value="<?php echo isset($_SESSION['transaction_id']) ? $_SESSION['transaction_id'] : '' ?>"/>
                        <input type="hidden" name="product_id" value="<?php echo $_POST['product_id'] ?>"/>
                        <input type="hidden" name="product_name" value="<?php echo $_POST['product'] ?>"/>
                        <input type="hidden" name="product_price" value="<?php echo $_POST['product_price'] ?>"/>
                        <input type="hidden" name="product_type" value="<?php echo $_POST['product_type'] ?>"/>
                        <input type="hidden" name="product_quantity" value="<?php echo $_POST['product_quantity'] ?>"/>
                        <input type="hidden" name="grand_total" value="<?php echo $_SESSION['grand_total'] ?>"/>
                        <input type="hidden" name="product_img_url" value="<?php echo $_POST['product_img_url'] ?>"/>
                        <input type="hidden" name="checkout_type" value="quick"/>
                        <button class="btn btn-dark border-0 rounded-1 w-100" type="submit" name="quick_order">CONFIRM ORDER</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>