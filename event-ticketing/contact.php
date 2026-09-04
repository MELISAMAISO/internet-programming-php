<?php
// 1. Include shared navigation header
include_once 'includes/header.php';

// 2. Include database connection
require_once 'config/db.php';

$error_message   = '';
$success_message = '';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and trim user inputs
    $name    = trim($_POST['name']);
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Server-side validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } else {
        // Insert submission into MySQL database using Prepared Statement
        $stmt = $pdo->prepare("INSERT INTO contact_submissions (user_id,name, email, subject, message) VALUES (:user_id,:name, :email, :subject, :message)");
        $inserted = $stmt->execute([
            ':user_id' => $_SESSION['user_id'],
            ':name'    => $name,
            ':email'   => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);

        if ($inserted) {
            $success_message = "Thank you! Your message has been submitted and saved successfully.";
        } else {
            $error_message = "Failed to submit message. Please try again.";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white p-3">
                <h4 class="mb-0">✉️ Contact Support</h4>
            </div>
            <div class="card-body p-4">
                <p class="text-muted">Have a question or issue? Fill out the form below to reach out to our team.</p>

                <!-- Feedback Messages -->
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>

                <!-- Contact Form (Satisfies Project Requirements) -->
                <form action="contact.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" name="name" id="name" class="form-control" required value="<?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" name="email" id="email" class="form-control" required value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="e.g. Pass Verification Question" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" id="message" rows="5" class="form-control" placeholder="Type your message here..." required></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="dashboard.php" class="btn btn-outline-secondary">Back to Dashboard</a>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
// Include shared footer
include_once 'includes/footer.php';
?>