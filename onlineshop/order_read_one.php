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
    <div class="container mt-5 p-5 mb-4">
        <div class="page-header text-center mb-5">
            <h1>Order Detail</h1>
        </div>

        <!-- PHP read one record will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die('ERROR: Record Order ID not found.');

        include 'config/database.php';

        // select id, quantity, price each from order_detail
        $query = "SELECT quantity, price_each, name, price, promotion_price, total_amount 
        FROM order_detail o
        INNER JOIN products p ON o.product_id = p.id 
        INNER JOIN order_summary s ON o.order_id = s.order_id 
        WHERE o.order_id = ? ";

        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $order_id);
        $stmt->execute();
        $num = $stmt->rowCount();
        ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price (RM)</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total (RM)</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($num > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row); ?>
                        <tr>
                            <td><?php echo htmlspecialchars($name, ENT_QUOTES); ?></th>
                            <td><?php if ($promotion_price == 0) {
                                    echo number_format((float)htmlspecialchars($price, ENT_QUOTES), 2, '.', '');
                                } else {
                                    echo number_format((float)htmlspecialchars($promotion_price, ENT_QUOTES), 2, '.', '');
                                } ?></td>
                            <td><?php echo htmlspecialchars($quantity, ENT_QUOTES); ?></td>
                            <td><?php echo number_format((float)htmlspecialchars($price_each, ENT_QUOTES), 2, '.', ''); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3"></td>
                        <th><?php echo number_format((float)htmlspecialchars($total_amount, ENT_QUOTES), 2, '.', ''); ?></th>
                    </tr>
                <?php } ?>
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