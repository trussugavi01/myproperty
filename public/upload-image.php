<?php
// Simple image upload script for the property
$targetDir = "../storage/app/public/properties/1/";
$targetFile = $targetDir . "featured-image.jpg";

// Create directory if it doesn't exist
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    
    // Check if image file is actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file has been uploaded successfully!<br>";
            echo "Image saved to: " . $targetFile . "<br>";
            echo '<a href="/">Go to Home</a>';
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Property Image</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .upload-form { border: 2px dashed #ccc; padding: 30px; text-align: center; }
        input[type="file"] { margin: 20px 0; }
        button { background: #007bff; color: white; padding: 10px 30px; border: none; cursor: pointer; font-size: 16px; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>Upload Featured Image for Luxury 4 Bedroom Duplex in Lekki</h1>
    <div class="upload-form">
        <form method="POST" enctype="multipart/form-data">
            <p>Select the property image to upload:</p>
            <input type="file" name="image" accept="image/*" required>
            <br>
            <button type="submit">Upload Image</button>
        </form>
    </div>
</body>
</html>
<?php
}
?>
