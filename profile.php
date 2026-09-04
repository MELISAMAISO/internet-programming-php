<?php
// 1. Include shared navigation header (handles session check)
include_once 'includes/header.php';

// 2. Include database connection file
require_once 'config/db.php';

// 3. Fetch user details from MySQL database using the logged-in user_id
$stmt = $pdo->prepare("SELECT id, username, email, created_at FROM users WHERE id = :id");
$stmt->execute([':id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If user account is not found in DB for some reason, redirect to logout
if (!$user) {
    header("Location: logout.php");
    exit();
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white p-3">
                <h4 class="mb-0">👤 User Profile Details</h4>
            </div>
            <div class="card-body p-4">
                <p class="text-muted">Below are your registered account details retrieved directly from the database.</p>
                <hr>

                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold text-secondary">User ID:</div>
                    <div class="col-sm-8"><?php echo htmlspecialchars($user['id']); ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold text-secondary">Username:</div>
                    <div class="col-sm-8"><?php echo htmlspecialchars($user['username']); ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold text-secondary">Email Address:</div>
                    <div class="col-sm-8"><?php echo htmlspecialchars($user['email']); ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold text-secondary">Account Created:</div>
                    <div class="col-sm-8">
                        <?php echo date('F j, Y - g:i A', strtotime($user['created_at'])); ?>
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-between">
                    <a href="dashboard.php" class="btn btn-outline-secondary">Back to Dashboard</a>
                    <a href="contact.php" class="btn btn-primary">Contact Support</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include shared footer
include_once 'includes/footer.php';
?>