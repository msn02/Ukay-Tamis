<?php 
    // include connection
    include ('connection.php');

    // get the subscription plan details
    $stmt = $conn -> prepare("SELECT * FROM subscription_plan WHERE plan_tier = ? AND plan_duration = ?");
    // bind the parameters
    $stmt -> bind_param("ss", $_SESSION['sub_tier'], $_SESSION['sub_duration']);
    // execute the query
    $stmt -> execute();
    // get the result
    $plan_details = $stmt -> get_result();
    // fetch the result
    $row = $plan_details -> fetch_assoc();
?>