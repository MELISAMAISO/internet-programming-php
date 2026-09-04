<?php
require_once __DIR__ . '/auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Pass Manager - Premium Ticketing</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: #38bdf8 !important;
        }

        .card-custom {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.1);
        }

        .hero-banner {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 50%, #1e40af 100%);
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.3);
        }

        .badge-custom {
            border-radius: 8px;
            padding: 6px 12px;
            font-weight: 600;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Upgraded Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top py-3">
  <div class="container">
    <a class="navbar-brand text-white d-flex align-items-center gap-2" href="dashboard.php">
      <i class="bi bi-ticket-perforated-fill fs-4 text-info"></i>
      <span>Event Pass Manager</span>
    </a>
    
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center gap-lg-2 mt-3 mt-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php"><i class="bi bi-grid-1x2 me-1"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profile.php"><i class="bi bi-person-circle me-1"></i> Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="contact.php"><i class="bi bi-envelope me-1"></i> Support</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="submissions.php"><i class="bi bi-journal-text me-1"></i> Submissions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="my_tickets.php"><i class="bi bi-pass me-1"></i> Pass Hub</a>
        </li>
        <li class="nav-item ms-lg-2">
            <a class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1" href="logout.php">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-5 flex-grow-1">