<?php
// Include shared header (which also checks if user is logged in)
include_once 'includes/header.php';
?>

<!-- Welcome Banner (Fulfills Dashboard Requirement) -->
<div class="p-4 mb-4 bg-primary text-white rounded-3 shadow-sm">
    <div class="container-fluid py-2">
        <h1 class="display-6 fw-bold">Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>! 👋</h1>
        <p class="col-md-8 fs-5">Manage your event registrations, generate dynamic ticket passes and contact support all from your unified portal.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Quick Metric Card 1 -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center p-4">
                <h5 class="card-title text-muted">User Account</h5>
                <p class="card-text fs-4 fw-bold text-dark"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
                <a href="profile.php" class="btn btn-outline-primary btn-sm">View Profile</a>
            </div>
        </div>
    </div>

    <!-- Quick Metric Card 2 -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center p-4">
                <h5 class="card-title text-muted">Digital Tickets</h5>
                <p class="card-text fs-4 fw-bold text-success">Active Pass Available</p>
                <a href="my_tickets.php" class="btn btn-success btn-sm">Access Pass Hub</a>
            </div>
        </div>
    </div>

    <!-- Quick Metric Card 3 -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center p-4">
                <h5 class="card-title text-muted">Need Support?</h5>
                <p class="card-text fs-4 fw-bold text-info">Contact Helpdesk</p>
                <a href="contact.php" class="btn btn-outline-info btn-sm">Submit Query</a>
            </div>
        </div>
    </div>
</div>

<?php
// Include shared footer
include_once 'includes/footer.php';
?>