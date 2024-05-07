<?php
    // add connection
    include('server/connection.php');

    // start session
    session_start();
    

    if (isset($_POST['add_to_cart'])) {

        // if user has existing cart items
        if (isset($_SESSION['cart'])) {
            $style_array_ids = array_column($_SESSION['cart'], 'style_id');
            
            calculate_total_items();

            if ($_SESSION['total_items'] + $_POST['style_quantity'] > 10) {

                echo '<script>console.log("Quantity: ' . $_POST['style_quantity'] . '")</script>';

                echo "<script>alert('You can only add up to 10 items in the cart!')</script>";
            } 

            // if product has not been added to cart yet
            else {
                if (!in_array($_POST['style_id'], $style_array_ids)) {
                    
                    $_style_id = $_POST['style_id'];
                    
                    $style_array = array(
                        'style_id' => $_POST['style_id'],
                        'style_img_url' => $_POST['style_img_url'],
                        'style' => $_POST['style'],
                        'style_price' => $_POST['style_price'],
                        'style_quantity' => $_POST['style_quantity']
                    );
                    $_SESSION['cart'] [$_style_id] = $style_array;
                }
                // if product is already in the cart
                else {
                    echo "<script>alert('Product is already in the cart!')</script>";
                }
            }
        } 
        // if this is the first product in the cart    
        else {
            $style_id = $_POST['style_id'];
            $style_img_url = $_POST['style_img_url'];
            $style = $_POST['style'];
            $style_price = $_POST['style_price'];
            $style_quantity = $_POST['style_quantity'];           
            
            $style_array = array(
                'style_id' => $style_id,
                'style_img_url' => $style_img_url,
                'style' => $style,
                'style_price' => $style_price,
                'style_quantity' => $style_quantity
            );
            $_SESSION['cart'][$style_id] = $style_array;
        }

        // calculate total items in cart
        calculate_total();
        calculate_total_items();
    }
    
    else if (isset($_POST['edit_quantity'])) {
        $style_id = $_POST['style_id'];

        // get the style quantity
        $style_quantity = $_POST['style_quantity'];

        // get the style array from the session
        $style_array = $_SESSION['cart'][$style_id];

        // update the style quantity
        $style_array['style_quantity'] = $style_quantity;

        // update the session cart
        $_SESSION['cart'][$style_id] = $style_array;

        calculate_total();
        calculate_total_items();
    }

    else if (isset($_POST['remove_product'])) {
        $style_id = $_POST['style_id'];
        unset($_SESSION['cart'][$style_id]);

        calculate_total();
        calculate_total_items();
    } 
    
    else {
        // header('location: catalogue_page.php');
    }

    // function to calculate the total price of the cart
    function calculate_total() {
        $total = 0;

        foreach($_SESSION['cart'] as $key => $value) {
            $style = $_SESSION['cart'][$key];

            $price = $style['style_price'];
            $quantity = $style['style_quantity'];

            $total += $total + ($price * $quantity);
        }
        $_SESSION['total'] = $total;
    }

    // function to calculate the total items in the cart
    function calculate_total_items() {
        $total_items = 0;

        foreach($_SESSION['cart'] as $key => $value) {
            $total_items += $value['style_quantity'];
        }
        
        $_SESSION['total_items'] = $total_items;
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
    <?php include 'nav_bar.php'?>
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
                            <?php foreach($_SESSION['cart'] as $key => $value) { ?>
                                <!-- product in cart -->
                                <tr class="product_info align-middle">
                                    <th scope="row" class="item_img d-flex justify-content-center">
                                        <img src="resources/<?php echo $value['style_img_url']; ?>" class="card m-0" alt="item">
                                    </th>
                                    <td><?php echo $value['style'] . ' Box'; ?></td>
                                    <td class="text-center"><?php echo $value['style_price']; ?></td>
                                    <td class="text-center">
                                        <form method = "POST" action = "view_cart.php">
                                            <!-- edit quantity -->
                                            <input type="hidden" name="style_id" value="<?php echo $value['style_id']; ?>">
                                            <div class="input-group input-group-sm gray_btn m-auto p-0 center_align">
                                                <input type="number" class="form-control m-0 p-auto" name = "style_quantity" value="<?php echo $value['style_quantity']?>"  id="counter_input" min = "1" max = "3">
                                                <button style = "background-color: #fff; color: #FF6A97" type="submit" class="edit_btn btn btn-dark border-0 rounded-1" name = "edit_quantity" >Save</button>
                                            </div>
                                        </form> 
                                    </td>
                                    <td class="text-center"><?php echo 'PHP ' . $value['style_price'] * $value['style_quantity']; ?></td>
                                    <td>
                                        <!-- delete button -->
                                        <form method = "POST" action = "view_cart.php">
                                            <div class="center_align m-0 p-0 delete_btn">
                                                <input type="hidden" name="style_id" value="<?php echo $value['style_id']; ?>">

                                                <button class="btn btn-dark border-0 rounded-1" type = "submit" name = "remove_product"><i class="bi bi-trash-fill"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- proceed checkout -->
                <div class="col-sm-3 gray_bg rounded-2 px-4 py-3 m-2">
                    <!-- cart actions -->
                    <div class="row mt-3 border-bottom">
                        <h6 class="border-bottom pb-2 bold_header mb-3">Actions</h6>
                        <div class="form_style pb-3">
                            <input class="form-check-input me-2" type="checkbox" value="" id="all_items">
                            <label class="form-check-label" for="checkbox_agree">
                                Select all
                            </label>
                        </div>
                        <div class="delete_btn2 pb-3">
                            <button class="btn btn-dark border-0 rounded-1 w-100">Delete</button>
                        </div>
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
                        <a href="checkout_page.php"><button class="btn btn-dark border-0 rounded-1 w-100">CHECKOUT</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

