<?php 
    // Include the connection.php file
    include('connection.php');

    // Prepare the SQL query
    $stmt = $conn -> prepare ("SELECT transaction.*, order_product.* 
                               FROM transaction 
                               INNER JOIN order_product ON transaction.transaction_id = order_product.transaction_id
                               WHERE transaction.user_id = ?
                               ORDER BY transaction.transaction_id DESC LIMIT 3");

    // Bind the parameters
    $stmt -> bind_param("i", $_SESSION['user_id']);

    // Execute the query
    $stmt -> execute();
    
    // Get the result
    $recent_transactions = $stmt -> get_result();
?>