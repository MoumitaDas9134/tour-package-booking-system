<?php
session_start();
include 'db.php';

// ✅ Ensure only admin can access
if (!isset($_SESSION['admin'])) {
    echo "Access denied. Please login as admin.";
    exit;
}

// ✅ Validate package ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // ❗ Prevent deleting if the package is already booked
    $check = mysqli_query($conn, "SELECT * FROM bookings WHERE package_id = $id");
    if (mysqli_num_rows($check) > 0) {
        header("Location: admin_manage_packages.php?msg=booked");
        exit;
    }

    // ✅ Perform deletion
    $delete = mysqli_query($conn, "DELETE FROM packages WHERE id = $id");

    if ($delete) {
        header("Location: admin_manage_packages.php?msg=deleted");
        exit;
    } else {
        echo "❌ Error: " . mysqli_error($conn);
    }
} else {
    echo "❌ Invalid package ID.";
}
?>
