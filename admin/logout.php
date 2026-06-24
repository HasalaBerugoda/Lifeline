<?php
$pageTitle = "Signing Out";
require_once __DIR__ . '/includes/header.php';
?>
<div class="hero-header">
    <h1 class="hero-title">Signing Out</h1>
    <p class="hero-subtitle">Please wait while we clear your secure session...</p>
</div>
<script>
    setTimeout(logout, 800);
</script>
<?php
require_once __DIR__ . '/includes/footer.php';
?>
