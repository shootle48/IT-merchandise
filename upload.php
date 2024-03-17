<?php
// **Security Recommendations:**
// - Implement input validation (e.g., using `filter_var()`) to prevent malicious code injection.
// - Validate allowed file types and extensions to mitigate potential vulnerabilities.
// - Configure file upload directory permissions securely (e.g., `755`).
// - Consider using prepared statements to prevent SQL injection vulnerabilities.

// Connect to database (replace with your credentials)
$db = new mysqli("localhost", "root", "", "it-merchandise");
if (!$db) {
    die ("Connection failed: " . mysqli_connect_error());
}

// Handle file upload (replace with your desired upload directory and security considerations)
if (isset ($_FILES["image"])) {
    $file = $_FILES["image"];
    $filename = $file["name"];

    // Validate file type and size (adjust limits based on your requirements)
    $allowed_types = ["image/jpg", "image/jpeg", "image/png", "image/gif"];
    if (!in_array($file["type"], $allowed_types)) {
        echo "Invalid file type.";
        exit;
    } elseif ($file["size"] > 104857600) { // 5MB limit (adjust if needed)
        echo "File size exceeds limit.";
        exit;
    }

    // Generate a unique filename and store in a secure directory
    $new_filename = uniqid() . "." . pathinfo($filename, PATHINFO_EXTENSION);
    $filepath = "image/" . $new_filename;

    // Move uploaded file to designated directory with security in mind
    if (!move_uploaded_file($file["tmp_name"], $filepath)) {
        echo "Error uploading file.";
        exit;
    }

    // Insert image path into database (store only the path, not the image itself)
    $stmt = $db->prepare("INSERT INTO product (image_path) VALUES (?)");
    $stmt->bind_param("s", $filepath);

    if ($stmt->execute()) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image: " . $db->error;
    }

    $stmt->close();
} else {
    echo "No image selected.";
}

$db->close();
?>