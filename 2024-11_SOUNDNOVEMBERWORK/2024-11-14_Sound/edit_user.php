
<style>
    /* Modal Custom Styling */
.modal-content {
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
}

.modal-header {
    background-color: #f7f7f7;
    border-bottom: 1px solid #e0e0e0;
    color: #333;
    font-weight: bold;
}

.modal-title {
    font-size: 1.5rem;
    color: #007bff;
}

.btn-close {
    background-color: #f1f1f1;
    border-radius: 50%;
    padding: 5px 10px;
    color: #007bff;
}

.modal-body {
    padding: 20px;
}

.form-label {
    font-weight: 600;
    color: #333;
    font-size: 1rem;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #ced4da;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
}

.form-select {
    border-radius: 8px;
    border: 1px solid #ced4da;
}

button[type="submit"] {
    background-color: #007bff;
    color: white;
    font-size: 1rem;
    padding: 10px 15px;
    border-radius: 8px;
    border: none;
    width: 100%;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Adjusting modal size for large screens */
@media (min-width: 768px) {
    .modal-dialog {
        max-width: 700px;
    }
}

@media (max-width: 767px) {
    .modal-dialog {
        max-width: 90%;
    }
}

</style>
<?php
include ('dbconnection.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch the user data based on the user_id
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "User not found.";
    }
} else {
    echo "No user ID specified.";
}
?>

<!-- Modal HTML structure -->

    
<div class="modal" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form id="editUserForm" method="POST" action="update_user.php">
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="username" value="<?php echo $row['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="editPassword" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editAddress" name="address" value="<?php echo $row['address']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="editPhone" name="phone" value="<?php echo $row['phone']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <select class="form-select" id="editRole" name="role">
                            <option value="User" <?php if ($row['role'] == 'User') echo 'selected'; ?>>User</option>
                            <option value="Editor" <?php if ($row['role'] == 'Editor') echo 'selected'; ?>>Editor</option>
                            <option value="Admin" <?php if ($row['role'] == 'Admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>




