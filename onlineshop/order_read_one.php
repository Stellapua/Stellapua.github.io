<?php
include 'session.php';
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Order Detail</title>
    <!-- Latest compiled and minified Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <?php
    include 'menu.php';
    ?>

    <!-- container -->
    <div class="container mt-5 p-5">
        <div class="page-header text-center">
            <h1>Order Detail</h1>
        </div>


        <!-- PHP read one record will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die('ERROR: Record Order ID not found.');

        include 'config/database.php';

        // select id, quantity, price each from order_detail
        $query = "SELECT order_id, order_detail_id, product_id, quantity, price_each FROM order_detail WHERE order_id = ? LIMIT 0,1";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $order_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $order_detail_id = $row['order_detail_id'];

        print_r($order_detail_id);
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $price_each = $row['price_each'];

        // select product name & price from product
        $query = "SELECT name, price, promotion_price FROM products WHERE id =:id";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':id', $product_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = $row['name'];
        if ($row['promotion_price'] == 0) {
            $price = $row['price'];
        } else {
            $price = $row['promotion_price'];
        }

        // select total amount from order_summary
        $query = "SELECT order_id, total_amount FROM order_summary WHERE order_id = ? LIMIT 0,1";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $order_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $total_amount = $row['total_amount'];
        ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total </th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td><?php echo htmlspecialchars($name, ENT_QUOTES); ?></th>
                    <td><?php echo "RM" . htmlspecialchars($price, ENT_QUOTES); ?></td>
                    <td><?php echo htmlspecialchars($quantity, ENT_QUOTES); ?></td>
                    <td><?php echo "RM" . htmlspecialchars($price_each, ENT_QUOTES); ?></td>
                </tr>

                <tr>
                    <td colspan="3"></td>
                    <td><?php echo "RM" . htmlspecialchars($total_amount, ENT_QUOTES); ?></td>
                </tr>
            </tbody>
        </table>

        <div class='row justify-content-center mt-5'>
            <div class='col-auto'>
                <a href='order_read.php ' class='btn btn-danger p-3'>Back to order list</a>
            </div>
        </div>

    </div> <!-- end .container -->

    <?php
    include 'copyright.php';
    ?>

</body>

</html>