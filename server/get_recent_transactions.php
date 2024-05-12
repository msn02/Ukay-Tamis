<?php 
    // Include the connection.php file
    include('connection.php');

    // Prepare the SQL query
    $stmt = $conn -> prepare ("SELECT * FROM transaction 
                               WHERE transaction.user_id = ?
                               ORDER BY transaction.transaction_id DESC LIMIT 3");

    // Bind the parameters
    $stmt -> bind_param("i", $_SESSION['user_id']);

    // Execute the query
    $stmt -> execute();
    
    // Get the result
    $recent_transactions = $stmt -> get_result();
?>