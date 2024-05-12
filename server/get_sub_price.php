<?php
    include ('connection.php');

    // prepare the SQL query
    $stmt = $conn -> prepare ("SELECT plan_tier, plan_duration, price, monthly_price FROM subscription_plan subscription_plan WHERE plan_duration IN ('1 Month', '3 Months', '6 Months')");

    // execute the query
    $stmt -> execute();

    // get the result
    $result = $stmt -> get_result();

    // initialize an empty array to store the subscription details
    $sub_price = array();

    // initialize an empty array to store the details of the selected tier
    $selected_tier_details = array();
?>