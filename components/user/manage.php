<div class="pagetitle">
      <h1>Account</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item">Account</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Users</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Store</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>5050</td>
                    <td>Dale Rush</td>
                    <td>Chicoutimi</td>
                    <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal">View</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
      <?php include 'delete.php'; ?>
      <?php include 'view.php'; ?>
    </section>