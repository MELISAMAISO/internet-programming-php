<?php
// 1. Include shared navigation header (checks session guard)
include_once 'includes/header.php';

// 2. Include database connection
require_once 'config/db.php';

$success_message = '';
$error_message = '';

// Check if user clicked to generate a new ticket pass
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = trim($_POST['event_name']);

    if (empty($event_name)) {
        $error_message = "Please select or enter an event name.";
    } else {
        // Generate a unique random ticket verification code
        $ticket_code = 'PASS-' . strtoupper(substr(md5(mt_rand()), 0, 8));

        // Insert ticket into MySQL database using Prepared Statement
        $stmt = $pdo->prepare("INSERT INTO tickets (user_id, event_name, ticket_code) VALUES (:user_id, :event_name, :ticket_code)");
        $inserted = $stmt->execute([
            ':user_id'     => $_SESSION['user_id'],
            ':event_name'  => $event_name,
            ':ticket_code' => $ticket_code
        ]);

        if ($inserted) {
            $success_message = "New event pass generated successfully!";
        } else {
            $error_message = "Failed to generate pass. Please try again.";
        }
    }
}

// Fetch all tickets belonging strictly to the currently logged-in user
$ticketStmt = $pdo->prepare("SELECT event_name, ticket_code, purchased_at FROM tickets WHERE user_id = :user_id ORDER BY purchased_at DESC");
$ticketStmt->execute([':user_id' => $_SESSION['user_id']]);
$my_tickets = $ticketStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row">
    <!-- Left Column: Generate Pass Form -->
    <div class="col-md-5 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-success text-white p-3">
                <h4 class="mb-0">🎟️ Generate Event Pass</h4>
            </div>
            <div class="card-body p-4">
                <p class="text-muted">Register for an upcoming tech event or workshop to generate your secure database-backed digital pass.</p>

                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>

                <form action="my_tickets.php" method="POST">
                    <div class="mb-3">
                        <label for="event_name" class="form-label">Select Event Workshop</label>
                        <select name="event_name" id="event_name" class="form-select" required>
                            <option value="">-- Choose an Event --</option>
                            <option value="PHP & MySQL Security Masterclass 2026">PHP & MySQL Security Masterclass 2026</option>
                            <option value="Full-Stack Web Development Hackathon">Full-Stack Web Development Hackathon</option>
                            <option value="UI/UX Prototyping Workshop">UI/UX Prototyping Workshop</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Generate Digital Pass</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: User's Active Passes Display -->
    <div class="col-md-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-primary text-white p-3">
                <h4 class="mb-0">🎫 My Active Ticket Passes</h4>
            </div>
            <div class="card-body p-4">
                <p class="text-muted">Your active event passes linked to your account database.</p>

                <?php if (count($my_tickets) > 0): ?>
                    <div class="list-group">
                        <?php foreach ($my_tickets as $ticket): ?>
                            <div class="list-group-item list-group-item-action mb-3 border rounded shadow-sm p-3">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <h5 class="mb-1 text-primary fw-bold"><?php echo htmlspecialchars($ticket['event_name']); ?></h5>
                                    <span class="badge bg-dark font-monospace"><?php echo htmlspecialchars($ticket['ticket_code']); ?></span>
                                </div>
                                <p class="mb-1 text-muted small">Registered Pass Code. Present this code at the venue entrance checkpoint for validation.</p>
                                <small class="text-secondary">Issued on: <?php echo date('M j, Y - g:i A', strtotime($ticket['purchased_at'])); ?></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center">
                        You don't have any active ticket passes yet. Use the form on the left to generate one!
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="dashboard.php" class="btn btn-outline-secondary">Back to Dashboard</a>
</div>

<?php
// Include shared footer
include_once 'includes/footer.php';
?>