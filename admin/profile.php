<?php
$pageTitle = "Admin Profile";
$activePage = "profile";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/auth.php';
?>

<div class="hero-header">
    <?php require_once __DIR__ . '/includes/sidebar.php'; ?>
    <h1 class="hero-title">Admin Profile</h1>
    <p class="hero-subtitle">Manage your personal credentials and contact settings.</p>
</div>

<div class="container overlap-container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="premium-card">
                <h3 class="font-heading mb-4 text-dark border-bottom pb-2"><i class="bi bi-person-gear text-danger me-2"></i>Profile Details</h3>
                <div id="profile-alert" class="alert" style="display: none;"></div>
                <form id="profile-form">
                    <div class="mb-3">
                        <label for="prof-name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="prof-name" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="prof-email" class="form-label">Email Address (Read-Only)</label>
                            <input type="email" class="form-control bg-light" id="prof-email" readonly disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="prof-phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="prof-phone" required>
                        </div>
                    </div>

                    <input type="hidden" id="prof-province" value="Western">
                    <input type="hidden" id="prof-district" value="Colombo">
                    <input type="hidden" id="prof-town" value="Colombo">

                    <button type="submit" class="btn btn-pill btn-crimson w-100 py-3" id="profile-submit-btn">
                        <span class="spinner-border spinner-border-sm me-1" id="profile-spinner" style="display: none;"></span>
                        Save Profile Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    const user = auth.user;
    
    // Load existing profile details
    try {
        const result = await apiFetch(`api/api.php?endpoint=profile&id=${user.id}`);
        if (result.status === 'success') {
            const p = result.data;
            document.getElementById('prof-name').value = p.fullName;
            document.getElementById('prof-email').value = p.email;
            document.getElementById('prof-phone').value = p.phone;
        }
    } catch (e) {
        console.error("Failed to load profile details", e);
    }

    // Submit form handler
    document.getElementById('profile-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const fullName = document.getElementById('prof-name').value;
        const phone = document.getElementById('prof-phone').value;
        const province = document.getElementById('prof-province').value;
        const district = document.getElementById('prof-district').value;
        const town = document.getElementById('prof-town').value;
        
        const btn = document.getElementById('profile-submit-btn');
        const spinner = document.getElementById('profile-spinner');
        const alertBox = document.getElementById('profile-alert');
        
        btn.disabled = true;
        spinner.style.display = 'inline-block';
        alertBox.style.display = 'none';
        
        try {
            const result = await apiFetch(`api/api.php?endpoint=profile&id=${user.id}`, {
                method: 'PUT',
                body: JSON.stringify({ fullName, phone, province, district, town })
            });
            
            if (result.status === 'success') {
                alertBox.className = "alert alert-success";
                alertBox.textContent = result.message;
                alertBox.style.display = 'block';
                
                // Update local storage user data
                user.fullName = fullName;
                user.phone = phone;
                localStorage.setItem('ll_user', JSON.stringify(user));
                
                // Refresh top header nav user badge if any
                const spanName = document.getElementById('admin-nav-username');
                if (spanName) spanName.textContent = fullName.split(' ')[0];
            }
        } catch (error) {
            alertBox.className = "alert alert-danger";
            alertBox.textContent = error.message || "Failed to update profile.";
            alertBox.style.display = 'block';
        } finally {
            btn.disabled = false;
            spinner.style.display = 'none';
        }
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
