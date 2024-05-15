<?php
session_start();

if (isset($_POST['transaction_id'])) {
    $_SESSION['transaction_id'] = $_POST['transaction_id'];
}
?>