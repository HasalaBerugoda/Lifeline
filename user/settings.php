<?php
$pageTitle = "My Settings";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/auth.php';
?>

<div class="hero-header">
    <!-- Navigation -->
    <div class="navbar-container">
        <nav class="navbar navbar-expand-lg glass-nav">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboard.php">
                    <i class="bi bi-droplet-fill text-danger"></i>
                    Life<span>Line</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar" aria-controls="userNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="userNavbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="settings.php">Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../donation-camps.php">Donation Camps</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../analytics.php">Analytics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../contact-us.php">Contact Us</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center gap-3">
                        <span class="nav-user-badge">
                            <i class="bi bi-person-fill me-1"></i> <span id="user-nav-username">Member</span>
                        </span>
                        <button onclick="logout()" class="btn btn-pill btn-crimson btn-sm">
                            <i class="bi bi-box-arrow-right me-1"></i> Sign Out
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    
    <h1 class="hero-title">Account Settings</h1>
    <p class="hero-subtitle">Review your account status and credentials configuration.</p>
</div>

<div class="container overlap-container">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-8">
            <div class="premium-card">
                <h3 class="font-heading mb-4 text-dark border-bottom pb-2"><i class="bi bi-shield-check text-danger me-2"></i>Account Configurations</h3>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="fw-bold bg-light" style="width: 250px;">Account Role Type</td>
                            <td><span class="badge bg-danger" id="set-role">Donor</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold bg-light">Donor Identity Number</td>
                            <td><code id="set-donor-num">Pending</code></td>
                        </tr>
                        <tr>
                            <td class="fw-bold bg-light">Registered Blood Type</td>
                            <td><span class="badge bg-danger rounded-pill px-3" id="set-bloodtype">...</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold bg-light">Assigned Hospital Facility</td>
                            <td id="set-facility">None (Applicable for staff updaters only)</td>
                        </tr>
                        <tr>
                            <td class="fw-bold bg-light">LifeLine Account Status</td>
                            <td><span class="badge bg-success">Active & Certified</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const user = auth.user;
    document.getElementById('user-nav-username').textContent = user.fullName.split(' ')[0];
    document.getElementById('set-role').textContent = user.role.toUpperCase();
    document.getElementById('set-donor-num').textContent = user.donor_number || 'Pending';
    document.getElementById('set-bloodtype').textContent = user.bloodType;
    document.getElementById('set-facility').textContent = user.facility_name || 'None (Applicable for staff updaters only)';
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
