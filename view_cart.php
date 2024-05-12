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
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- product in cart -->
                            <tr class="product_info align-middle">
                                <th scope="row" class="item_img d-flex justify-content-center">
                                    <img src="resources/coquette.jpg" class="card m-0" alt="item">
                                </th>
                                <td>Victorian-inspired dress</td>
                                <td class="text-center">PHP 123</td>
                                <td class="text-center">
                                    <div class="input-group input-group-sm gray_btn m-auto p-0 center_align">
                                        <button class="btn btn-dark rounded-start" type="button" id="minus_btn">-</button>
                                        <input type="number" class="form-control m-0 p-auto" value="1" readonly id="counter_input">
                                        <button class="btn btn-dark rounded-end" type="button" id="add_btn">+</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="center_align m-0 p-0 delete_btn">
                                        <button class="btn btn-dark border-0 rounded-1"><i class="bi bi-trash-fill"></i></button>
                                    </div>
                                </td>
                            </tr>
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
                            <p class="bold_header">4</p>
                        </div>
                    </div>
                    <div class="row p-0 mb-0 cart_info">
                        <div class="col-6">
                            <p class="bold_header">TOTAL</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="pink_highlight bold_header">PHP 156</p>
                        </div>
                    </div>
                    <div class="pink_btn2 pb-3">
<<<<<<<< HEAD:view_cart.php
                        <form method = "POST" action = "checkout_page.php">
                            <input type="hidden" name="total" value="<?php echo $_SESSION['total'];?>">
                            <input type="hidden" name="total_items" value="<?php echo $_SESSION['total_items'];?>">
                            <input type="hidden" name="cart" value="<?php echo $cart_value;?>">
                            <button class="btn btn-dark border-0 rounded-1 w-100" type = "submit" name = "checkout" <?php if(empty($_SESSION['cart'])) { echo "disabled"; }?>>CHECKOUT</button>
                        </form>
========
                        <a href="checkout.php"><button class="btn btn-dark border-0 rounded-1 w-100">CHECKOUT</button></a>
>>>>>>>> origin/tep-test-dev:cart.php
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!-- counter script -->
<script>
    const counterInput = document.getElementById('counter_input');
    const addButton = document.getElementById('add_btn');
    const minusButton = document.getElementById('minus_btn');

    addButton.addEventListener('click', function() {
        counterInput.value = parseInt(counterInput.value) + 1;
    });

    minusButton.addEventListener('click', function() {
        const currentValue = parseInt(counterInput.value);
        if (currentValue > 1) {
            counterInput.value = currentValue - 1;
        }
    });
</script>
