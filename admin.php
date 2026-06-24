<?php
require_once __DIR__ . '/includes/db.php';
loadEnv();
$appUrl = $_ENV['APP_URL'] ?? 'http://localhost/LIFELINE';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Redirecting...</title>
    <script>
        const APP_URL = "<?php echo htmlspecialchars($appUrl); ?>";
        const base = APP_URL.endsWith('/') ? APP_URL : APP_URL + '/';
        window.location.href = base + 'admin/dashboard.php';
    </script>
</head>
<body>
    <p>Redirecting to Admin Console... if not redirected, <a href="admin/dashboard.php">click here</a>.</p>
</body>
</html>
