<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
    <!-- HTML form for file upload -->
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Choose file to upload:</label>
        <input type="file" name="file" id="file" required>
        <input type="submit" name="submit" value="Upload">
    </form>

    <?php
    // PHP code to handle file upload
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Define the directory where files will be uploaded
        $uploadDir = __DIR__ . '/';

        // Get the uploaded file information
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);

        // Check if the file was uploaded without errors
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            echo "File has been uploaded successfully.";
        } else {
            echo "File upload failed.";
        }
    }
    ?>
</body>
</html>
