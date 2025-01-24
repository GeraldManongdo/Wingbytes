<?php
require("../../database/server.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Prepare the SQL statement
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the manage page with a success message
        header("Location: ../../view/product.php");
    } else {
        // Redirect to the manage page with an error message
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