<?php
$pageTitle = "Register as Donor";
require_once __DIR__ . '/includes/header.php';
?>

<!-- Client-side Redirect if already logged in -->
<script>
if (localStorage.getItem('ll_token')) {
    window.location.href = 'dashboard.php';
}
</script>

<div class="hero-header">
    <h1 class="hero-title">Join LifeLine</h1>
    <p class="hero-subtitle">Register as a donor in seconds. Save lives in your local community.</p>
</div>

<div class="container overlap-container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="premium-card">
                <h3 class="font-heading mb-4 text-center">Donor Registration</h3>
                <div id="register-alert" class="alert alert-danger" style="display: none;"></div>
                <form id="register-form">
                    <div class="mb-3">
                        <label for="reg-name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="reg-name" required placeholder="John Doe">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="reg-email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="reg-email" required placeholder="johndoe@email.com">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="reg-phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="reg-phone" required placeholder="+94 77 123 4567">
                        </div>
                    </div>
                    
                    <!-- Location Dropdowns (Sri Lanka Cascade) -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="reg-province" class="form-label">Province</label>
                            <select class="form-select" id="reg-province" required>
                                <option value="" disabled selected>Select Province</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="reg-district" class="form-label">District</label>
                            <select class="form-select" id="reg-district" required disabled>
                                <option value="" disabled selected>Select District</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="reg-town" class="form-label">Town / City</label>
                            <input type="text" class="form-control" id="reg-town" required placeholder="e.g. Maharagama">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="reg-bloodtype" class="form-label">Blood Group Type</label>
                            <select class="form-select" id="reg-bloodtype" required>
                                <option value="" disabled selected>Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="reg-password" class="form-label">Create Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control" id="reg-password" required placeholder="Choose a strong password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-pill btn-crimson w-100 py-3" id="register-submit-btn">
                        <span class="spinner-border spinner-border-sm me-1" id="register-spinner" style="display: none;"></span>
                        Register Account
                    </button>
                </form>
                <hr class="my-4">
                <div class="text-center">
                    <p class="text-secondary small mb-0">Already have an account? <a href="login.php" class="text-danger fw-bold">Sign In here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sri Lanka location data
    const locationData = {
        'Western': ['Colombo', 'Gampaha', 'Kalutara'],
        'Central': ['Kandy', 'Matale', 'Nuwara Eliya'],
        'Southern': ['Galle', 'Matara', 'Hambantota'],
        'Northern': ['Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu'],
        'Eastern': ['Trincomalee', 'Batticaloa', 'Ampara'],
        'North Western': ['Kurunegala', 'Puttalam'],
        'North Central': ['Anuradhapura', 'Polonnaruwa'],
        'Uva': ['Badulla', 'Monaragala'],
        'Sabagamuwa': ['Ratnapura', 'Kegalle']
    };

    const provinceSelect = document.getElementById('reg-province');
    const districtSelect = document.getElementById('reg-district');

    // Populate Provinces
    for (let province in locationData) {
        let opt = document.createElement('option');
        opt.value = province;
        opt.textContent = province;
        provinceSelect.appendChild(opt);
    }

    // Cascade districts
    provinceSelect.addEventListener('change', function() {
        const province = this.value;
        districtSelect.innerHTML = '<option value="" disabled selected>Select District</option>';
        
        if (locationData[province]) {
            locationData[province].forEach(d => {
                let opt = document.createElement('option');
                opt.value = d;
                opt.textContent = d;
                districtSelect.appendChild(opt);
            });
            districtSelect.disabled = false;
        } else {
            districtSelect.disabled = true;
        }
    });

    // Registration submission
    document.getElementById('register-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const fullName = document.getElementById('reg-name').value;
        const email = document.getElementById('reg-email').value;
        const phone = document.getElementById('reg-phone').value;
        const province = document.getElementById('reg-province').value;
        const district = document.getElementById('reg-district').value;
        const town = document.getElementById('reg-town').value;
        const bloodType = document.getElementById('reg-bloodtype').value;
        const password = document.getElementById('reg-password').value;

        const btn = document.getElementById('register-submit-btn');
        const spinner = document.getElementById('register-spinner');
        const alertBox = document.getElementById('register-alert');

        btn.disabled = true;
        spinner.style.display = 'inline-block';
        alertBox.style.display = 'none';

        try {
            const data = await apiFetch('api/auth.php?action=register', {
                method: 'POST',
                body: JSON.stringify({ fullName, email, phone, province, district, town, bloodType, password })
            });

            if (data.status === 'success') {
                localStorage.setItem('ll_token', data.token);
                localStorage.setItem('ll_user', JSON.stringify(data.user));
                window.location.href = 'dashboard.php';
            } else {
                throw new Error(data.message || 'Registration failed.');
            }
        } catch (err) {
            alertBox.textContent = err.message;
            alertBox.style.display = 'block';
        } finally {
            btn.disabled = false;
            spinner.style.display = 'none';
        }
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
