<?php
include 'db.php';

$sql = "SELECT b.id, b.name, b.email, b.booking_date, p.title AS package_name
        FROM bookings b
        JOIN packages p ON b.package_id = p.id
        ORDER BY b.id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>All Bookings</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f4f8;
      margin: 20px;
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 25px;
    }

    table {
      border-collapse: collapse;
      width: 90%;
      max-width: 1000px;
      margin: 0 auto 50px;
      background: white;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 14px 18px;
      text-align: left;
      border-bottom: 1px solid #e1e8f0;
    }

    th {
      background-color: #3498db;
      color: white;
      cursor: default;
      user-select: none;
    }

    tr:hover {
      background-color: #f6faff;
    }

    td:last-child {
      text-align: center;
    }

    .btn-delete {
      background-color: #e74c3c;
      border: none;
      color: white;
      padding: 7px 14px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .btn-delete:hover {
      background-color: #c0392b;
    }

    @media (max-width: 700px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead tr {
        display: none;
      }
      tr {
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        padding: 15px;
        background: white;
      }
      td {
        padding-left: 50%;
        position: relative;
        text-align: right;
        border-bottom: 1px solid #e1e8f0;
      }
      td::before {
        position: absolute;
        left: 15px;
        width: 45%;
        white-space: nowrap;
        font-weight: bold;
        text-align: left;
        content: attr(data-label);
      }
      td:last-child {
        text-align: center;
        padding-left: 15px;
      }
    }
  </style>
  <script>
    function confirmDelete(id) {
      if (confirm("Are you sure you want to delete booking #" + id + "?")) {
        window.location.href = 'admin_delete_booking.php?id=' + id;
      }
    }
  </script>
</head>
<body>

<h2>All Bookings</h2>

<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Client Name</th>
      <th>Email</th>
      <th>Package</th>
      <th>Booking Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td data-label='#'>" . $row['id'] . "</td>";
      echo "<td data-label='Client Name'>" . htmlspecialchars($row['name']) . "</td>";
      echo "<td data-label='Email'>" . htmlspecialchars($row['email']) . "</td>";
      echo "<td data-label='Package'>" . htmlspecialchars($row['package_name']) . "</td>";
      echo "<td data-label='Booking Date'>" . $row['booking_date'] . "</td>";
      echo "<td data-label='Action'><button class='btn-delete' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button></td>";
      echo "</tr>";
    }
  ?>
  </tbody>
</table>

</body>
</html>
