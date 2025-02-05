<?php
// Include the Composer autoload file to load TCPDF from the 'vendor' folder
require_once('../vendor/autoload.php'); // Adjust this path based on your folder structure

// Database connection (using MySQLi)
require("../backend/server.php"); // Connect to database

if (isset($_GET['order_track_number'])) {
    $order_track_number = $_GET['order_track_number'];

    // Fetch order details using MySQLi
    $query = $conn->prepare("SELECT * FROM orders WHERE order_track_number = ?");
    $query->bind_param('s', $order_track_number); // 's' is for string parameter
    $query->execute();
    $result = $query->get_result(); // Get result from MySQLi query

    if ($result->num_rows === 0) {
        die("No orders found with this Order Track Number.");
    }

    // Fetch orders into an array
    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    // Store details
    $store_name = "My Store";
    $store_corp = "My Store Corporation";
    $store_address = "123 Main Street, City, Country";

    // Calculate totals
    $total = 0;
    $total_items = 0;
    foreach ($orders as $order) {
        $total += $order['total_price'];
        $total_items += $order['quantity'];
    }

    // // Get payment details (assuming one transaction per order track number)
    // $cash = $orders[0]['cash'];
    // $change = $orders[0]['change_amount'];

    // Create PDF
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);

    // Center alignment for the receipt title
    $pdf->Cell(0, 10, $store_name, 0, 1, 'C');
    $pdf->Cell(0, 10, $store_corp, 0, 1, 'C');
    $pdf->Cell(0, 10, $store_address, 0, 1, 'C');
    $pdf->Cell(0, 10, "OTN: " . $order_track_number, 0, 1, 'C');
    $pdf->Ln(5);
    $pdf->Cell(0, 10, "This serves as your sales invoice", 0, 1, 'C');
    $pdf->Ln(5);

    // Set X position to center
    $pdf->SetX(35);

    // Table Headers (No Borders)
    $pdf->Cell(60, 10, "Item", 0, 0, 'L');
    $pdf->Cell(30, 10, "Price", 0, 0, 'R');
    $pdf->Cell(20, 10, "Qty", 0, 0, 'R');
    $pdf->Cell(30, 10, "Total", 0, 1, 'R');

    // Set X position to center
    $pdf->SetX(35);
    $pdf->Cell(140, 0, str_repeat("-", 100), 0, 1, 'C'); // Separator line
    $pdf->Ln(2);

    // Table Data (No Borders)
    foreach ($orders as $order) {
        $pdf->SetX(35);
        $pdf->Cell(60, 10, "aa", 0, 0, 'L');
        $pdf->Cell(30, 10, "$" . 1, 0, 0, 'R');
        $pdf->Cell(20, 10, $order['quantity'], 0, 0, 'R');
        $pdf->Cell(30, 10, "$" . number_format($order['total_price'], 2), 0, 1, 'R');
    }

    // Separator
    $pdf->SetX(35);
    $pdf->Cell(140, 0, str_repeat("-", 100), 0, 1, 'C');
    $pdf->Ln(5);

    // Totals
    $pdf->SetX(35);
    $pdf->Cell(110, 10, "Total", 0, 0, 'L');
    $pdf->Cell(30, 10, "$" . 1, 0, 1, 'R');
    $pdf->SetX(35);
    $pdf->Cell(110, 10, "Cash", 0, 0, 'L');
    $pdf->Cell(30, 10, "$" . 1, 0, 1, 'R');
    $pdf->SetX(35);
    $pdf->Cell(110, 10, "Change", 0, 0, 'L');
    $pdf->Cell(30, 10, "$" . 1, 0, 1, 'R');
    $pdf->SetX(35);
    $pdf->Cell(110, 10, "Items Purchased", 0, 0, 'L');
    $pdf->Cell(30, 10, $total_items, 0, 1, 'R');
    $pdf->Ln();

    // Output PDF
    $pdf->Output("receipt_$order_track_number.pdf", 'D'); // 'D' forces download
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Receipt</title>
</head>
<body>
    <h2>Download Receipt</h2>
    <form method="GET" action="">
        <label for="order_track_number">Enter Order Track Number:</label>
        <input type="text" id="order_track_number" name="order_track_number" required>
        <button type="submit">Download Receipt</button>
    </form>
</body>
</html>
