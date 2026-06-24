<?php
$pageTitle = "Edit Profile";
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
                            <a class="nav-link active" href="profile.php">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings.php">Settings</a>
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
    
    <h1 class="hero-title">Edit Profile</h1>
    <p class="hero-subtitle">Keep your contact and location details updated so we can reach you for matches.</p>
</div>

<div class="container overlap-container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="premium-card">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h3 class="font-heading text-dark mb-0"><i class="bi bi-person-gear text-danger me-2"></i>Profile Details</h3>
                    <a href="dashboard.php" class="btn btn-pill btn-outline-crimson btn-sm">Cancel</a>
                </div>

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

                    <!-- Sri Lankan Location Dropdowns -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="prof-province" class="form-label">Province</label>
                            <select class="form-select" id="prof-province" required>
                                <option value="" disabled>Select Province</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="prof-district" class="form-label">District</label>
                            <select class="form-select" id="prof-district" required>
                                <option value="" disabled>Select District</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="prof-town" class="form-label">Town / City</label>
                        <input type="text" class="form-control" id="prof-town" required>
                    </div>

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
    
    // Bind navigation username
    document.getElementById('user-nav-username').textContent = user.fullName.split(' ')[0];

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

    const provinceSelect = document.getElementById('prof-province');
    const districtSelect = document.getElementById('prof-district');

    // Populate Provinces
    for (let province in locationData) {
        let opt = document.createElement('option');
        opt.value = province;
        opt.textContent = province;
        provinceSelect.appendChild(opt);
    }

    // Function to populate districts dynamically
    function populateDistricts(province, selectedDistrict = '') {
        districtSelect.innerHTML = '<option value="" disabled>Select District</option>';
        if (province && locationData[province]) {
            locationData[province].forEach(district => {
                let opt = document.createElement('option');
                opt.value = district;
                opt.textContent = district;
                if (district === selectedDistrict) {
                    opt.selected = true;
                }
                districtSelect.appendChild(opt);
            });
        }
    }

    // Handle province change event
    provinceSelect.addEventListener('change', function() {
        populateDistricts(this.value);
    });

    // Pre-populate fields from current session user object
    document.getElementById('prof-name').value = user.fullName;
    document.getElementById('prof-email').value = user.email;
    document.getElementById('prof-phone').value = user.phone;
    document.getElementById('prof-town').value = user.town;

    // Pre-select province and populate corresponding district
    const userProvince = user.province;
    const userDistrict = user.district;

    for (let i = 0; i < provinceSelect.options.length; i++) {
        if (provinceSelect.options[i].value === userProvince) {
            provinceSelect.options[i].selected = true;
            break;
        }
    }
    populateDistricts(userProvince, userDistrict);

    // Form Submission
    const form = document.getElementById('profile-form');
    const alertBox = document.getElementById('profile-alert');
    const spinner = document.getElementById('profile-spinner');
    const btn = document.getElementById('profile-submit-btn');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        alertBox.style.display = 'none';
        spinner.style.display = 'inline-block';
        btn.disabled = true;

        const fullName = document.getElementById('prof-name').value;
        const phone    = document.getElementById('prof-phone').value;
        const province = document.getElementById('prof-province').value;
        const district = document.getElementById('prof-district').value;
        const town     = document.getElementById('prof-town').value;

        try {
            const result = await apiFetch(`api/api.php?endpoint=profile&id=${user.id}`, {
                method: 'PUT',
                body: JSON.stringify({ fullName, phone, province, district, town })
            });

            if (result.status === 'success') {
                // Update local storage session values
                user.fullName = fullName;
                user.phone = phone;
                user.province = province;
                user.district = district;
                user.town = town;
                localStorage.setItem('ll_user', JSON.stringify(user));

                alertBox.className = "alert alert-success";
                alertBox.textContent = "Profile details updated successfully!";
                alertBox.style.display = 'block';
                
                document.getElementById('user-nav-username').textContent = fullName.split(' ')[0];
            }
        } catch (error) {
            alertBox.className = "alert alert-danger";
            alertBox.textContent = error.message || "Failed to update profile details.";
            alertBox.style.display = 'block';
        } finally {
            spinner.style.display = 'none';
            btn.disabled = false;
        }
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
