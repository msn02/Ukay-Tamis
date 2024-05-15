<?php
session_start();

// Check if the transaction_id POST variable is set
if (isset($_POST['transaction_id'])) {
    // Update the session variable
    $_SESSION['transaction_id'] = $_POST['transaction_id'];

    // You can echo something here if you want to send a response back to the client
    echo 'Session variable updated';
}
?>