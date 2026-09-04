<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user session variable exists; if not, kick to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>