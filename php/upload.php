<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // Vulnerable to malicious executable upload
    move_uploaded_file($file_tmp, "uploads/" . $file_name);
    echo "File uploaded successfully!";
}
?>

<form method="POST" enctype="multipart/form-data">
    File: <input type="file" name="file">
    <input type="submit" value="Upload">
</form>

