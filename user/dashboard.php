<?php
$pageTitle = "Dashboard";
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
                            <a class="nav-link active" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">My Profile</a>
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
                            <i class="bi bi-person-fill me-1"></i> <span id="user-nav-username">Member</span> (<span id="user-nav-role">Role</span>)
                        </span>
                        <button onclick="logout()" class="btn btn-pill btn-crimson btn-sm">
                            <i class="bi bi-box-arrow-right me-1"></i> Sign Out
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    
    <h1 class="hero-title" id="dash-hero-title">Dashboard</h1>
    <p class="hero-subtitle" id="dash-hero-subtitle">Welcome back to LifeLine.</p>
</div>

<!-- ========================================== -->
<!-- DONOR DASHBOARD VIEW -->
<!-- ========================================== -->
<div id="donor-dashboard" style="display: none;" class="container overlap-container">
    <div class="row g-4">
        <!-- Sidebar Profile Card -->
        <div class="col-lg-4 d-flex flex-column">
            <div class="premium-card text-center h-100">
                <div class="mx-auto bg-danger text-white rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i class="bi bi-person-fill fs-1"></i>
                </div>
                
                <h3 class="font-heading mb-1" id="dash-fullname">Loading...</h3>
                <p class="text-secondary mb-3" id="dash-email">...</p>
                
                <span class="badge bg-danger rounded-pill px-3 py-2 mb-4 fs-6" id="dash-bloodtype">...</span>

                <hr class="my-4">
                
                <!-- Donor Info Grid -->
                <div class="row text-start g-3 mb-4">
                    <div class="col-6">
                        <small class="text-uppercase text-secondary font-weight-bold" style="font-size: 11px;">Donor Number</small>
                        <p class="mb-0 fw-bold text-dark" id="dash-donor-number">...</p>
                    </div>
                    <div class="col-6">
                        <small class="text-uppercase text-secondary font-weight-bold" style="font-size: 11px;">Phone</small>
                        <p class="mb-0 fw-bold text-dark" id="dash-phone">...</p>
                    </div>
                    <div class="col-12">
                        <small class="text-uppercase text-secondary font-weight-bold" style="font-size: 11px;">Registered Location</small>
                        <p class="mb-0 fw-bold text-dark" id="dash-location">...</p>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2">
                    <a href="profile.php" class="btn btn-pill btn-outline-crimson btn-sm"><i class="bi bi-pencil-square me-1"></i> Edit Profile</a>
                </div>
            </div>
        </div>

        <!-- Main Stats & Actions -->
        <div class="col-lg-8">
            <!-- Tabs -->
            <ul class="nav nav-tabs custom-tabs mb-4" id="donorTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="donor-overview-tab" data-bs-toggle="tab" data-bs-target="#donor-overview-panel" type="button" role="tab">Overview</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="donor-history-tab" data-bs-toggle="tab" data-bs-target="#donor-history-panel" type="button" role="tab">My Donation Logs</button>
                </li>
            </ul>

            <div class="tab-content" id="donorTabContent">
                <!-- Overview Panel -->
                <div class="tab-pane fade show active" id="donor-overview-panel" role="tabpanel">
                    <div class="row g-4 mb-4">
                        <!-- Stat Cards -->
                        <div class="col-sm-4">
                            <div class="premium-card text-center h-100">
                                <div class="card-title-icon"><i class="bi bi-droplet-half"></i></div>
                                <div class="stat-number" id="impact-count">0</div>
                                <div class="stat-label">Total Donations</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="premium-card text-center h-100">
                                <div class="card-title-icon"><i class="bi bi-funnel-fill"></i></div>
                                <div class="stat-number" id="impact-volume">0 ml</div>
                                <div class="stat-label">Volume Donated</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="premium-card text-center h-100">
                                <div class="card-title-icon"><i class="bi bi-award-fill"></i></div>
                                <div class="stat-number" id="impact-lives">0</div>
                                <div class="stat-label">Lives Saved</div>
                            </div>
                        </div>
                    </div>

                    <!-- Donation Eligibility Status Card -->
                    <div class="premium-card mb-4 position-relative overflow-hidden" id="eligibility-card" style="display: none;">
                        <div id="eligibility-badge" class="position-absolute" style="top: 24px; right: 24px; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold;"></div>
                        <div class="ps-3 border-start border-4" id="eligibility-container" style="border-color: #198754 !important;">
                            <small class="text-uppercase fw-bold" id="eligibility-subtitle" style="color: #198754; font-size: 12px; letter-spacing: 1px;">Donation Status</small>
                            <h2 class="font-heading my-2 text-dark" id="eligibility-title" style="font-size: 28px;">Checking Eligibility...</h2>
                            <p class="text-secondary mb-4" id="eligibility-desc" style="max-width: 80%; font-size: 14px;"></p>
                            <a href="../donation-camps.php" class="btn btn-pill btn-crimson px-4 py-2 fs-6" id="eligibility-btn">Find a Camp Near You</a>
                        </div>
                    </div>

                    <!-- Donation Impact Box & Options -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="premium-card h-100">
                                <h3 class="mb-3 font-heading text-dark border-bottom pb-2">Donation Impact Summary</h3>
                                <p class="text-secondary" style="font-size: 13px; line-height: 1.6;">
                                    Your blood donations act as a lifeline for clinical surgeries, accident victims, cancer patients, and pediatric operations across Sri Lanka. One bag of blood can help save up to 3 lives.
                                </p>
                                <div class="mt-4 pt-2 border-top">
                                    <small class="text-uppercase text-secondary fw-bold" style="font-size: 10px;">Last Donation Date</small>
                                    <p class="mb-0 text-danger fw-bold fs-5" id="impact-last-date">Never</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="premium-card h-100">
                                <h3 class="mb-3 font-heading text-dark border-bottom pb-2">Quick Access</h3>
                                <div class="d-flex flex-column gap-3">
                                    <a href="../donation-camps.php" class="p-3 border rounded-4 d-flex align-items-center gap-3 text-decoration-none text-dark hover-effect-light">
                                        <div class="fs-2 text-danger"><i class="bi bi-calendar-event"></i></div>
                                        <div>
                                            <h5 class="mb-1 font-heading" style="font-size: 15px;">Register for a Camp</h5>
                                            <small class="text-secondary" style="font-size: 12px;">Browse upcoming drives and reserve a slot.</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- History Panel -->
                <div class="tab-pane fade" id="donor-history-panel" role="tabpanel">
                    <div class="premium-card">
                        <h3 class="font-heading mb-4 text-dark border-bottom pb-2">Donation Logs</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Volume (ml)</th>
                                        <th>Hemoglobin (g/dL)</th>
                                        <th>Blood Pressure</th>
                                        <th>Weight (kg)</th>
                                    </tr>
                                </thead>
                                <tbody id="history-table-body">
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-secondary">
                                            <div class="spinner-border spinner-border-sm text-danger me-1"></div> Loading history logs...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- STAFF UPDATER (COMMAND CENTER) VIEW -->
<!-- ========================================== -->
<div id="updater-dashboard" style="display: none;" class="container overlap-container">
    <div class="row g-4">
        <!-- Left Column: Inventory & Visualizations -->
        <div class="col-lg-7">
            <!-- Physical Stock Adjustments -->
            <div class="premium-card mb-4">
                <h3 class="font-heading text-dark mb-3 border-bottom pb-2"><i class="bi bi-boxes text-danger me-2"></i>Physical Reserve Management</h3>
                <div id="inv-alert" class="alert alert-success" style="display: none;"></div>
                
                <form id="inventory-form">
                    <div class="row g-3 mb-4">
                        <div class="col-sm-3 col-6">
                            <label for="inv-oPos" class="form-label font-heading mb-1">O+ Stock</label>
                            <input type="number" class="form-control" id="inv-oPos" min="0" required>
                        </div>
                        <div class="col-sm-3 col-6">
                            <label for="inv-aPos" class="form-label font-heading mb-1">A+ Stock</label>
                            <input type="number" class="form-control" id="inv-aPos" min="0" required>
                        </div>
                        <div class="col-sm-3 col-6">
                            <label for="inv-bPos" class="form-label font-heading mb-1">B+ Stock</label>
                            <input type="number" class="form-control" id="inv-bPos" min="0" required>
                        </div>
                        <div class="col-sm-3 col-6">
                            <label for="inv-abPos" class="form-label font-heading mb-1">AB+ Stock</label>
                            <input type="number" class="form-control" id="inv-abPos" min="0" required>
                        </div>
                        
                        <div class="col-sm-3 col-6">
                            <label for="inv-oNeg" class="form-label font-heading mb-1">O- Stock</label>
                            <input type="number" class="form-control" id="inv-oNeg" min="0" required>
                        </div>
                        <div class="col-sm-3 col-6">
                            <label for="inv-aNeg" class="form-label font-heading mb-1">A- Stock</label>
                            <input type="number" class="form-control" id="inv-aNeg" min="0" required>
                        </div>
                        <div class="col-sm-3 col-6">
                            <label for="inv-bNeg" class="form-label font-heading mb-1">B- Stock</label>
                            <input type="number" class="form-control" id="inv-bNeg" min="0" required>
                        </div>
                        <div class="col-sm-3 col-6">
                            <label for="inv-abNeg" class="form-label font-heading mb-1">AB- Stock</label>
                            <input type="number" class="form-control" id="inv-abNeg" min="0" required>
                        </div>
                        
                        <div class="col-sm-6 col-12 mx-auto">
                            <label for="inv-platelets" class="form-label font-heading mb-1">Platelets Stock</label>
                            <input type="number" class="form-control text-center fw-bold text-danger border-danger" id="inv-platelets" min="0" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-pill btn-crimson w-100 py-2" id="inventory-submit-btn">
                        <span class="spinner-border spinner-border-sm me-1" id="inv-spinner" style="display: none;"></span>
                        Update Physical Inventory Counts
                    </button>
                </form>
            </div>

            <!-- Charts for verification -->
            <div class="row g-4 mb-4">
                <div class="col-md-7">
                    <div class="premium-card">
                        <h4 class="font-heading text-dark mb-3" style="font-size:16px;">Stock Adequacy Chart</h4>
                        <div style="position: relative; height: 230px;">
                            <canvas id="adequacyChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="premium-card">
                        <h4 class="font-heading text-dark mb-3" style="font-size:16px;">Rh Factor Share</h4>
                        <div style="position: relative; height: 230px;">
                            <canvas id="rhChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Log Donation Form -->
        <div class="col-lg-5">
            <div class="premium-card mb-4">
                <h3 class="font-heading text-dark mb-3 border-bottom pb-2"><i class="bi bi-journal-plus text-danger me-2"></i>Log New Donation</h3>
                <div id="donation-alert" class="alert alert-success" style="display: none;"></div>
                
                <form id="donation-form">
                    <div class="mb-3">
                        <label for="don-id" class="form-label mb-1">Donor Email or ID Number</label>
                        <input type="text" class="form-control" id="don-id" placeholder="johndoe@email.com or LL-0001" required>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="don-blood" class="form-label mb-1">Verified Blood Group</label>
                            <select class="form-select" id="don-blood" required>
                                <option value="" disabled selected>Blood Group</option>
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
                        <div class="col-6 mb-3">
                            <label for="don-volume" class="form-label mb-1">Volume Logged (ml)</label>
                            <input type="number" class="form-control" id="don-volume" placeholder="450" min="50" step="10" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="don-hemo" class="form-label mb-1">Hemoglobin (g/dL)</label>
                            <input type="number" class="form-control" id="don-hemo" placeholder="13.5" step="0.1" min="5" max="25">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="don-bp" class="form-label mb-1">Blood Pressure</label>
                            <input type="text" class="form-control" id="don-bp" placeholder="120/80">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="don-weight" class="form-label mb-1">Donor Weight (kg)</label>
                            <input type="number" class="form-control" id="don-weight" placeholder="70.5" step="0.1" min="30">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="don-date" class="form-label mb-1">Donation Date</label>
                            <input type="date" class="form-control" id="don-date" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="don-location" class="form-label mb-1">Logged Facility / Location</label>
                        <input type="text" class="form-control" id="don-location" placeholder="e.g. National Blood Center" required>
                    </div>

                    <button type="submit" class="btn btn-pill btn-crimson w-100 py-2 text-uppercase" id="donation-submit-btn">
                        <span class="spinner-border spinner-border-sm me-1" id="don-spinner" style="display: none;"></span>
                        Publish Donation Log
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Active Camps Scheduling & Urgent Requests -->
    <div class="row g-4">
        <!-- Active Camps List -->
        <div class="col-lg-8">
            <div class="premium-card">
                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                    <h3 class="font-heading text-dark mb-0"><i class="bi bi-calendar3 text-danger me-2"></i>Upcoming Camp Management</h3>
                    <button class="btn btn-pill btn-crimson btn-sm" data-bs-toggle="collapse" data-bs-target="#newCampCollapse">
                        <i class="bi bi-calendar-plus me-1"></i> Add Camp
                    </button>
                </div>
                
                <!-- Collapse Form for new camp -->
                <div class="collapse mb-4" id="newCampCollapse">
                    <div class="p-3 bg-light rounded-4 border">
                        <h4 class="font-heading mb-3" style="font-size:16px;">Schedule New Drive</h4>
                        <div id="camp-alert" class="alert alert-success" style="display: none;"></div>
                        
                        <form id="camp-form">
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label for="camp-name" class="form-label mb-1">Campaign Title Name</label>
                                    <input type="text" class="form-control" id="camp-name" required placeholder="Galle Face Mobile Drive">
                                </div>
                                <div class="col-sm-3">
                                    <label for="camp-date" class="form-label mb-1">Scheduled Date</label>
                                    <input type="date" class="form-control" id="camp-date" required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="camp-time" class="form-label mb-1">Start Time</label>
                                    <input type="time" class="form-control" id="camp-time" required>
                                </div>
                            </div>
                            
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label for="camp-loc" class="form-label mb-1">Physical Street Address / Location</label>
                                    <input type="text" class="form-control" id="camp-loc" required placeholder="Community Center, Galle">
                                </div>
                                <div class="col-sm-6">
                                    <label for="camp-org" class="form-label mb-1">Organizing Body / Hospital</label>
                                    <input type="text" class="form-control" id="camp-org" required placeholder="Galle Rotary Club">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="camp-desc" class="form-label mb-1">Campaign Details (Optional)</label>
                                <textarea class="form-control" id="camp-desc" rows="3" placeholder="Additional requirements..."></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-pill btn-crimson btn-sm text-uppercase" id="camp-submit-btn">
                                <span class="spinner-border spinner-border-sm me-1" id="camp-spinner" style="display: none;"></span>
                                Publish Campaign
                            </button>
                        </form>
                    </div>
                </div>

                <div id="camp-list-alert" class="alert alert-success" style="display: none;"></div>
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Campaign / Date</th>
                                <th>Location</th>
                                <th>Organizer</th>
                                <th>Roster (Registered)</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="camps-list-body"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Urgent Shortage Requests -->
        <div class="col-lg-4">
            <!-- Alert Request Form -->
            <div class="premium-card mb-4">
                <h3 class="font-heading text-dark mb-3 border-bottom pb-2" id="urgent-form-title"><i class="bi bi-exclamation-octagon text-danger me-2"></i>Add Urgent Request</h3>
                <div id="urgent-alert" class="alert" style="display: none;"></div>
                
                <form id="urgent-form">
                    <input type="hidden" id="urgent-id">
                    
                    <div class="mb-3">
                        <label for="urgent-blood" class="form-label mb-1">Demanded Blood Group</label>
                        <select class="form-select" id="urgent-blood" required>
                            <option value="" disabled selected>Select Group</option>
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
                    
                    <div class="mb-3">
                        <label for="urgent-hospital" class="form-label mb-1">Requester Hospital</label>
                        <input type="text" class="form-control" id="urgent-hospital" placeholder="National Hospital, Colombo" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="urgent-status" class="form-label mb-1">Status Severity</label>
                        <select class="form-select" id="urgent-status" required>
                            <option value="Critical Shortage">Critical Shortage</option>
                            <option value="Low Reserve Alert">Low Reserve Alert</option>
                        </select>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-pill btn-crimson w-100 py-2" id="urgent-submit-btn">
                            <span class="spinner-border spinner-border-sm me-1" id="urgent-spinner" style="display: none;"></span>
                            <span id="urgent-submit-text">Add Urgent Request</span>
                        </button>
                        <button type="button" class="btn btn-pill btn-outline-secondary btn-sm" id="urgent-cancel-btn" style="display: none;">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Shortage requests table -->
            <div class="premium-card">
                <h4 class="font-heading mb-3"><i class="bi bi-bell-fill text-danger me-2"></i>Active Shortages</h4>
                <div id="urgent-list-alert" class="alert alert-success" style="display: none;"></div>
                <div class="table-responsive">
                    <table class="table table-striped align-middle" style="font-size: 13px;">
                        <thead>
                            <tr>
                                <th>Group</th>
                                <th>Hospital</th>
                                <th>Severity</th>
                                <th class="text-end">Manage</th>
                            </tr>
                        </thead>
                        <tbody id="urgent-list-body"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- SHARED MODALS -->
<!-- ========================================== -->
<!-- Participants Roster Modal -->
<div class="modal fade" id="participantsModal" tabindex="-1" aria-labelledby="participantsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 24px; overflow: hidden; border: none; box-shadow: 0 25px 60px rgba(17,24,39,0.2);">
            <div class="modal-header bg-dark text-white p-4" style="background: linear-gradient(135deg, #111827 0%, #1f2937 100%) !important;">
                <h5 class="modal-title fw-bold mb-0" id="participantsModalLabel">Roster</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light-subtle">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Donor</th>
                                <th>Contact</th>
                                <th>Blood</th>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        <tbody id="participants-list-body"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    const user = auth.user;
    
    // Bind global navigation elements
    document.getElementById('user-nav-username').textContent = user.fullName.split(' ')[0];
    document.getElementById('user-nav-role').textContent = user.role.toUpperCase();
    
    if (user.role === 'updater' || user.role === 'admin') {
        // Toggle view
        document.getElementById('updater-dashboard').style.display = 'block';
        document.getElementById('dash-hero-title').textContent = "Command Center";
        document.getElementById('dash-hero-subtitle').textContent = "Log new medical donations, manage physical inventory reserves, and coordinate upcoming camps.";
        
        // Load Updater Script
        await initUpdaterDashboard();
    } else {
        // Default to donor dashboard view
        document.getElementById('donor-dashboard').style.display = 'block';
        document.getElementById('dash-hero-title').textContent = "Donor Dashboard";
        document.getElementById('dash-hero-subtitle').textContent = "Thank you for being a part of LifeLine. Here is your medical contribution summary.";
        
        // Load Donor Script
        await initDonorDashboard();
    }

    // ========================================================
    // DONOR LOGIC
    // ========================================================
    async function initDonorDashboard() {
        document.getElementById('dash-fullname').textContent = user.fullName;
        document.getElementById('dash-email').textContent = user.email;
        document.getElementById('dash-bloodtype').textContent = `Blood Group: ${user.bloodType}`;
        document.getElementById('dash-donor-number').textContent = user.donor_number || 'Pending';
        document.getElementById('dash-phone').textContent = user.phone;
        document.getElementById('dash-location').textContent = `${user.town}, ${user.district} District (${user.province} Province)`;

        // Fetch live donation summary stats via API
        try {
            const result = await apiFetch('api/donations.php');
            if (result.status === 'success') {
                const summary = result.summary;
                const donations = result.data;
                
                // Overview counts
                document.getElementById('impact-count').textContent = summary.total_donations;
                document.getElementById('impact-volume').textContent = summary.total_volume_ml + " ml";
                document.getElementById('impact-lives').textContent = summary.lives_saved_estimate;
                document.getElementById('impact-last-date').textContent = summary.last_donation_date ? summary.last_donation_date : 'Never';

                // Donation logs
                const historyBody = document.getElementById('history-table-body');
                historyBody.innerHTML = '';
                if (donations.length > 0) {
                    donations.forEach(d => {
                        const tr = document.createElement('tr');
                        const formattedDate = new Date(d.donation_date).toLocaleDateString('en-US', {
                            year: 'numeric', month: 'long', day: 'numeric'
                        });
                        tr.innerHTML = `
                            <td class="fw-bold">${formattedDate}</td>
                            <td>${d.location}</td>
                            <td><span class="badge bg-danger rounded-pill px-3">${d.volume_ml} ml</span></td>
                            <td>${d.hemoglobin ? d.hemoglobin + ' g/dL' : '-'}</td>
                            <td>${d.blood_pressure || '-'}</td>
                            <td>${d.weight ? d.weight + ' kg' : '-'}</td>
                        `;
                        historyBody.appendChild(tr);
                    });
                } else {
                    historyBody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-secondary">No donations logged yet.</td></tr>';
                }

                // Calculate eligibility (120-day interval)
                let isEligible = true;
                let daysDiff = 0;
                let daysRemaining = 0;
                
                if (summary.last_donation_date) {
                    const dateParts = summary.last_donation_date.split('-');
                    const year = parseInt(dateParts[0], 10);
                    const month = parseInt(dateParts[1], 10) - 1;
                    const day = parseInt(dateParts[2], 10);
                    const lastDate = new Date(year, month, day);
                    
                    const today = new Date();
                    today.setHours(0,0,0,0);
                    
                    const diffTime = today.getTime() - lastDate.getTime();
                    daysDiff = Math.round(diffTime / (1000 * 60 * 60 * 24));
                    
                    if (daysDiff < 120) {
                        isEligible = false;
                        daysRemaining = 120 - daysDiff;
                    }
                }

                const card = document.getElementById('eligibility-card');
                const container = document.getElementById('eligibility-container');
                const subtitle = document.getElementById('eligibility-subtitle');
                const title = document.getElementById('eligibility-title');
                const desc = document.getElementById('eligibility-desc');
                const badge = document.getElementById('eligibility-badge');
                const btn = document.getElementById('eligibility-btn');

                if (isEligible) {
                    container.style.borderColor = '#198754';
                    subtitle.style.color = '#198754';
                    title.textContent = "You are Eligible!";
                    badge.style.backgroundColor = '#e6f4ea';
                    badge.style.color = '#137333';
                    badge.innerHTML = '<i class="bi bi-check-lg"></i>';
                    
                    if (summary.last_donation_date) {
                        desc.textContent = `It has been over 120 days since your last donation (${daysDiff} days). You are fully recovered and safe to donate blood again.`;
                    } else {
                        desc.textContent = "You have not logged any blood donations yet. You are fully eligible and safe to make your first blood donation today!";
                    }
                    
                    btn.textContent = "Find a Camp Near You";
                    btn.href = "../donation-camps.php";
                } else {
                    container.style.borderColor = '#d97706';
                    subtitle.style.color = '#d97706';
                    title.textContent = "Not Eligible Yet";
                    badge.style.backgroundColor = '#fff7e6';
                    badge.style.color = '#b25e00';
                    badge.innerHTML = '<i class="bi bi-clock-fill"></i>';
                    
                    const lastDateObj = new Date(summary.last_donation_date);
                    const formattedLastDate = lastDateObj.toLocaleDateString('en-US', {
                        year: 'numeric', month: 'long', day: 'numeric'
                    });
                    
                    desc.textContent = `You last donated on ${formattedLastDate} (${daysDiff} days ago). Please wait another ${daysRemaining} days before you can donate blood again for your safety.`;
                    btn.textContent = "Find Camps (Browsing Mode)";
                    btn.href = "../donation-camps.php";
                }
                
                card.style.display = 'block';
            }
        } catch (e) {
            console.error('Failed to load donor impact statistics', e);
        }
    }

    // ========================================================
    // UPDATER / COMMAND CENTER LOGIC
    // ========================================================
    async function initUpdaterDashboard() {
        // Set defaults
        if (user.facility_name) {
            document.getElementById('don-location').value = user.facility_name;
        }
        document.getElementById('don-date').value = new Date().toISOString().substring(0, 10);
        document.getElementById('camp-date').value = new Date().toISOString().substring(0, 10);

        let currentInventory = {};
        let forecastDemand = {};
        
        let adequacyChartInstance = null;
        let rhChartInstance = null;

        await loadInventory();
        await loadForecastDemand();
        renderCharts();
        await loadCamps();
        await loadUrgentRequests();

        // Load DB inventory
        async function loadInventory() {
            try {
                const result = await apiFetch('api/inventory.php');
                if (result.status === 'success') {
                    currentInventory = result.data;
                    document.getElementById('inv-oPos').value = currentInventory.oPos;
                    document.getElementById('inv-aPos').value = currentInventory.aPos;
                    document.getElementById('inv-bPos').value = currentInventory.bPos;
                    document.getElementById('inv-abPos').value = currentInventory.abPos;
                    document.getElementById('inv-oNeg').value = currentInventory.oNeg;
                    document.getElementById('inv-aNeg').value = currentInventory.aNeg;
                    document.getElementById('inv-bNeg').value = currentInventory.bNeg;
                    document.getElementById('inv-abNeg').value = currentInventory.abNeg;
                    document.getElementById('inv-platelets').value = currentInventory.platelets;
                }
            } catch (e) {
                console.error('Failed to load inventory data', e);
            }
        }

        // Load Forecast Demand (CSV API)
        async function loadForecastDemand() {
            try {
                const result = await apiFetch('api/analytics.php');
                if (result.status === 'success') {
                    const forecastData = result.data.forecast;
                    forecastDemand = {
                        'oPos': forecastData['O+']?.month1 || 0,
                        'aPos': forecastData['A+']?.month1 || 0,
                        'bPos': forecastData['B+']?.month1 || 0,
                        'abPos': forecastData['AB+']?.month1 || 0,
                        'oNeg': forecastData['O-']?.month1 || 0,
                        'aNeg': forecastData['A-']?.month1 || 0,
                        'bNeg': forecastData['B-']?.month1 || 0,
                        'abNeg': forecastData['AB-']?.month1 || 0
                    };
                }
            } catch (e) {
                console.error('Failed to load forecast data', e);
            }
        }

        // Update inventory submission
        const invForm = document.getElementById('inventory-form');
        const invAlert = document.getElementById('inv-alert');
        const invSpinner = document.getElementById('inv-spinner');
        const invBtn = document.getElementById('inventory-submit-btn');

        function toInt(val) {
            return parseInt(val, 10) || 0;
        }

        invForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            invAlert.style.display = 'none';
            invSpinner.style.display = 'inline-block';
            invBtn.disabled = true;

            const payload = {
                oPos: toInt(document.getElementById('inv-oPos').value),
                aPos: toInt(document.getElementById('inv-aPos').value),
                bPos: toInt(document.getElementById('inv-bPos').value),
                abPos: toInt(document.getElementById('inv-abPos').value),
                oNeg: toInt(document.getElementById('inv-oNeg').value),
                aNeg: toInt(document.getElementById('inv-aNeg').value),
                bNeg: toInt(document.getElementById('inv-bNeg').value),
                abNeg: toInt(document.getElementById('inv-abNeg').value),
                platelets: toInt(document.getElementById('inv-platelets').value)
            };

            try {
                const result = await apiFetch('api/inventory.php', {
                    method: 'POST',
                    body: JSON.stringify(payload)
                });

                if (result.status === 'success') {
                    invAlert.textContent = "Physical inventory updated and verified.";
                    invAlert.style.display = 'block';
                    currentInventory = { ...currentInventory, ...payload };
                    renderCharts();
                }
            } catch (error) {
                alert("Error: " + error.message);
            } finally {
                invSpinner.style.display = 'none';
                invBtn.disabled = false;
            }
        });

        // Charts
        function renderCharts() {
            const barCtx = document.getElementById('adequacyChart').getContext('2d');
            const labels = ['O+', 'A+', 'B+', 'AB+', 'O-', 'A-', 'B-', 'AB-'];
            
            const values = [
                currentInventory.oPos || 0,
                currentInventory.aPos || 0,
                currentInventory.bPos || 0,
                currentInventory.abPos || 0,
                currentInventory.oNeg || 0,
                currentInventory.aNeg || 0,
                currentInventory.bNeg || 0,
                currentInventory.abNeg || 0
            ];

            const demands = [
                forecastDemand.oPos || 0,
                forecastDemand.aPos || 0,
                forecastDemand.bPos || 0,
                forecastDemand.abPos || 0,
                forecastDemand.oNeg || 0,
                forecastDemand.aNeg || 0,
                forecastDemand.bNeg || 0,
                forecastDemand.abNeg || 0
            ];

            const backgroundColors = values.map((val, idx) => {
                return val >= demands[idx] ? '#059669' : '#dc2626';
            });

            if (adequacyChartInstance) adequacyChartInstance.destroy();
            
            adequacyChartInstance = new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Physical Count',
                        data: values,
                        backgroundColor: backgroundColors,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });

            const donutCtx = document.getElementById('rhChart').getContext('2d');
            const posSum = (currentInventory.oPos || 0) + (currentInventory.aPos || 0) + (currentInventory.bPos || 0) + (currentInventory.abPos || 0);
            const negSum = (currentInventory.oNeg || 0) + (currentInventory.aNeg || 0) + (currentInventory.bNeg || 0) + (currentInventory.abNeg || 0);

            if (rhChartInstance) rhChartInstance.destroy();
            
            rhChartInstance = new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Rh Positive (+)', 'Rh Negative (-)'],
                    datasets: [{
                        data: [posSum, negSum],
                        backgroundColor: ['#e63946', '#111827'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        }

        // Log Donation Submission
        const donForm = document.getElementById('donation-form');
        const donAlert = document.getElementById('donation-alert');
        const donSpinner = document.getElementById('don-spinner');
        const donBtn = document.getElementById('donation-submit-btn');

        donForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            donAlert.style.display = 'none';
            donSpinner.style.display = 'inline-block';
            donBtn.disabled = true;

            const donor_id       = document.getElementById('don-id').value;
            const blood_type     = document.getElementById('don-blood').value;
            const volume_ml      = toInt(document.getElementById('don-volume').value);
            const hemoglobin     = document.getElementById('don-hemo').value ? parseFloat(document.getElementById('don-hemo').value) : null;
            const blood_pressure = document.getElementById('don-bp').value;
            const weight         = document.getElementById('don-weight').value ? parseFloat(document.getElementById('don-weight').value) : null;
            const donation_date  = document.getElementById('don-date').value;
            const location       = document.getElementById('don-location').value;

            try {
                const result = await apiFetch('api/donations.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        donor_id, blood_type, volume_ml, hemoglobin, blood_pressure, weight, donation_date, location
                    })
                });

                if (result.status === 'success') {
                    donAlert.className = "alert alert-success";
                    donAlert.innerHTML = `<strong>Success!</strong> Donation logged. Bag ID: <code>${result.data.bag_id}</code>.`;
                    donAlert.style.display = 'block';
                    donForm.reset();
                    document.getElementById('don-date').value = new Date().toISOString().substring(0, 10);
                    if (user.facility_name) {
                        document.getElementById('don-location').value = user.facility_name;
                    }
                    await loadInventory();
                    renderCharts();
                }
            } catch (error) {
                donAlert.className = "alert alert-danger";
                donAlert.textContent = error.message || "Failed to log donation.";
                donAlert.style.display = 'block';
            } finally {
                donSpinner.style.display = 'none';
                donBtn.disabled = false;
            }
        });

        // Camp published form submission
        const campForm = document.getElementById('camp-form');
        const campAlert = document.getElementById('camp-alert');
        const campSpinner = document.getElementById('camp-spinner');
        const campBtn = document.getElementById('camp-submit-btn');

        campForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            campAlert.style.display = 'none';
            campSpinner.style.display = 'inline-block';
            campBtn.disabled = true;

            const name        = document.getElementById('camp-name').value;
            const date        = document.getElementById('camp-date').value;
            const time        = document.getElementById('camp-time').value;
            const location    = document.getElementById('camp-loc').value;
            const organizer   = document.getElementById('camp-org').value;
            const description = document.getElementById('camp-desc').value;

            try {
                const result = await apiFetch('api/camps.php', {
                    method: 'POST',
                    body: JSON.stringify({ name, date, time, location, organizer, description })
                });

                if (result.status === 'success') {
                    campAlert.className = "alert alert-success";
                    campAlert.textContent = result.message;
                    campAlert.style.display = 'block';
                    campForm.reset();
                    document.getElementById('camp-date').value = new Date().toISOString().substring(0, 10);
                    await loadCamps();
                }
            } catch (error) {
                campAlert.className = "alert alert-danger";
                campAlert.textContent = error.message || "Failed to publish camp.";
                campAlert.style.display = 'block';
            } finally {
                campSpinner.style.display = 'none';
                campBtn.disabled = false;
            }
        });

        // Load Camps Table
        async function loadCamps() {
            const tbody = document.getElementById('camps-list-body');
            const alertList = document.getElementById('camp-list-alert');

            try {
                const result = await apiFetch('api/camps.php?action=all');
                if (result.status === 'success') {
                    tbody.innerHTML = '';
                    const camps = result.data;

                    if (camps.length > 0) {
                        camps.forEach(camp => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td>
                                    <strong>${escapeHtml(camp.name)}</strong><br>
                                    <small class="text-secondary"><i class="bi bi-calendar3 me-1"></i>${escapeHtml(camp.date)}</small>
                                </td>
                                <td>${escapeHtml(camp.location)}</td>
                                <td>${escapeHtml(camp.organizer)}</td>
                                <td>
                                    <span class="badge bg-danger rounded-pill px-3 py-2 cursor-pointer hover-effect-scale" onclick="openParticipantsModal(${camp.id}, '${escapeHtml(camp.name)}')">
                                        <i class="bi bi-people-fill me-1"></i> ${camp.registered_count || 0}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button onclick="deleteCamp(${camp.id})" class="btn btn-sm btn-outline-danger btn-pill">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            `;
                            tbody.appendChild(tr);
                        });
                    } else {
                        tbody.innerHTML = '<tr><td colspan="5" class="text-center py-3 text-secondary">No campaigns scheduled.</td></tr>';
                    }
                }
            } catch (e) {
                console.error(e);
            }
        }

        // Delete Camp
        window.deleteCamp = async function(campId) {
            if (!confirm("Are you sure you want to permanently delete this camp drive?")) return;
            try {
                const result = await apiFetch(`api/camps.php?id=${campId}`, { method: 'DELETE' });
                if (result.status === 'success') {
                    await loadCamps();
                }
            } catch (error) {
                alert(error.message || "Failed to delete campaign.");
            }
        };

        // Open roster modal
        window.openParticipantsModal = async function(campId, campName) {
            const titleEl = document.getElementById('participantsModalLabel');
            titleEl.innerHTML = `<i class="bi bi-people-fill text-danger me-2"></i>Roster: ${escapeHtml(campName)}`;
            const tbody = document.getElementById('participants-list-body');
            tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-secondary"><div class="spinner-border spinner-border-sm text-danger me-1"></div> Loading...</td></tr>';
            
            const modal = new bootstrap.Modal(document.getElementById('participantsModal'));
            modal.show();

            try {
                const result = await apiFetch(`api/camps.php?action=participants&id=${campId}`);
                if (result.status === 'success') {
                    tbody.innerHTML = '';
                    const list = result.data;
                    if (list.length > 0) {
                        list.forEach(p => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td>
                                    <strong>${escapeHtml(p.donor_number || 'Pending')}</strong><br>
                                    <span class="fw-semibold text-dark">${escapeHtml(p.fullName)}</span>
                                </td>
                                <td><small>${escapeHtml(p.email)}</small><br><small class="text-secondary">${escapeHtml(p.phone)}</small></td>
                                <td><span class="badge bg-danger rounded-pill px-2 py-1">${escapeHtml(p.bloodType)}</span></td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="att-switch-${p.registration_id}" ${parseInt(p.attended, 10) ? 'checked' : ''} onchange="toggleAttendance(this, ${p.registration_id})">
                                        <label class="form-check-label text-secondary" style="font-size: 12px;" for="att-switch-${p.registration_id}">Attended</label>
                                    </div>
                                </td>
                            `;
                            tbody.appendChild(tr);
                        });
                    } else {
                        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-secondary">No registrants.</td></tr>';
                    }
                }
            } catch (e) {
                console.error(e);
            }
        };

        // Attendance
        window.toggleAttendance = async function(checkbox, registrationId) {
            checkbox.disabled = true;
            const attended = checkbox.checked;
            try {
                await apiFetch('api/camps.php?action=toggle_attendance', {
                    method: 'POST',
                    body: JSON.stringify({ registration_id: registrationId, attended: attended })
                });
            } catch (e) {
                alert(e.message || "Failed to update attendance.");
                checkbox.checked = !attended;
            } finally {
                checkbox.disabled = false;
            }
        };

        // Urgent requests
        const urgentForm       = document.getElementById('urgent-form');
        const urgentAlert      = document.getElementById('urgent-alert');
        const urgentSpinner    = document.getElementById('urgent-spinner');
        const urgentSubmitBtn  = document.getElementById('urgent-submit-btn');
        const urgentSubmitText = document.getElementById('urgent-submit-text');
        const urgentCancelBtn  = document.getElementById('urgent-cancel-btn');
        const urgentFormTitle  = document.getElementById('urgent-form-title');
        const urgentListAlert  = document.getElementById('urgent-list-alert');

        async function loadUrgentRequests() {
            const tbody = document.getElementById('urgent-list-body');
            try {
                const result = await apiFetch('api/api.php?endpoint=urgent_requests');
                if (result.status === 'success') {
                    tbody.innerHTML = '';
                    const requests = result.data;

                    if (requests.length > 0) {
                        requests.forEach(req => {
                            const tr = document.createElement('tr');
                            const bg = req.blood_type;
                            const hospital = req.hospital_name;
                            const status = req.status_level;
                            const isCritical = status.toLowerCase().includes('critical');
                            
                            const circleColor = isCritical ? '#e63946' : '#ffb703';
                            const textColor = isCritical ? '#ffffff' : '#111827';
                            const badgeClass = isCritical ? 'bg-danger' : 'bg-warning text-dark';

                            tr.innerHTML = `
                                <td>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center font-heading fw-bold shadow-sm" 
                                         style="width: 40px; height: 40px; background-color: ${circleColor}; color: ${textColor}; font-size: 14px;">
                                        ${escapeHtml(bg)}
                                    </div>
                                </td>
                                <td><strong class="text-dark">${escapeHtml(hospital)}</strong></td>
                                <td><span class="badge rounded-pill px-3 py-2 ${badgeClass}">${escapeHtml(status)}</span></td>
                                <td class="text-end">
                                    <button onclick="editUrgentRequest(${req.id}, '${escapeHtml(bg)}', '${escapeHtml(hospital).replace(/'/g, "\\'")}', '${escapeHtml(status)}')" class="btn btn-sm btn-outline-primary btn-pill me-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button onclick="deleteUrgentRequest(${req.id})" class="btn btn-sm btn-outline-danger btn-pill" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            `;
                            tbody.appendChild(tr);
                        });
                    } else {
                        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-3 text-secondary">No shortages logged.</td></tr>';
                    }
                }
            } catch (e) {
                console.error(e);
            }
        }

        // Add / Edit Urgent Request
        urgentForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            urgentAlert.style.display = 'none';
            urgentSpinner.style.display = 'inline-block';
            urgentSubmitBtn.disabled = true;

            const id            = document.getElementById('urgent-id').value;
            const blood_type    = document.getElementById('urgent-blood').value;
            const hospital_name = document.getElementById('urgent-hospital').value;
            const status_level  = document.getElementById('urgent-status').value;

            const isEdit = id && parseInt(id) > 0;
            const url = 'api/api.php?endpoint=urgent_requests';
            const method = isEdit ? 'PUT' : 'POST';
            const bodyData = isEdit ? { id: parseInt(id), blood_type, hospital_name, status_level } : { blood_type, hospital_name, status_level };

            try {
                const result = await apiFetch(url, {
                    method: method,
                    body: JSON.stringify(bodyData)
                });

                if (result.status === 'success') {
                    urgentAlert.className = "alert alert-success";
                    urgentAlert.textContent = result.message;
                    urgentAlert.style.display = 'block';
                    resetUrgentForm();
                    await loadUrgentRequests();
                }
            } catch (error) {
                urgentAlert.className = "alert alert-danger";
                urgentAlert.textContent = error.message || "Failed to update request.";
                urgentAlert.style.display = 'block';
            } finally {
                urgentSpinner.style.display = 'none';
                urgentSubmitBtn.disabled = false;
            }
        });

        window.editUrgentRequest = function(id, blood_type, hospital_name, status_level) {
            urgentAlert.style.display = 'none';
            document.getElementById('urgent-id').value = id;
            document.getElementById('urgent-blood').value = blood_type;
            document.getElementById('urgent-hospital').value = hospital_name;
            document.getElementById('urgent-status').value = status_level;

            urgentFormTitle.innerHTML = `<i class="bi bi-pencil-square text-primary me-2"></i>Edit Urgent Request`;
            urgentSubmitText.textContent = "Save Changes";
            urgentCancelBtn.style.display = 'inline-block';
            
            urgentForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
        };

        urgentCancelBtn.addEventListener('click', resetUrgentForm);

        function resetUrgentForm() {
            urgentForm.reset();
            document.getElementById('urgent-id').value = '';
            urgentFormTitle.innerHTML = `<i class="bi bi-exclamation-octagon text-danger me-2"></i>Add Urgent Request`;
            urgentSubmitText.textContent = "Add Urgent Request";
            urgentCancelBtn.style.display = 'none';
            urgentAlert.style.display = 'none';
        }

        window.deleteUrgentRequest = async function(id) {
            if (!confirm("Are you sure you want to delete this shortage alert?")) return;
            try {
                const result = await apiFetch(`api/api.php?endpoint=urgent_requests&id=${id}`, { method: 'DELETE' });
                if (result.status === 'success') {
                    await loadUrgentRequests();
                }
            } catch (error) {
                alert(error.message || "Failed to delete request.");
            }
        };
    }

    // HTML Escaper Helper
    function escapeHtml(text) {
        if (text === null || text === undefined) return '';
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return String(text).replace(/[&<>"']/g, function(m) { return map[m]; });
    }
});
</script>

<style>
.hover-effect-light {
    transition: all 0.2s ease;
}
.hover-effect-light:hover {
    background-color: var(--color-surface);
    border-color: var(--color-crimson) !important;
}
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
