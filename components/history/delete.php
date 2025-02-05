<?php
require("../../backend/server.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Delete the product
    $sql = "DELETE FROM orders WHERE order_track_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../../admin/history.php");
    } else {
        header("Location: history.php");
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to the manage page if the request method is not POST
    header("Location: history.php");
}
?>