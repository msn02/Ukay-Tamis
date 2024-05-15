<?php 
    // Include the connection.php file
    include('connection.php');

    // Check if the user_id session variable is set
    if (isset($_SESSION['user_id'])) {
        // Prepare the SQL query
        $stmt = $conn -> prepare ("SELECT transaction.*, order_product.* 
                                   FROM transaction 
                                   INNER JOIN order_product ON transaction.transaction_id = order_product.transaction_id
                                   WHERE transaction.user_id = ? AND transaction.transaction_id = ?
                                   ORDER BY transaction.transaction_id LIMIT 1");

        // Bind the parameters
        $stmt -> bind_param("ss", $_SESSION['user_id'], $_SESSION['transaction_id']);

        // Execute the query
        $stmt -> execute();
        
        // Get the result
        $transaction = $stmt -> get_result();

    } else {
        // If the user_id session variable is not set, set $recent_transactions to an empty array
        $transaction = array();
    }
?>