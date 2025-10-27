<?php
$cakeDescription = 'CakePHP: Hexagonal Architecture with DDD';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $cakeDescription ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
    <!-- Global Font Size Reduction -->
    <style>
        :root {
            --font-size-base: 0.875rem;
            --font-size-sm: 0.8125rem;
            --font-size-lg: 1rem;
        }
        
        * {
            font-size: var(--font-size-base) !important;
        }
        
        /* Headings */
        h1, .h1 { font-size: 1.75rem !important; }
        h2, .h2 { font-size: 1.5rem !important; }
        h3, .h3 { font-size: 1.25rem !important; }
        h4, .h4 { font-size: 1rem !important; }
        h5, .h5 { font-size: 0.875rem !important; }
        h6, .h6 { font-size: 0.8rem !important; }
        
        /* Body */
        body {
            font-size: 0.875rem !important;
            line-height: 1.4 !important;
        }
        
        /* Small text */
        small, .small { font-size: 0.8rem !important; }
        
        /* Buttons */
        .btn { font-size: 0.875rem !important; padding: 0.35rem 0.75rem !important; }
        .btn-sm { font-size: 0.8rem !important; padding: 0.25rem 0.5rem !important; }
        .btn-lg { font-size: 1rem !important; padding: 0.5rem 1rem !important; }
        
        /* Form controls */
        .form-control, .form-select { font-size: 0.875rem !important; padding: 0.4rem 0.75rem !important; }
        
        /* Table */
        .table { font-size: 0.875rem !important; }
        .table th { font-size: 0.85rem !important; }
        
        /* Navbar */
        .navbar { font-size: 0.875rem !important; }
        .nav-link { font-size: 0.875rem !important; padding: 0.5rem 0.75rem !important; }
        
        /* Cards */
        .card-header { font-size: 0.875rem !important; }
        .card-body { font-size: 0.875rem !important; }
        .card-title { font-size: 1rem !important; }
        
        /* Alerts */
        .alert { font-size: 0.875rem !important; padding: 0.75rem 1rem !important; }
        
        /* Modals */
        .modal-header { font-size: 0.875rem !important; }
        .modal-body { font-size: 0.875rem !important; }
        
        /* Breadcrumb */
        .breadcrumb { font-size: 0.85rem !important; }
        
        /* Badge */
        .badge { font-size: 0.8rem !important; }
        
        /* List items */
        li { font-size: 0.875rem !important; }
        
        /* Links */
        a { font-size: 0.875rem !important; }
    </style>
</head>
<body class="hold-transition">
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" style="z-index: 1030;">
    <div class="container-fluid">
        <ul class="navbar-nav ms-auto me-auto">
            <li class="nav-item">
                <a href="/" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="/users" class="nav-link">Users</a>
            </li>
        </ul>
    </div>
</nav>

<div class="wrapper">
    <div class="content-wrapper" style="margin-left: 0; margin-top: 70px;">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <strong>CakePHP</strong> Skeleton with Hexagonal Architecture &copy; 2025.
    </footer>
</div>

<!-- jQuery (required by AdminLTE) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap Bundle (includes Popper, required by AdminLTE) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- Initialize Bootstrap components -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Initialize modals (make sure modals can be triggered)
    var modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal) {
        var bootstrapModal = new bootstrap.Modal(modal);
    });
});
</script>
</body>
</html>
