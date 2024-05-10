<?php

// Include the database connection file
include 'connection.php';

if (!isset($_POST['monthly_price']) && !isset($_POST['plan_duration'])) {
    $_SESSION["selected_tier"] = "Starter Pack";
    $_SESSION["monthly_price"] = "199.83";
    $_SESSION["plan_duration"] = "6 months";

}

else if (isset($_POST['monthly_price']) && isset($_POST['plan_duration'])) {
    $monthly_price = $_POST['monthly_price'];
    $plan_duration = $_POST['plan_duration'];

    $_SESSION ['monthly_price'] = $monthly_price;
    $_SESSION ['plan_duration'] = $plan_duration;
    
    // Query the database for the row that matches the price and duration
    $stmt = $conn->prepare('SELECT * FROM subscription_plan WHERE monthly_price = ? AND plan_duration = ? LIMIT 1');
    $stmt->bind_param('ss', $monthly_price, $plan_duration);
    $stmt->execute();
    
    // Fetch the result
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Store the result in the session
        $_SESSION['plan_tier'] = $row['plan_tier'];
        $_SESSION['plan_tier_description'] = $row['plan_tier_description'];
        $_SESSION['price'] = $row['price'];

        var_dump($_SESSION);

        echo '$_SESSION[plan_tier] = ' . $_SESSION['plan_tier'] . '<br>';
        echo '$_SESSION[plan_tier_description] = ' . $_SESSION['plan_tier_description'] . '<br>';
        echo '$_SESSION[price] = ' . $_SESSION['price'] . '<br>';

        echo 'Session variables set successfully';
    } else {
        echo 'Error: no matching row found';
    }
} else {
    echo 'Error: price and duration not set';
}
?>