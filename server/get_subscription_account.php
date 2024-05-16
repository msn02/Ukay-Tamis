<?php 
    // Include the connection.php file
    include('connection.php');

    // Check if the user_id session variable is set
    if (isset($_SESSION['user_id'])) {
        // Prepare the SQL query
        $stmt = $conn->prepare("SELECT * FROM subscription 
                                JOIN subscription_plan ON subscription.plan_id = subscription_plan.plan_id 
                                WHERE user_id = ? 
                                ORDER BY sub_id DESC 
                                LIMIT 1");

        // Bind the user_id session variable to the query
        $stmt->bind_param("s", $_SESSION['user_id']);

        // Execute the query
        $stmt -> execute();
        
        // Get the result
        $subscription = $stmt -> get_result();

        // Fetch the result
        $row = $subscription -> fetch_assoc();

    } else {
        // If the user_id session variable is not set, set $recent_transactions to an empty array
        $subscription = array();
    }
?>