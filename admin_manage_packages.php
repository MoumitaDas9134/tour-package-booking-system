<?php
session_start();
include 'db.php';

// ✅ Only allow admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// ✅ Fetch all packages
$result = mysqli_query($conn, "SELECT * FROM packages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Packages</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f5f5;
            padding: 40px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        table {
            width: 95%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-edit {
            background-color: #27ae60;
        }
        .btn-delete {
            background-color: #e74c3c;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .msg {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<h2>🧳 Admin Panel - Manage Tour Packages</h2>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <p class="msg">✅ Package deleted successfully!</p>
<?php elseif (isset($_GET['msg']) && $_GET['msg'] == 'booked'): ?>
    <p class="msg error">❌ Cannot delete. This package has bookings!</p>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Location</th>
        <th>Price</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['location']) ?></td>
            <td>₹<?= $row['price'] ?></td>
            <td><?= ucfirst($row['status']) ?></td>
            <td>
                <a href="admin_edit_package.php?id=<?= $row['id'] ?>">
                    <button class="btn btn-edit">Edit</button>
                </a>
                <a href="admin_delete_package.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this package?');">
                    <button class="btn btn-delete">Delete</button>
                </a>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
