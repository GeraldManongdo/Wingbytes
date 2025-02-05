<?php
require("../../backend/server.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Get the image path
    $sql = "SELECT image FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    $stmt->fetch();
    $stmt->close();

    // Delete the image file
    if ($imagePath) {
        $file = "../../productImage/" . $imagePath;
        if (file_exists($file)) {
            unlink($file);
        }
    }

    // Delete the product
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../../admin/productList.php");
    } else {
        header("Location: manage.php");
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to the manage page if the request method is not POST
    header("Location: manage.php");
}
?>