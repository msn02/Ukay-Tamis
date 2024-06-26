<?php
    // include connection
    session_start();

    if (isset($_GET['item_id'])) {

        include('server/connection.php');
        $item_id = $_GET['item_id'];

        // Prepare the SQL query
        $stmt = $conn -> prepare ("SELECT * FROM item WHERE item_id = ? AND transaction_id IS NOT NULL");

        // Bind the parameters
        $stmt -> bind_param("s", $item_id);

        // Execute the query
        $stmt -> execute();
        
        // Get the result
        $result = $stmt -> get_result();
        $row = $result -> fetch_assoc();

        // Redirect if the item has already been purchased
        if ($row && $row['transaction_id'] !== NULL) {
            header('location: catalogue_page.php');
            exit();
        }
    }
?>

<?php include('server/get_item_page.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/style_box.css">
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

    <div class="container-fluid px-3 pt-1 gradient_pink center-align">
        <div class="container px-5 py-3">
            <!-- back button -->
            <div class="back_link p-2">
                <a class="border-0 p-2 rounded-1 justify-content-start text-decoration-none w-25" id="go_back" href="javascript:void(0)"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>
            <!-- style box details -->
            <?php while ($row = $item->fetch_assoc()) { ?>
                <div class="row shadow rounded-2 m-3 gray_bg">
                    <!-- product image -->
                    <div class="col-sm-5 m-0 p-4">
                        <div class="card overflow-hidden border-0">
                            <img src="resources/<?php echo $row['item_img_url']; ?>" alt="<?php echo $row['item_name']; ?>">
                        </div>
                    </div>
                    <!-- product details -->
                    <div class="col-sm-7 m-0 py-4 px-3 vstack d-flex align-items-stretch">
                        <!-- tag and title -->
                        <div class="row m-0 p-3 pb-0 justify-content-between g-3">
                            <div class="col-sm-10 m-0 p-0">
                                <h2 class="bold_header align-content-center ps-0 mb-0 pb-0"><?php echo $row['item_name']; ?></h2>
                            </div>
                            <div class="d-sm-none d-block m-1"></div>
                            <div class="col-sm-3 col-md-2 m-0 p-0 bold_header center-align align-content-center">
                                <p class="rounded-1 tag_pink px-2 py-1 m-0 center_text"><?php echo $row['style']; ?></p>
                            </div>
                        </div>
                        <!-- item price -->
                        <div class="pt-3 px-3 mb-0">
                            <div class="m-0">
                                <h4 class="pink_highlight2 rounded-2 p-3 bold_header box_price"><?php echo $row['price']; ?></h4>
                            </div>
                        </div>
                        <!-- item description -->
                        <div class="pt-3 px-3 mb-0">
                            <div class="border-top pt-3 pb-0 m-0">
                                <h6 class="bold_header">What's in the box?</h6>
                                <p class="box_desc m-0 p-0"><?php echo $row['item_description']; ?></p>
                            </div>
                        </div>
                        <!-- size and color -->
                        <div class="pt-3 px-3 mb-0">
                            <div class="border-top pt-3 pb-0 m-0">
                                <div class="row">
                                    <!-- size -->
                                    <div class="col-sm-4">
                                        <h6 class="bold_header">Size</h6>
                                        <p class="box_desc m-0 p-0">
                                            <?php 
                                                if ($row['size'] == 'L') {
                                                    echo 'Large';
                                                } elseif ($row['size'] == 'M') {
                                                    echo 'Medium';
                                                } elseif ($row['size'] == 'S') {
                                                    echo 'Small';
                                                } elseif ($row['size'] == 'XL') {
                                                    echo 'Extra Large';
                                                } elseif ($row['size'] == 'XS') {
                                                    echo 'Extra Small';
                                                } else {
                                                    echo 'freesize'; // Default case if size is not L, M, S, XL, or XS
                                                }
                                            ?>
                                        </p>
                                    </div>
                                    <!-- color -->
                                    <div class="col-sm-4">
                                        <h6 class="bold_header">Color</h6>
                                        <p class="box_desc m-0 p-0"><?php echo $row['color']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- add to cart and buy now button -->
                        <div class="px-3 pt-0 mt-auto hstack gap-2">
                            <form method = "POST" action = "view_cart.php">
                                <input type = "hidden" name = "product_id" value = "<?php echo $row['item_id']; ?>"> </input>
                                <input type = "hidden" name = "product_img_url" value = "<?php echo $row['item_img_url']; ?>"> </input>
                                <input type = "hidden" name = "product" value = "<?php echo $row['item_name']; ?>"> </input>
                                <input type = "hidden" name = "product_price" value = "<?php echo $row['price']; ?>"> </input>
                                <input type = "hidden" name = "product_quantity" value = "1"> </input>
                                <input type = "hidden" name = "item" value = "<?php echo $row['item_id']; ?>"> </input>
                                <input type = "hidden" name = "product_type" value = "item"> </input>
                                <div class="d-inline add_cart">
                                    <button class="btn btn-dark border-0 px-3 py-2 mb-1 rounded-1" type="submit" name ="add_to_cart"><i class="bi bi-cart-plus me-1"></i></button>
                                </div>
                             </form>

                            <form method = "POST" action = "<?php echo "quick_checkout.php?item_id=" . $row['item_id'] ?>">
                                <input type = "hidden" name = "product_id" value = "<?php echo $row['item_id']; ?>"> </input>
                                <input type = "hidden" name = "product_img_url" value = "<?php echo $row['item_img_url']; ?>"> </input>
                                <input type = "hidden" name = "product" value = "<?php echo $row['item_name']; ?>"> </input>
                                <input type = "hidden" name = "product_price" value = "<?php echo $row['price']; ?>"> </input>
                                <input type = "hidden" name = "product_quantity" value = "1"> </input>
                                <input type = "hidden" name = "item" value = "<?php echo $row['item_id']; ?>"> </input>
                                <input type = "hidden" name = "product_type" value = "item"> </input>
                                <div class="d-inline buy_now">
                                    <button class="btn btn-dark border-0 px-3 py-2 mb-1 rounded-1" type="submit" name = "buy_now">Buy Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Related  Single Items -->
            <div class="row rounded-2 m-3 p-2 gray_bg">
                <div class="mt-3 mb-0 ms-2 single_items">
                    <h6 class="mb-0">You might also like</h6>
                </div>
                <div class="row mt-0 mx-1 p-2 gx-3">
                    <!-- include the get_related_item_item.php file -->
                    <?php include('server/get_related_item_item.php'); ?>
                
                    <!-- loop through the related items -->
                    <?php if ($related_items->num_rows > 0) { 
                        while ($row = $related_items->fetch_assoc()) { ?>
                    
                        <!-- card -->
                        <div class="col-sm-3 p-2">
                            <a href="<?php echo "item.php?item_id=" . $row['item_id'] ?>" class="text-decoration-none">
                                <div class="card overflow-hidden rounded-1 card_content item_card">
                                    <img src="resources/<?php echo $row['item_img_url']; ?>" class="img-fluid card-img-top rounded-top-1" alt="<?php echo $row['item_name']; ?>">
                                    <div class="card-body p-3">
                                        <p class="item_name"><?php echo $row['item_name']; ?></p>
                                        <!-- price and category -->
                                        <div class="row p-0 d-flex justify-content-between">
                                            <div class="col-5 m-0 text-align-left">
                                                <p class="card-text item_price m-0"><?php echo $row['price']; ?></p>
                                            </div>
                                            <div class="col-6 m-0 bold_header center_text center_align justify-content-end">
                                                <p class="rounded-1 tag_green m-0 px-2 py-1">FEATURED</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php 
                    } 
                } else { 
                    echo '<h6 class="text-center">No other available items right now. Check back soon!</h6>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>