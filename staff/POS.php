<?php
require("../backend/server.php");


?>

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
</head>
<style>
        .product { display: inline-block; margin: 10px; padding: 10px; border: 1px solid #ccc; text-align: center; }
        .cart { margin-top: 20px; }
</style>
<body>

    <?php include '../components/header.php'; ?>
    <?php include 'layout/aside.php'; ?>

    <main id="main" class="main">
    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
            <h1>Point of Sale System</h1>

            <div>
                <h2>Products</h2>

                <?php
                require("../backend/server.php");

                $sql = "SELECT id, item, price FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="product">
                            <p><strong><?php echo htmlspecialchars($row['item']); ?></strong></p>
                            <p>Price: $<?php echo number_format($row['price'], 2); ?></p>
                            <button onclick="addToCart(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['item']); ?>', <?php echo $row['price']; ?>)">Add to Cart</button>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No products found</p>";
                }

                $conn->close();
                ?>
            </div>

        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
            
            <div class="cart">
                <h2>Cart</h2>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items"></tbody>
                </table>
                <button onclick="placeOrder()">Buy</button>
            </div> 
        

        </div><!-- End Right side columns -->

      </div>
    </section>


   

    <script>
        let cart = [];

        function addToCart(id, name, price) {
            const product = cart.find(item => item.id === id);
            if (product) {
                product.quantity++;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }
            updateCart();
        }

        function updateCart() {
            const cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';
            cart.forEach(item => {
                cartItems.innerHTML += `
                    <tr>
                        <td>${item.name}</td>
                        <td>${item.quantity}</td>
                        <td>$${(item.quantity * item.price).toFixed(2)}</td>
                        <td><button onclick="removeFromCart(${item.id})">Remove</button></td>
                    </tr>
                `;
            });
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            updateCart();
        }

        function placeOrder() {
            if (cart.length === 0) {
                alert('Cart is empty!');
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'order.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert('Order placed successfully!');
                    cart = [];
                    updateCart();
                }
            };
            xhr.send(JSON.stringify(cart));
        }
    </script>

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