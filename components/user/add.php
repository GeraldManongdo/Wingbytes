<?php require("../backend/server.php"); ?>
<div class="pagetitle">
  <h1>Account</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../admin/dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item">Account</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Add user</h5>

        <!-- Multi Columns Form -->
        <form class="row g-3" method="POST" enctype="multipart/form-data>">
            <div class="col-md-12">
                <label for="inputName5" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputName5" name="name">
            </div>
            <div class="col-md-6">
                <label for="inputEmail5" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail5" name="email">
            </div>
            <div class="col-md-6">
                <label for="inputPassword5" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword5" name="password">
            </div>
            <div class="col-12">
                <label for="inputAddress5" class="form-label">Address</label>
                <input type="text" class="form-control" id="inputAddres5s" placeholder="" name="address">
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Contact Number</label>
                <input type="number" class="form-control" id="inputAddress2" placeholder="09" name="number">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form><!-- End Multi Columns Form -->

    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $access_level = 'staff';

    $sql = "INSERT INTO account (name, email, password, address, number, access_level ) VALUES ('$name', '$email', '$password', '$address', '$number', '$access_level')";
    if ($conn->query($sql) === TRUE) {
        echo "Account created successfully!.";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>