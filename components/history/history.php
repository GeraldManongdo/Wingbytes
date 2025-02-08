<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
require("../backend/server.php"); // Connect to database

// Fetch order tracking numbers
$sql = "SELECT MIN(id) AS id, order_track_number, MIN(order_date) AS order_date FROM orders GROUP BY order_track_number";
$result = $conn->query($sql);
?>
<div class="pagetitle">
  <h1>History</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item">History</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Documents</h5>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>Track Number</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                  <tr>
                    <td><?= htmlspecialchars($row["order_track_number"]) ?></td>
                    <td><?= htmlspecialchars($row["order_date"]) ?></td>
                    <td>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModalView"
                        onclick="showReceipt('<?= htmlspecialchars($row["order_track_number"]) ?>')">
                        View
                      </button>
                      <button type="button" class="btn btn-danger" onclick="showDeleteModal(this)"
                        data-id="<?= htmlspecialchars($row['order_track_number']) ?>">
                        Delete
                      </button>
                    </td>
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="3" class="text-center">No orders found</td>
                </tr>
              <?php endif; ?>
            </tbody>

          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
  <!-- Receipt Modal -->
  <div class="modal fade" id="largeModalView" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Receipt Information</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="receipt-info">
          <p class="text-center">Loading receipt details...</p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form id="deleteForm" method="post" action="../components/history/delete.php">
            <input type="hidden" name="id" id="deleteId">
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
  function showDeleteModal(button) {
    var deleteModal = document.getElementById('deleteModal');
    var id = button.getAttribute('data-id');
    var deleteId = deleteModal.querySelector('#deleteId');
    deleteId.value = id;
    var modal = new bootstrap.Modal(deleteModal);
    modal.show();
  }
  function showReceipt(orderTrackNumber) {
    $.ajax({
      url: "../components/history/fetch_receipt.php",
      type: "GET",
      data: { order_track_number: orderTrackNumber },
      success: function (response) {
        $("#receipt-info").html(response);
      },
      error: function () {
        $("#receipt-info").html("<p class='text-danger'>Error loading receipt details.</p>");
      }
    });
  }
</script>