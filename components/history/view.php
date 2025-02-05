<?php
require("../backend/server.php"); // Connect to database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderTrackNumber = $_POST['id'] ?? '';

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
} 
?>


<style>
    /* body {
        font-family: Arial, sans-serif;
        text-align: center;
        margin: 20px;
    }

    .receipt {
        width: 400px;
        margin: auto;
        border: 1px solid #ddd;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f4f4f4;
    }

    input,
    button {
        padding: 10px;
        margin: 10px 0;
        width: 100%;
    } */
</style>

<div class="modal fade" id="largeModalView" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reciept Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="StudentEdit.php"><button type="submit" class="btn btn-primary">Edit Faculty</button></a>
            </div>
        </div>
    </div>
</div><!-- End Large Modal-->
