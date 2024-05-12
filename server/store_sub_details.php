<?php
// Include the database connection file
include 'connection.php';

    if (!isset($_POST['monthly_price']) && !isset($_POST['plan_duration']) && !isset($_POST['total_price'])){
        if (isset($_POST["plan_tier"])) {
            $_SESSION["selected_tier"] = $_POST["plan_tier"];
        }
    } else if (isset($_POST['monthly_price']) && isset($_POST['plan_duration']) && isset($_POST['total_price'])) {
        echo 'a11 : ' . $_POST['plan_duration'];
      
        $monthly_price = $_POST['monthly_price'];
        $plan_duration = $_POST['plan_duration'];
        $total_price = $_POST['total_price'];

        $_SESSION ['total_price'] = $total_price;
        $_SESSION ['monthly_price'] = $monthly_price;
        $_SESSION ['plan_duration'] = $plan_duration;

        echo 'a11 : ' . $_SESSION['monthly_price'];
        echo 'a11 : ' . $_SESSION['total_price'];
        echo 'a11 : ' . $_SESSION['plan_duration'];
    } else {
        echo 'Error: price and duration not set';
    }
?>