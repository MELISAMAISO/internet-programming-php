<?php
// Start session to manage user state
session_start();

// Include database connection
require_once 'config/db.php';

$error_message = '';
$success_message = '';

// Check if the user submitted the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Grab and sanitize input values (Server-side validation)
    $username = trim($_POST['username']);
    $email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // 2. Server-side Input Validation
    if (empty($username) || empty($email) || empty($password)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters long.";
    } else {
        // 3. Check if username or email already exists in MySQL
        $checkStmt = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
        $checkStmt->execute([':username' => $username, ':email' => $email]);

        if ($checkStmt->rowCount() > 0) {
            $error_message = "Username or Email is already taken.";
        } else {
            // 4. Securely Hash Password (BCRYPT)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // 5. Insert new user into MySQL using Prepared Statement
            $insertStmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $inserted = $insertStmt->execute([
                ':username' => $username,
                ':email'    => $email,
                ':password' => $hashedPassword
            ]);

            if ($inserted) {
                $success_message = "Account created successfully! <a href='index.php'>Click here to Login</a>";
            } else {
                $error_message = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Event Ticketing</title>
    <!-- Simple Bootstrap CSS for instant clean UI styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">Create an Account</h3>

                    <!-- Display Feedback Messages -->
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>

                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success"><?php echo $success_message; ?></div>
                    <?php endif; ?>

                    <!-- HTML Registration Form -->
                    <form action="register.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>

                    <p class="text-center mt-3 mb-0">
                        Already have an account? <a href="index.php">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>