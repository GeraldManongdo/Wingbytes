<?php require("../backend/server.php"); ?>

<div class="pagetitle">
  <h1>Product</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../admin/dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item">Product</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Add Product</h5>

        <!-- Multi Columns Form -->
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-12">
                <label for="inputName5" class="form-label">Item</label>
                <input type="text" class="form-control" id="inputName5" name="item" required>
            </div>
            <div class="col-12">
                <label for="inputAddress5" class="form-label">Price</label>
                <input type="number" class="form-control" id="inputAddress5" name="price" required>
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Image</label>
                <input type="file" class="form-control" id="inputAddress2" name="image" accept="image/*" required>
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
    $item = $_POST['item'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "../productImage/" . basename($image);

    $sql = "INSERT INTO products (item, price, image) VALUES ('$item', '$price', '$image')";

    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Product added successfully.";
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>