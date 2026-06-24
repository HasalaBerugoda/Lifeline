<?php
$pageTitle = "User Management";
$activePage = "users";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/auth.php';
?>

<div class="hero-header">
    <?php require_once __DIR__ . '/includes/sidebar.php'; ?>
    <h1 class="hero-title">User Registry</h1>
    <p class="hero-subtitle">Review credentials, roles, and revoke privileges.</p>
</div>

<div class="container overlap-container">
    <div class="row">
        <div class="col-12">
            <div class="premium-card">
                <h3 class="font-heading mb-4"><i class="bi bi-people-fill text-danger me-2"></i>Accounts Register</h3>
                <div id="users-alert" class="alert alert-success" style="display: none;"></div>
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Donor Num / Name</th>
                                <th>Contact Email / Phone</th>
                                <th>Blood</th>
                                <th>Role Authority</th>
                                <th>Facility (Updaters Only)</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="users-table-body">
                            <tr>
                                <td colspan="6" class="text-center py-4 text-secondary">
                                    <div class="spinner-border spinner-border-sm text-danger me-1"></div> Loading user registry...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    const adminUser = auth.user;
    await loadUsers();

    // ----------------------------------------------------
    // Load All Users
    // ----------------------------------------------------
    async function loadUsers() {
        const tbody = document.getElementById('users-table-body');
        try {
            const result = await apiFetch('api/api.php?endpoint=users');
            if (result.status === 'success') {
                tbody.innerHTML = '';
                const users = result.data;

                function toInt(val) {
                    return parseInt(val, 10) || 0;
                }

                users.forEach(u => {
                    const tr = document.createElement('tr');
                    const isSelf = toInt(u.id) === toInt(adminUser.id);
                    const isUpdater = u.role === 'updater';
                    
                    tr.innerHTML = `
                        <td>
                            <strong>${u.donor_number || 'Pending'}</strong><br>
                            <span class="text-dark fw-bold">${u.fullName}</span>
                            ${isSelf ? '<span class="badge bg-secondary ms-1">You</span>' : ''}
                        </td>
                        <td>
                            <small>${u.email}</small><br>
                            <small class="text-secondary">${u.phone}</small>
                        </td>
                        <td><span class="badge bg-danger rounded-pill">${u.bloodType}</span></td>
                        <td>
                            <select onchange="onRoleChange(this, ${u.id})" class="form-select form-select-sm" style="width: 120px;">
                                <option value="donor" ${u.role === 'donor' ? 'selected' : ''}>Donor</option>
                                <option value="updater" ${u.role === 'updater' ? 'selected' : ''}>Updater</option>
                                <option value="admin" ${u.role === 'admin' ? 'selected' : ''}>Admin</option>
                                <option value="revoked" ${u.role === 'revoked' ? 'selected' : ''}>Revoked</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" 
                                   id="facility-${u.id}" 
                                   value="${u.facility_name || ''}" 
                                   class="form-control form-control-sm" 
                                   placeholder="Hospital name" 
                                   style="width: 180px;"
                                   ${isUpdater ? '' : 'disabled'}>
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <button onclick="saveUserRole(${u.id}, this)" class="btn btn-sm btn-crimson btn-pill" title="Save role modifications">
                                    <i class="bi bi-save"></i>
                                </button>
                                <button onclick="deleteUser(${u.id})" class="btn btn-sm btn-outline-danger btn-pill" ${isSelf ? 'disabled title="You cannot delete yourself"' : ''}>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }
        } catch (e) {
            console.error('Failed to load users', e);
            tbody.innerHTML = `<tr><td colspan="6" class="text-center text-danger py-4">Failed to load user records.</td></tr>`;
        }
    }

    // Dropdown change handler to toggle facility input box
    window.onRoleChange = function(selectEl, userId) {
        const facilityInput = document.getElementById(`facility-${userId}`);
        if (selectEl.value === 'updater') {
            facilityInput.removeAttribute('disabled');
        } else {
            facilityInput.value = '';
            facilityInput.setAttribute('disabled', 'true');
        }
    };

    // Save User Role Details API
    window.saveUserRole = async function(userId, btn) {
        const selectEl = btn.closest('tr').querySelector('select');
        const facilityInput = document.getElementById(`facility-${userId}`);
        const alertBox = document.getElementById('users-alert');
        alertBox.style.display = 'none';

        const role = selectEl.value;
        const facility_name = facilityInput.value;

        btn.setAttribute('disabled', 'true');

        try {
            const result = await apiFetch('api/api.php?endpoint=users', {
                method: 'PUT',
                body: JSON.stringify({ id: userId, role, facility_name })
            });

            if (result.status === 'success') {
                alertBox.className = "alert alert-success";
                alertBox.textContent = result.message;
                alertBox.style.display = 'block';
                
                await loadUsers(); // Reload to refresh states
            }
        } catch (error) {
            alert(error.message || "Failed to update user authority.");
        } finally {
            btn.removeAttribute('disabled');
        }
    };

    // Delete User account API
    window.deleteUser = async function(userId) {
        if (!confirm("Are you sure you want to permanently delete this user account? This will delete all their donation logs and registrations. This cannot be undone.")) {
            return;
        }

        const alertBox = document.getElementById('users-alert');
        alertBox.style.display = 'none';

        try {
            const result = await apiFetch(`api/api.php?endpoint=users&id=${userId}`, {
                method: 'DELETE'
            });

            if (result.status === 'success') {
                alertBox.className = "alert alert-success";
                alertBox.textContent = result.message;
                alertBox.style.display = 'block';

                await loadUsers();
            }
        } catch (error) {
            alertBox.className = "alert alert-danger";
            alertBox.textContent = error.message || "Failed to delete user.";
            alertBox.style.display = 'block';
        }
    };
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
