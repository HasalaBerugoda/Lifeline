<!-- Footer section -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4 mb-md-0">
                <h5 class="font-heading"><i class="bi bi-droplet-fill text-danger me-1"></i>LifeLine</h5>
                <p class="text-white-50" style="max-width: 400px;">
                    LifeLine is a state-of-the-art blood bank management system facilitating swift donations, real-time inventory metrics, and automated camps coordination.
                </p>
                <div class="d-flex gap-3 fs-5 mt-3">
                    <a href="#" class="text-white-50"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white-50"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-white-50"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white-50"><i class="bi bi-github"></i></a>
                </div>
            </div>
            
            <div class="col-md-3 mb-4 mb-md-0">
                <h5 class="font-heading">Quick Links</h5>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li><a href="<?php echo htmlspecialchars($appUrl); ?>/home.php">Home</a></li>
                    <li><a href="<?php echo htmlspecialchars($appUrl); ?>/donation-camps.php">Donation Camps</a></li>
                    <li><a href="<?php echo htmlspecialchars($appUrl); ?>/contact-us.php">Contact Us</a></li>
                    <li><a href="<?php echo htmlspecialchars($appUrl); ?>/user/login.php">Portal Login</a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h5 class="font-heading">Member Portal</h5>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li><a href="<?php echo htmlspecialchars($appUrl); ?>/user/dashboard.php">My Dashboard</a></li>
                    <li><a href="<?php echo htmlspecialchars($appUrl); ?>/user/profile.php">My Profile</a></li>
                    <li><a href="<?php echo htmlspecialchars($appUrl); ?>/user/settings.php">My Settings</a></li>
                    <li class="text-white-50"><i class="bi bi-geo-alt me-1"></i>Colombo, Sri Lanka</li>
                </ul>
            </div>
        </div>
        <hr class="my-4 border-secondary opacity-25">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-white-50">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> LifeLine Blood Bank. All rights reserved.</p>
            <p class="mb-0">Built with <i class="bi bi-heart-fill text-danger"></i> in Sri Lanka.</p>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
