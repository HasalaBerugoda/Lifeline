<?php
$adminNavItems = [
    'dashboard' => ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    'users' => ['label' => 'User Management', 'url' => 'users.php'],
    'profile' => ['label' => 'Admin Profile', 'url' => 'profile.php'],
    'settings' => ['label' => 'System Settings', 'url' => 'settings.php']
];
$activeKey = $activePage ?? '';
?>
<div class="navbar-container">
    <nav class="navbar navbar-expand-lg glass-nav">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="dashboard.php">
                <i class="bi bi-droplet-fill text-danger"></i>
                Life<span>Line</span> Admin
            </a>
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Links -->
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php foreach ($adminNavItems as $key => $item): 
                        $activeClass = ($activeKey === $key) ? 'active' : '';
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $activeClass; ?>" href="<?php echo htmlspecialchars($item['url']); ?>">
                                <?php echo htmlspecialchars($item['label']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                
                <!-- Auth Section -->
                <div class="d-flex align-items-center gap-3">
                    <span class="nav-user-badge">
                        <i class="bi bi-shield-lock-fill me-1"></i> <span id="admin-nav-username">Admin</span>
                    </span>
                    <button onclick="logout()" class="btn btn-pill btn-crimson btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i> Sign Out
                    </button>
                </div>
            </div>
        </div>
    </nav>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const userJson = localStorage.getItem('ll_user');
    if (userJson) {
        try {
            const user = JSON.parse(userJson);
            const spanName = document.getElementById('admin-nav-username');
            if (spanName && user.fullName) {
                spanName.textContent = user.fullName.split(' ')[0];
            }
        } catch (e) {
            console.error('Error parsing admin details in navbar', e);
        }
    }
});
</script>
