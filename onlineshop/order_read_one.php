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
    <div class="container-fluid mt-5 p-5 mb-4">
        <div class="page-header text-center mb-5">
            <h1>Order Detail</h1>
        </div>

        <!-- PHP read one record will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die('ERROR: Record Order ID not found.');

        include 'config/database.php';

        $query = "SELECT c.customer_id, order_date, first_name, last_name, order_date, quantity, price_each, name, price, promotion_price, total_amount 
        FROM order_detail o
        INNER JOIN products p ON o.product_id = p.id 
        INNER JOIN order_summary s ON o.order_id = s.order_id 
        INNER JOIN customers c ON s.customer_id = c.customer_id
        WHERE o.order_id = ? ";

        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $order_id);
        $stmt->execute();
        $num = $stmt->rowCount();
        ?>

        <table class='table table-hover table-responsive table-bordered text-center mt-3'>
            <tr>
                <th>Product</th>
                <th>Price (RM)</th>
                <th>Promotion Price (RM)</th>
                <th>Quantity</th>
                <th>Total Each (RM)</th>
            </tr>

            <?php if ($num > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row); ?>
                    <tr>
                        <td><?php echo htmlspecialchars($name, ENT_QUOTES); ?></td>
                        <td class="text-end"><?php echo number_format((float)htmlspecialchars($price, ENT_QUOTES), 2, '.', ''); ?></td>
                        <td class="text-end"><?php if (htmlspecialchars($promotion_price, ENT_QUOTES) == NULL) {
                                                    echo "-";
                                                } else {
                                                    echo number_format((float)htmlspecialchars($promotion_price, ENT_QUOTES), 2, '.', '');
                                                } ?></td>
                        <td><?php echo htmlspecialchars($quantity, ENT_QUOTES); ?></td>
                        <td class="text-end"><?php echo number_format((float)htmlspecialchars($price_each, ENT_QUOTES), 2, '.', ''); ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <th colspan="4">Purchase Amount (RM)</th>
                    <td class="text-end"><?php echo number_format((float)htmlspecialchars($total_amount, ENT_QUOTES), 2, '.', ''); ?></td>
                </tr>
            <?php
                echo "<b>Order ID :</b> $order_id<br>";
                echo "<b>Name :</b> $first_name $last_name<br>";
                echo "<b>Order Date :</b> $order_date";
            } ?>
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