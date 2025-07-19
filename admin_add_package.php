<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Package</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #7F7FD5, #86A8E7, #91EAE4);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .form-container {
      background: #ffffff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      width: 450px;
      animation: fadeIn 0.7s ease-in-out;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #2c3e50;
    }

    input[type="text"],
    input[type="number"],
    textarea,
    select,
    input[type="file"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      outline: none;
    }

    input:focus,
    textarea:focus,
    select:focus {
      border-color: #3498db;
      box-shadow: 0 0 6px rgba(52, 152, 219, 0.4);
    }

    textarea {
      height: 100px;
      resize: vertical;
    }

    button {
      width: 100%;
      padding: 12px;
      background: #27ae60;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #219150;
    }

    .preview {
      text-align: center;
      margin-top: 15px;
    }

    .preview img {
      max-width: 100%;
      max-height: 200px;
      border-radius: 10px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="form-container">
    <form action="admin_save_package.php" method="POST" enctype="multipart/form-data">
      <h2>➕ Add New Tour Package</h2>

      <input type="text" name="title" placeholder="Title" required>
      <input type="text" name="location" placeholder="Location" required>
      <input type="number" name="price" placeholder="Price" required>
      <textarea name="description" placeholder="Description" required></textarea>

      <label>Status:</label>
      <select name="status" required>
        <option value="available">Available</option>
        <option value="unavailable">Unavailable</option>
      </select>

      <label>Upload Image:</label>
      <input type="file" name="image" accept="image/*" onchange="previewImage(event)" required>

      <div class="preview" id="imagePreview"></div>

      <button type="submit">💾 Save Package</button>
    </form>
  </div>

  <script>
    function previewImage(event) {
      const preview = document.getElementById('imagePreview');
      preview.innerHTML = '';

      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const img = document.createElement('img');
          img.src = e.target.result;
          preview.appendChild(img);
        }
        reader.readAsDataURL(file);
      }
    }
  </script>

</body>
</html>
