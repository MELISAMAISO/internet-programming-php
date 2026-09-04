<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    echo "<h3>Submitted Data:</h3>";
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
}
?>


