<?php
require("../../backend/server.php");

$orderTrackNumber = $_GET['order_track_number'] ?? '';

if ($orderTrackNumber) {
    $query = $conn->prepare("SELECT o.*, p.item, p.price FROM orders o 
                            JOIN products p ON o.product_id = p.id 
                            WHERE o.order_track_number = ?");
    $query->bind_param("s", $orderTrackNumber);
    $query->execute();
    $resultOrders = $query->get_result();

    if ($resultOrders->num_rows > 0) {
        $orders = $resultOrders->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "<p class='text-danger text-center'>No orders found for this tracking number.</p>";
        exit;
    }
} else {
    echo "<p class='text-danger text-center'>Invalid tracking number.</p>";
    exit;
}

// Calculate totals
$total = 0;
$totalItems = 0;
foreach ($orders as $order) {
    $total += $order['price'] * $order['quantity'];
    $totalItems += $order['quantity'];
}
?>


<div class="receipt">
    <h3 class="text-center"><strong>OTN:</strong> <?= htmlspecialchars($orderTrackNumber) ?></h3>

    <table class="table table-bordered">
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
        </tr>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['item']) ?></td>
                <td><?= $order['quantity'] ?></td>
                <td>$<?= number_format($order['price'] * $order['quantity'], 2) ?></td>
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

    <a href="../components/history/download_receipt.php?order_track_number=<?= htmlspecialchars($orderTrackNumber) ?>">
        <button class="btn btn-success w-100">Download Receipt (PDF)</button>
    </a>
</div>
