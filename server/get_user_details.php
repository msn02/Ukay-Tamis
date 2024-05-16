<?php 
    // Include the connection.php file
    include('connection.php');

    // Check if the user_id session variable is set
    if (isset($_SESSION['user_id'])) {
        // Prepare the SQL query
        $stmt = $conn -> prepare ("SELECT user.*, user_preference.*
                                    FROM user
                                    LEFT JOIN user_preference ON user.user_id = user_preference.user_id
                                    WHERE user.user_id = ?"); 


        // Bind the parameters
        $stmt -> bind_param("s", $_SESSION['user_id']);

        // Execute the query
        $stmt -> execute();
        
        // Get the result
        $user_details = $stmt -> get_result();

        // Fetch the result
        $row = $user_details -> fetch_assoc();

    } else {
        // If the user_id session variable is not set, set $recent_transactions to an empty array
        $user_details = array();
    }
?>