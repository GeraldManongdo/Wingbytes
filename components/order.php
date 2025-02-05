<?php
require("../backend/server.php"); // Connect to database

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {
    try {
        // Generate order_track_number (Get the last order_track_number and increment it)
        $trackQuery = $conn->query("SELECT MAX(order_track_number) AS last_track FROM orders");
        $lastTrack = $trackQuery->fetch_assoc()['last_track'] ?? 1000; // Default starts at 1000
        $newTrackNumber = $lastTrack + 1;

        foreach ($data as $item) {
            $query = $conn->prepare("INSERT INTO orders (product_id, quantity, total_price, table_number, order_track_number) VALUES (?, ?, ?, ?, ?)");
            $query->bind_param("iidii", $item['id'], $item['quantity'], $total, $table_number, $newTrackNumber);

            // Calculate total price
            $total = $item['quantity'] * $item['price'];
            $table_number = $item['table_number'] ?? 1; // Default table number 1 if not provided

            if (!$query->execute()) {
                echo json_encode(['status' => 'error', 'message' => $query->error]);
                exit;
            }
        }
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);

}
?>