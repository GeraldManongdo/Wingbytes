<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Wingbytes - User Manage</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>

    <?php include '../components/header.php'; ?>
    <?php include '../components/aside.php'; ?>

    <main id="main" class="main">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add user</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3">
            <div class="col-md-12">
                <label for="inputName5" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputName5">
            </div>
            <div class="col-md-6">
                <label for="inputEmail5" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail5">
            </div>
            <div class="col-md-6">
                <label for="inputPassword5" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword5">
            </div>
            <div class="col-12">
                <label for="inputAddress5" class="form-label">Address</label>
                <input type="text" class="form-control" id="inputAddres5s" placeholder="1234 Main St">
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Contact Number</label>
                <input type="number" class="form-control" id="inputAddress2" placeholder="09">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
            </form><!-- End Multi Columns Form -->

        </div>
        </div>

    </main>
    <?php include '../components/footer.php'; ?>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>
</html>