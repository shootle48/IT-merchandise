<?php
$fname = $_GET['fname'];
$userID = $_GET['userID'];

$db = new mysqli("localhost", "root", "", "it-merchandise");
if (!$db) {
    die ("Connection failed: " . mysqli_connect_error());
}

if (isset ($_FILES["image"])) {
    $file = $_FILES["image"];
    $filename = $file["name"];

    $allowed_types = ["image/jpg", "image/jpeg", "image/png", "image/gif"];
    if (!in_array($file["type"], $allowed_types)) {
        echo "Invalid file type.";
        exit;
    } elseif ($file["size"] > 104857600) {
        echo "File size exceeds limit.";
        exit;
    }

    $new_filename = uniqid() . "." . pathinfo($filename, PATHINFO_EXTENSION);
    $filepath = "../admin/image/" . $new_filename;

    if (!move_uploaded_file($file["tmp_name"], $filepath)) {
        echo "Error uploading file.";
        exit;
    }

    // Update the slip for the specified user
    $stmt = $db->prepare("UPDATE bills SET slip = ? WHERE user_ID = ?");
    $stmt->bind_param("ss", $filepath, $userID);

    if ($stmt->execute()) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image: " . $db->error;
    }

    $stmt->close();
} else {
    echo "No image selected.";
}

// Redirect the user after processing
echo '<script>window.location = "bill.php?fname=' . $fname . '&userID=' . $userID . '"</script>';

$db->close();
?>