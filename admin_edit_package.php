<?php
include 'db.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM packages WHERE id = $id"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Package</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #a8edea, #fed6e3);
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .form-container {
      background: white;
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.15);
      width: 450px;
      animation: fadeIn 0.7s ease-in-out;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
    }

    input[type="text"],
    input[type="number"],
    textarea,
    select,
    input[type="file"] {
      width: 100%;
      padding: 12px 14px;
      margin: 12px 0 18px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
      outline: none;
      transition: 0.3s;
      resize: vertical;
    }

    input:focus,
    textarea:focus,
    select:focus {
      border-color: #2980b9;
      box-shadow: 0 0 8px rgba(41, 128, 185, 0.4);
    }

    textarea {
      height: 100px;
    }

    label {
      font-weight: 600;
      color: #34495e;
      display: block;
      margin-top: 10px;
    }

    img {
      border-radius: 10px;
      max-width: 100%;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    }

    button {
      width: 100%;
      padding: 14px;
      background-color: #27ae60;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #219150;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(-20px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Edit Package</h2>
  <form action="admin_update_package.php" method="POST" enctype="multipart/form-data" id="editPackageForm">
    <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

    <input type="text" name="title" value="<?= htmlspecialchars($data['title']) ?>" placeholder="Title" required>
    <input type="text" name="location" value="<?= htmlspecialchars($data['location']) ?>" placeholder="Location" required>
    <input type="number" name="price" value="<?= htmlspecialchars($data['price']) ?>" placeholder="Price" required>
    <textarea name="description" placeholder="Description" required><?= htmlspecialchars($data['description']) ?></textarea>

    <label>Status:</label>
    <select name="status" required>
      <option value="available" <?= $data['status'] == 'available' ? 'selected' : '' ?>>Available</option>
      <option value="unavailable" <?= $data['status'] == 'unavailable' ? 'selected' : '' ?>>Unavailable</option>
    </select>

    <label>Current Image:</label>
    <img src="<?= htmlspecialchars($data['image']) ?>" alt="Current Package Image" id="currentImage" width="150">

    <label>Change Image:</label>
    <input type="file" name="image" accept="image/*" onchange="previewNewImage(event)">

    <div style="text-align:center; margin-top:15px;">
      <img id="newImagePreview" style="display:none; max-width: 100%; max-height: 200px; border-radius: 10px; box-shadow: 0 5px 10px rgba(0,0,0,0.1);" alt="New Image Preview" />
    </div>

    <button type="submit">Update</button>
  </form>
</div>

<script>
  function previewNewImage(event) {
    const preview = document.getElementById('newImagePreview');
    const currentImg = document.getElementById('currentImage');
    const file = event.target.files[0];

    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
        currentImg.style.opacity = 0.4;  // dim current image
      }
      reader.readAsDataURL(file);
    } else {
      preview.style.display = 'none';
      preview.src = '';
      currentImg.style.opacity = 1;
    }
  }
</script>

</body>
</html>
