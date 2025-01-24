<div class="pagetitle">
  <h1>Product</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item">Product</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Item</h5>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Item</th>
                <th>Price</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              require("../backend/server.php");

              $sql = "SELECT id, image, item, price FROM products";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["id"] . "</td>";
                  echo "<td><img src='../productImage/" . $row["image"] . "' alt='' height='50' ></td>";
                  echo "<td>" . $row["item"] . "</td>";
                  echo "<td>" . $row["price"] . "</td>";
                  echo "<td><button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal' data-id='" . $row["id"] . "'>Delete</button></td>";
                  echo "</tr>";
                }
              } else {
                echo "<tr><td colspan='5'>No products found</td></tr>";
              }
              $conn->close();
              ?>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

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
          <form id="deleteForm" method="post" action="../components/product/delete.php">
            <input type="hidden" name="id" id="deleteId">
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var id = button.getAttribute('data-id');
      var deleteId = deleteModal.querySelector('#deleteId');
      deleteId.value = id;
    });
  });
</script>