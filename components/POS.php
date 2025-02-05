<?php
require("../backend/server.php"); // Connect to database

// Fetch products from database
$sql = "SELECT id, image, item, price, image FROM products";
$result = $conn->query($sql);
?>

<style>
    .products {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    img {
        height: 100px;
        object-fit: cover;
    }
</style>

<div class="pagetitle">
    <h1>POS</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
POS        </ol>
    </nav>
</div><!-- End Page Title -->


<div class="row">

    <div class="col-lg-12" id="tableContainer">
        <div class="card ">
            <div class="card-body">
                <h5 class="card-title">Table number</h5>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="table-number" placeholder="Enter table number"
                            min="1" max="16" required>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-8" id="tableContainer">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Product</h5>
                <div class="products">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                                    <div class='card' style='width:30%;' onclick=\"addToCart({$row['id']}, '{$row['item']}', {$row['price']})\">
                                        <img src='../productImage/{$row['image']}' alt='{$row['item']}' class='card-img-top' >
                                        <div class='card-body'>
                                            <h5 class='card-title' style='padding:10px 0px 0px 0px;'>{$row['item']}</h5>
                                            <p class='card-text' style='margin:0px;'> ₱" . number_format($row['price'], 2) . "<p>
                                        </div>
                                    </div>
                                ";
                        }
                    } else {
                        echo "<p>No products available.</p>";
                    }
                    $conn->close();
                    ?>
                </div>

            </div>
        </div>

    </div>

    <div class="col-lg-4" id="tableInformationContainer" data-bs-backdrop="false">
        <div class="card">
            <div class="card-body pb-0">
                <h5 class="card-title">Cart</h5>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <tr>
                            <td colspan="4" class="text-center">Cart is empty</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-right"><strong>Total Cost:</strong></td>
                            <td colspan="2" id="cart-total"><strong>₱0.00</strong></td>
                        </tr>
                    </tfoot>
                </table>


            </div>
            <div class="modal-footer m-1">
                <button type="button" class="btn btn-primary m-2" onclick="placeOrder()">Order</button>
            </div>
        </div>
    </div>

</div>



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
        const cartItems = document.getElementById("cart-items");
        cartItems.innerHTML = "";

        if (cart.length === 0) {
            cartItems.innerHTML = "<tr><td colspan='5'>Cart is empty</td></tr>";
            return;
        }

        let totalCost = 0;

        cart.forEach((item, index) => {
            const itemTotal = item.quantity * item.price;
            totalCost += itemTotal;

            cartItems.innerHTML += `
            <tr>
                <td>${item.name}</td>
                <td class="text-center">${item.quantity}</td>
                <td>₱${itemTotal.toFixed(2)}</td>
                <td>
                    <i class="ri-close-fill" onclick="removeFromCart(${index})"></i>
                </td>
            </tr>
        `;
        });
        document.getElementById("cart-total").innerHTML = `<strong>₱${totalCost.toFixed(2)}</strong>`;
    }

    function removeFromCart(index) {
        if (cart[index].quantity > 1) {
            cart[index].quantity--;
        } else {
            cart.splice(index, 1);
        }
        updateCart();
    }

    function placeOrder() {
        if (cart.length === 0) {
            alert("Cart is empty!");
            return;
        }

        const tableNumber = document.getElementById("table-number").value;
        if (!tableNumber) {
            alert("Please enter a table number!");
            return;
        }

        const orderData = cart.map(item => ({
            id: item.id,
            quantity: item.quantity,
            price: item.price,
            table_number: tableNumber
        }));

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../components/order.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onload = function () {
            if (xhr.status === 200) {
                alert("Order placed successfully!");
                cart = [];
                updateCart();
                document.getElementById("table-number").value = "";
            } else {
                alert("Failed to place order. Try again!");
            }
        };
        xhr.send(JSON.stringify(orderData));
    }
</script>