<?php
$pageTitle = "System Settings";
$activePage = "settings";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/auth.php';
?>

<div class="hero-header">
    <?php require_once __DIR__ . '/includes/sidebar.php'; ?>
    <h1 class="hero-title">System Settings</h1>
    <p class="hero-subtitle">Environment configurations and database state.</p>
</div>

<div class="container overlap-container">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-8">
            <div class="premium-card">
                <h3 class="font-heading mb-4"><i class="bi bi-gear-wide-connected text-danger me-2"></i>Global Settings</h3>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="fw-bold bg-light" style="width: 250px;">APP URL</td>
                            <td><code><?php echo htmlspecialchars($_ENV['APP_URL'] ?? ''); ?></code></td>
                        </tr>
                        <tr>
                            <td class="fw-bold bg-light">Database Host</td>
                            <td><code><?php echo htmlspecialchars($_ENV['DB_HOST'] ?? ''); ?></code></td>
                        </tr>
                        <tr>
                            <td class="fw-bold bg-light">Database Name</td>
                            <td><code><?php echo htmlspecialchars($_ENV['DB_DATABASE'] ?? ''); ?></code></td>
                        </tr>
                        <tr>
                            <td class="fw-bold bg-light">Database Username</td>
                            <td><code><?php echo htmlspecialchars($_ENV['DB_USERNAME'] ?? ''); ?></code></td>
                        </tr>
                        <tr>
                            <td class="fw-bold bg-light">Security Mode</td>
                            <td><span class="badge bg-success">JWT Authentication</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold bg-light">LifeLine Version</td>
                            <td><span class="badge bg-secondary">v1.2.0 (Premium)</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
