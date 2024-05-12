<?php
    // add connection
    include('server/connection.php');

    // start session
    session_start();
    
    // if user is not logged in, redirect to log in page
    if (!isset($_SESSION['logged_in'])) {
        header('location: log_in.php');
    }
    
    else {
        // function to calculate the total price of the cart
        function calculate_total() {
            $total = 0;
    
            foreach($_SESSION['cart'] as $key => $value) {
                $product = $_SESSION['cart'][$key];
    
                $price = $product['product_price'];
                $quantity = $product['product_quantity'];
    
                $total += $total + ($price * $quantity);
            }
            $_SESSION['total'] = $total;
        }
    
        // function to calculate the total items in the cart
        function calculate_total_items() {
            $total_items = 0;
    
            foreach($_SESSION['cart'] as $key => $value) {
                $total_items += $value['product_quantity'];
            }
            
            $_SESSION['total_items'] = $total_items;
        }

        // if user clicks add to cart
        if (isset($_POST['add_to_cart'])) {

            // if user has existing cart items
            if (isset($_SESSION['cart'])) {
                $product_array_ids = array_column($_SESSION['cart'], 'product_id');

                // check if the product added to cart is an item
                $product_type = '';
                if (isset($_POST['item'])) {
                    $_SESSION['item'] = $_POST['item'];
                    $product_type = 'item';
                }
                // check if the product added to cart is a style box
                else if (isset($_POST['style_box'])) {
                    $_SESSION['style_box'] = $_POST['style_box'];
                    $product_type = 'style box';
                }
                calculate_total_items();
    
                if ($_SESSION['total_items'] + $_POST['product_quantity'] > 10) {
                    echo '<script>console.log("Quantity: ' . $_POST['product_quantity'] . '")</script>';
                    echo "<script>alert('You can only add up to 10 items in the cart!')</script>";
                } 
    
                // if product has not been added to cart yet
                else {
                    if (!in_array($_POST['product_id'], $product_array_ids)) {
                        $product_id = $_POST['product_id'];
                        
                        $product_array = array(
                            'product_id' => $_POST['product_id'],
                            'product_img_url' => $_POST['product_img_url'],
                            'product' => $_POST['product'],
                            'product_price' => $_POST['product_price'],
                            'product_quantity' => $_POST['product_quantity'],
                            'product_type' => $product_type
                        );
                        $_SESSION['cart'] [$product_id] = $product_array;
                    }
                    // if product is already in the cart
                    else {
                        echo "<script>alert('Product is already in the cart!')</script>";
                    }
                }
            } 
            // if this is the first product in the cart    
            else {
                $product_id = $_POST['product_id'];
                $product_img_url = $_POST['product_img_url'];
                $product = $_POST['product'];
                $product_price = $_POST['product_price'];
                $product_quantity = $_POST['product_quantity'];      
                $product_type = $_POST['product_type'];

                $product_array = array(
                    'product_id' => $product_id,
                    'product_img_url' => $product_img_url,
                    'product' => $product,
                    'product_price' => $product_price,
                    'product_quantity' => $product_quantity,
                    'product_type' => $product_type
                );
                $_SESSION['cart'][$product_id] = $product_array;
            }
            // calculate total items in cart
            calculate_total();
            calculate_total_items();
        }
        
        // edit product quantity
        else if (isset($_POST['edit_quantity'])) {
            $product_id = $_POST['product_id'];
    
            // get the product quantity
            $product_quantity = $_POST['product_quantity'];
    
            // get the product array from the session
            $product_array = $_SESSION['cart'][$product_id];
    
            // update the product quantity
            $product_array['product_quantity'] = $product_quantity;
    
            // update the session cart
            $_SESSION['cart'][$product_id] = $product_array;
    
            calculate_total();
            calculate_total_items();
        }
        
        // remove product from cart
        else if (isset($_POST['remove_product'])) {
            $product_id = $_POST['product_id'];
            unset($_SESSION['cart'][$product_id]);
    
            calculate_total();
            calculate_total_items();
        } 

        // delete all items in the cart
        else if (isset($_POST['delete_all'])) {
            if (isset($_POST['select_all'])) {
                // if select_all checkbox is checked, delete all items in the cart
                unset($_SESSION['cart']);
                $_SESSION['total_items'] = 0;
                $_SESSION['total'] = 0;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shopping Cart</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/view_cart.css">
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
                <!-- shopping cart -->
                <div class="col-sm-8 gray_bg rounded-2 px-4 py-2 m-2">
                    <h3 class="bold_header mb-3 pb-3 border-bottom mt-3">My Shopping Cart</h3>
                    
                    <table class="table">
                        <thead>
                            <tr class="thead_style">
                                <th scope="col">Image</th>
                                <th scope="col-7">Product Name</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col-1">Quantity</th>
                                <th scope="col-1">Sub Total</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($_SESSION['cart'])) { ?>
                                <!-- No items chosen -->
                                <tr class="product_info align-middle">
                                    <td colspan="6" class="text-center">No items chosen</td>
                                </tr>
                            <?php } else { ?>
                                <!-- Cart items -->
                                <?php foreach($_SESSION['cart'] as $key => $value) { ?>
                                    <tr class="product_info align-middle">
                                        <th scope="row" class="item_img d-flex justify-content-center">
                                            <img src="resources/<?php echo $value['product_img_url']; ?>" class="card m-0" alt="item">
                                        </th>
                                        <td><?php echo $value['product']; ?></td>
                                        <td class="text-center"><?php echo $value['product_price']; ?></td>
                                        <td class="text-center">
                                            <form method="POST" action="view_cart.php">
                                                <!-- edit quantity -->
                                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                                <?php if (isset($_SESSION['item']) && $_SESSION['item'] == $value['product_id']) { ?>
                                                    <td class="text-center"><?php echo $value['product_quantity']; ?></td>
                                                <?php } else { ?>
                                                    <div class="input-group input-group-sm gray_btn m-auto p-0 center_align">
                                                    <input type="number" class="form-control m-0 p-auto" name="product_quantity" value="<?php echo $value['product_quantity'] ?>" id="counter_input" min="1" max="3">
                                                    <button style="background-color: #fff; color: #FF6A97" type="submit" class="edit_btn btn btn-dark border-0 rounded-1" name="edit_quantity">Edit</button>
                                                    </div>
                                                <?php } ?>
                                            </form> 
                                        </td>
                                        <td class="text-center"><?php echo 'PHP ' . $value['product_price'] * $value['product_quantity']; ?></td>
                                        <td>
                                            <!-- delete button -->
                                            <form method="POST" action="view_cart.php">
                                                <div class="center_align m-0 p-0 delete_btn">
                                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                                    <button class="btn btn-dark border-0 rounded-1" type="submit" name="remove_product"><i class="bi bi-trash-fill"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php 
                        // set total items and total to 0 if cart is empty
                        if(empty($_SESSION['cart'])) {
                            $_SESSION['total_items'] = 0;
                            $_SESSION['total'] = 0;
                            $cart_value = 0;
                        } else {
                            // calculate total items and total
                            calculate_total_items();
                            calculate_total();
                            $cart_value = serialize($_SESSION['cart']);
                        }
                    ?>
                </div>

                <!-- proceed checkout -->
                <div class="col-sm-3 gray_bg rounded-2 px-4 py-3 m-2">
                    <!-- cart actions -->
                    <div class="row mt-3 border-bottom">
                        <form method = "POST" action = "view_cart.php">
                            <h6 class="border-bottom pb-2 bold_header mb-3">Actions</h6>
                            <div class="form_style pb-3">
                                <input class="form-check-input me-2" type="checkbox" name = "select_all" value="" id="all_items">
                                <label class="form-check-label" for="checkbox_agree">
                                    Select all
                                </label>
                            </div>
                            <div class="delete_btn2 pb-3">
                                <button class="btn btn-dark border-0 rounded-1 w-100" type = "submit" name = "delete_all">Delete all</button>
                            </div>
                        </form>
                    </div>
                    <!-- cart info -->
                    <div class="row mt-3 p-0 mb-0 cart_info">
                        <div class="col-6">
                            <p>Total items</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="bold_header"><?php echo $_SESSION['total_items']; ?></p>
                        </div>
                    </div>
                    <div class="row p-0 mb-0 cart_info">
                        <div class="col-6">
                            <p class="bold_header">TOTAL</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="pink_highlight bold_header"><?php echo 'PHP ' . $_SESSION['total']; ?></p>
                        </div>
                    </div>
                    
                    <div class="pink_btn2 pb-3">
                        <form method = "POST" action = "checkout_page.php">
                            <input type="hidden" name="total" value="<?php echo $_SESSION['total'];?>">
                            <input type="hidden" name="total_items" value="<?php echo $_SESSION['total_items'];?>">
                            <input type="hidden" name="cart" value="<?php echo $cart_value;?>">
                            <button class="btn btn-dark border-0 rounded-1 w-100" type = "submit" name = "checkout" <?php if(empty($_SESSION['cart'])) { echo "disabled"; }?>>CHECKOUT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>