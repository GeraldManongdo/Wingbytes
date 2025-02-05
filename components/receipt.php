<?php
require("../backend/server.php"); // Connect to database

$orderTrackNumber = $_GET['order_track_number'] ?? '';

if ($orderTrackNumber) {
    $query = $conn->prepare("SELECT o.*, p.item, p.price FROM orders o JOIN products p ON o.product_id = p.id WHERE o.order_track_number = ?");
    $query->bind_param("i", $orderTrackNumber);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $orders = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $orders = [];
    }
} else {
    $orders = [];
}

// Calculate totals
$total = 0;
$totalItems = 0;
foreach ($orders as $order) {
    $total += $order['total_price'];
    $totalItems += $order['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 20px; }
        .receipt { width: 400px; margin: auto; border: 1px solid #ddd; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        input, button { padding: 10px; margin: 10px 0; width: 100%; }
    </style>
</head>
<body>

    <h2>Receipt Lookup</h2>
    <form method="GET">
        <input type="number" name="order_track_number" placeholder="Enter Order Track Number" required>
        <button type="submit">View Receipt</button>
    </form>

    <?php if ($orderTrackNumber && count($orders) > 0): ?>
        <div class="receipt">
            <h3>Store Name</h3>
            <p>Store Corporation</p>
            <p>Store Address</p>
            <p><strong>OTN:</strong> <?= htmlspecialchars($orderTrackNumber) ?></p>
            <p><em>This serves as your sales invoice</em></p>

            <table>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['item']) ?></td>
                        <td><?= $order['quantity'] ?></td>
                        <td>$<?= number_format($order['total_price'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><strong>Total</strong></td>
                    <td><strong>$<?= number_format($total, 2) ?></strong></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Cash</strong></td>
                    <td><strong>$<?= number_format($total, 2) ?></strong></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Change</strong></td>
                    <td><strong>$0.00</strong></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Items Purchased</strong></td>
                    <td><strong><?= $totalItems ?></strong></td>
                </tr>
            </table>

            <a href="download_receipt.php?order_track_number=<?= htmlspecialchars($orderTrackNumber) ?>">
                <button>Download Receipt (PDF)</button>
            </a>
        </div>
    <?php elseif ($orderTrackNumber): ?>
        <p style="color: red;">No orders found for this tracking number.</p>
    <?php endif; ?>

</body>
</html>
