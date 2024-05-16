<?php 
    // include connection and start session
    include ('connection.php');

    $stmt = $conn -> prepare("SELECT * FROM subscription_plan WHERE plan_tier = ? AND plan_duration = ?");
    $stmt -> bind_param("ss", $_SESSION['sub_tier'], $_SESSION['sub_duration']);
    $stmt -> execute();
    $plan_details = $stmt -> get_result();
    $row = $plan_details -> fetch_assoc();
?>