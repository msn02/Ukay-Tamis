<?php
    // Prepare the SQL query
    $stmt = $conn -> prepare ("SELECT DISTINCT plan_tier, plan_tier_description FROM subscription_plan WHERE plan_tier IN ('Starter Pack', 'Fashionista Bundle', 'Wardrobe Refresh')");

    // Execute the query
    $stmt -> execute();

    // Get the result
    $result = $stmt -> get_result();

    // Initialize an empty array to store the subscription details
    $sub_tier_details = array();

    // Loop through the result and store the details in the array
    while ($row = $result -> fetch_assoc()) {
        $sub_tier_details[] = array(
            'plan_tier' => $row['plan_tier'],
            'plan_tier_description' => $row['plan_tier_description']
        );
    }
?>