<?php
// 1. Include navigation header (checks login session)
include_once 'includes/header.php';

// 2. Include database connection
require_once 'config/db.php';

// 3. Query all submissions from MySQL ordered by most recent first
// RIGHT: This filters submissions to ONLY show records for the logged-in user!
$stmt = $pdo->prepare("SELECT id, name, email, subject, message, submitted_at FROM contact_submissions WHERE user_id = :user_id ORDER BY submitted_at DESC");
$stmt->execute([':user_id' => $_SESSION['user_id']]);
$submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-primary text-white p-3 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">📋 Contact Submissions Directory</h4>
        <a href="contact.php" class="btn btn-light btn-sm fw-bold">+ New Message</a>
    </div>
    <div class="card-body p-4">
        <p class="text-muted">A complete list of queries and support messages submitted through the platform.</p>

        <?php if (count($submissions) > 0): ?>
            <!-- HTML Table displaying database records -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 5%;">#</th>
                            <th scope="col" style="width: 20%;">Sender Name</th>
                            <th scope="col" style="width: 20%;">Email</th>
                            <th scope="col" style="width: 20%;">Subject</th>
                            <th scope="col" style="width: 20%;">Message</th>
                            <th scope="col" style="width: 15%;">Submitted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($submissions as $index => $row): ?>
                            <tr>
                                <td><strong><?php echo $index + 1; ?></strong></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><a href="mailto:<?php echo htmlspecialchars($row['email']); ?>"><?php echo htmlspecialchars($row['email']); ?></a></td>
                                <td><span class="badge bg-secondary"><?php echo htmlspecialchars($row['subject']); ?></span></td>
                                <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                                <td class="small text-muted">
                                    <?php echo date('M j, Y - g:i A', strtotime($row['submitted_at'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                No submissions found yet. <a href="contact.php" class="alert-link">Click here to send the first message!</a>
            </div>
        <?php endif; ?>

        <div class="mt-3">
            <a href="dashboard.php" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div>
    </div>
</div>

<?php
// Include shared footer
include_once 'includes/footer.php';
?>