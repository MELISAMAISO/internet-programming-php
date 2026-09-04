<?php
// Database credentials
$host     = 'localhost';
$dbname   = 'event_ticketing_db';
$username = 'root'; // Default XAMPP username
$password = '';     // Default XAMPP password is empty

try {
    // Create a new PDO connection to MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set PDO error mode to throw exceptions if a query fails
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Stop script and display error message if connection fails
    die("Database Connection Failed: " . $e->getMessage());
}
?>