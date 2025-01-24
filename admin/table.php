<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Wingbytes - Dashboard</title>
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

  <style>
    .grid-item {
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #000;
      margin: 5px;
      font-weight: bold;
    }
    #tableInformationContainer{
        display:none;
    }
  </style>
</head>
<body>

    <?php include '../components/header.php'; ?>
    <?php include '../components/aside.php'; ?>

    <main id="main" class="main">

    <section class="section">
      <div class="row">

        <div class="col-lg-12" id="tableContainer">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tables</h5>

              <div class="container d-flex justify-content-center align-items-center vh-90">
                        <div>
                        <div class="d-flex justify-content-end">
                            <button class="grid-item"  onclick="openModal()">5</button>
                            <button class="grid-item"  onclick="openModal()">11</button>
                        </div>
                        <div class="d-flex">
                            <button class="grid-item"  onclick="openModal()">1</button>
                            <button class="grid-item"  onclick="openModal()">3</button>
                            <button class="grid-item"  onclick="openModal()">6</button>
                            <button class="grid-item"  onclick="openModal()">12</button>
                        </div>
                        <div class="d-flex ">
                            <button class="grid-item"  onclick="openModal()">2</button>
                            <button class="grid-item"  onclick="openModal()">4</button>
                            <button class="grid-item"  onclick="openModal()">7</button>
                            <button class="grid-item"  onclick="openModal()">14</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="grid-item"  onclick="openModal()">8</button>
                            <button class="grid-item"  onclick="openModal()">15</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="grid-item"  onclick="openModal()">9</button>
                            <button class="grid-item"  onclick="openModal()">16</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="grid-item"  onclick="openModal()">10</button>
                        </div>
                        </div>
                    </div>

            </div>
          </div>

        </div>

        <div class="col-lg-5 " id="tableInformationContainer" data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Table Information</h5>
                            <ul>
                                <li>asdfas</li>
                                <li>asdfas</li>
                                <li>asdfas</li>
                                <li>asdfas</li>
                            </ul>
                            <hr>
                            <h6 class=" d-flex justify-content-end"><span class="bold">$ </span> 40</h6>


                        </div>
                        <div class="modal-footer m-1">
                            <button type="button" class="btn btn-secondary m-2" onclick="closecModal()">Close</button>
                            <button type="button" class="btn btn-primary m-2">Reciept</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>   
        </div>

      </div>
    </section>
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
    <script>
        function closecModal() {
            var tableContainer = document.getElementById("tableContainer");
            tableContainer.className = "col-lg-12"; 

            var tableInformationContainer = document.getElementById("tableInformationContainer");
            tableInformationContainer.style.display = 'none';
        }

        function openModal() {
            var tableContainer = document.getElementById("tableContainer");
            tableContainer.className = "col-lg-7"; 
        
            var tableInformationContainer = document.getElementById("tableInformationContainer");
            tableInformationContainer.style.display = 'block';
        }
    </script>

</body>
</html>