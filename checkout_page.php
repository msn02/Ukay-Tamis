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
    <?php include 'nav_bar.php'?>

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
                                    <img src="resources/coquette.jpg" class="card m-0" alt="item">
                                </th>
                                <td>Victorian-inspired dress</td>
                                <td class="text-center">PHP 123</td>
                                <td class="text-center">1</td>
                                <td class="text-center bold_header"><span class="pink_highlight2 ">PHP 123</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- proceed checkout -->
                <div class="col-sm-3 gray_bg rounded-2 px-4 py-3 m-2">
                    <!-- delivery details -->
                    <div class="row mt-3 mb-2 pb-2 border-bottom">
                        <h6 class="border-bottom pb-2 bold_header">Order Information</h6>
                        <div class="delivery_info p-3 card m-0">
                            <h6>DELIVERY ADDRESS</h6>
                            <div class="">
                                <p class="bold_header mb-1 p-0">Juan Dela Cruz</p>
                                <p class="m-0 p-0">09123456789</p>
                                <p class="m-0 p-0">69075 Louann Turnpike, West Mariella, KY 01624</p>
                            </div>
                        </div>
                        <div class="gray_btn mt-2">
                            <a href="#"><button class="btn btn-dark border-0 rounded-1 w-100">Change Delivery Address</button></a>
                        </div>
                    </div>
                    <!-- cart info -->
                    <div class="row mt-3 p-0 mb-0 cart_info">
                        <div class="col-6">
                            <p>Order ID</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="bold_header">12345</p>
                        </div>
                    </div>
                    <div class="row p-0 mb-0 cart_info">
                        <div class="col-6">
                            <p>Total items</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="bold_header">4</p>
                        </div>
                    </div>
                    <div class="row p-0 mb-2 cart_info border-bottom">
                        <div class="col-6">
                            <p class="bold_header">TOTAL</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="pink_highlight bold_header">PHP 156</p>
                        </div>
                    </div>
                    <div class="row pt-2 m-0">
                        <div class="payment_details filter_content px-0">
                            <h6 class="bold_header">Select your Payment Method</h6>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="payment_method" type="radio" value="" id="Cash">
                                <label class="form-check-label ms-1" for="small">Cash</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="payment_method" type="radio" value="" id="Credit Card">
                                <label class="form-check-label ms-1" for="small">Credit Card</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="payment_method" type="radio" value="" id="GCash">
                                <label class="form-check-label ms-1" for="small">GCash</label>
                            </div>
                        </div>
                    </div>
                    <div class="pink_btn2 mt-3 pb-2">
                        <a href="#"><button class="btn btn-dark border-0 rounded-1 w-100">PLACE ORDER</button></a>
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
