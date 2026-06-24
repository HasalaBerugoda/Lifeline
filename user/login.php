<?php
$pageTitle = "Portal Sign In";
require_once __DIR__ . '/includes/header.php';
?>

<!-- Client-side Redirect if already logged in -->
<script>
if (localStorage.getItem('ll_token')) {
    window.location.href = 'dashboard.php';
}
</script>

<div class="hero-header">
    <h1 class="hero-title">LifeLine Access Portal</h1>
    <p class="hero-subtitle">Sign in to manage donations, schedule campaigns, or view analytics.</p>
</div>

<div class="container overlap-container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="premium-card">
                <h3 class="font-heading mb-4 text-center">Sign In to Portal</h3>
                <div id="login-alert" class="alert alert-danger" style="display: none;"></div>
                <form id="login-form">
                    <div class="mb-3">
                        <label for="login-email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="login-email" required placeholder="name@lifeline.lk">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="login-password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="login-password" required placeholder="Enter password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-pill btn-crimson w-100 py-3" id="login-submit-btn">
                        <span class="spinner-border spinner-border-sm me-1" id="login-spinner" style="display: none;"></span>
                        Sign In
                    </button>
                </form>
                <hr class="my-4">
                <div class="text-center">
                    <p class="text-secondary small mb-0">Don't have a donor account? <a href="register.php" class="text-danger fw-bold">Register as Donor</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('login-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;
    const btn = document.getElementById('login-submit-btn');
    const spinner = document.getElementById('login-spinner');
    const alertBox = document.getElementById('login-alert');

    btn.disabled = true;
    spinner.style.display = 'inline-block';
    alertBox.style.display = 'none';

    try {
        const data = await apiFetch('api/auth.php?action=login', {
            method: 'POST',
            body: JSON.stringify({ email, password })
        });

        if (data.status === 'success') {
            if (data.user.role === 'admin') {
                localStorage.setItem('ll_token', data.token);
                localStorage.setItem('ll_user', JSON.stringify(data.user));
                window.location.href = '../admin/dashboard.php';
            } else {
                localStorage.setItem('ll_token', data.token);
                localStorage.setItem('ll_user', JSON.stringify(data.user));
                window.location.href = 'dashboard.php';
            }
        } else {
            throw new Error(data.message || 'Login failed.');
        }
    } catch (err) {
        alertBox.textContent = err.message;
        alertBox.style.display = 'block';
    } finally {
        btn.disabled = false;
        spinner.style.display = 'none';
    }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
