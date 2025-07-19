
<?php
include 'db.php';
$id = $_POST['id'];
$title = $_POST['title'];
$location = $_POST['location'];
$price = $_POST['price'];
$description = $_POST['description'];
$status = $_POST['status'];

if ($_FILES['image']['name']) {
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "uploads/" . basename($image_name);
    move_uploaded_file($image_tmp, $image_path);

    $sql = "UPDATE packages SET title='$title', location='$location', price='$price',
            description='$description', status='$status', image='$image_path' WHERE id=$id";
} else {
    $sql = "UPDATE packages SET title='$title', location='$location', price='$price',
            description='$description', status='$status' WHERE id=$id";
}

mysqli_query($conn, $sql);
header("Location: admin_manage_packages.php");
?>
