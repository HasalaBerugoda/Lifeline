<?php
require_once __DIR__ . '/includes/db.php';
loadEnv();
$appUrl = $_ENV['APP_URL'] ?? 'http://localhost/LIFELINE';
?>
<!DOCTYPE html>
<html>
<head>
    <title>LifeLine Redirecting...</title>
    <script>
        const APP_URL = "<?php echo htmlspecialchars($appUrl); ?>";
        const token = localStorage.getItem('ll_token');
        const userJson = localStorage.getItem('ll_user');
        
        const base = APP_URL.endsWith('/') ? APP_URL : APP_URL + '/';
        
        if (token && userJson) {
            try {
                const user = JSON.parse(userJson);
                if (user.role === 'admin') {
                    window.location.href = base + 'admin/dashboard.php';
                } else {
                    window.location.href = base + 'user/dashboard.php';
                }
            } catch (e) {
                window.location.href = base + 'user/login.php';
            }
        } else {
            window.location.href = base + 'user/login.php';
        }
    </script>
</head>
<body>
    <p>Redirecting to portal... if you are not redirected, <a href="user/login.php">click here</a>.</p>
</body>
</html>
