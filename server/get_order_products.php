<?php 
    // Include the connection.php file
    include('connection.php');

    // Check if the user_id session variable is set
    if (isset($_SESSION['user_id'])) {
        // Prepare the SQL query
        $stmt = $conn -> prepare ("SELECT transaction.*, order_product.*, item.*, style_box.*, style.*
                                    FROM transaction 
                                    INNER JOIN order_product ON transaction.transaction_id = order_product.transaction_id
                                    LEFT JOIN item ON transaction.transaction_id = item.transaction_id
                                    LEFT JOIN style_box ON order_product.style_box_id = style_box.style_box_id
                                    LEFT JOIN style ON style_box.style_id = style.style_id
                                    WHERE transaction.user_id = ? AND transaction.transaction_id = ?
                                    ORDER BY transaction.transaction_id DESC");

        // Bind the parameters
        $stmt -> bind_param("si", $_SESSION['user_id'], $_SESSION['transaction_id']);

        // Execute the query
        $stmt -> execute();
        
        // Get the result
        $order_products = $stmt -> get_result();

    } else {
        // If the user_id session variable is not set, set $recent_transactions to an empty array
        $order_products = array();
    }
?>