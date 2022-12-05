<?php
include 'session.php';
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Create Order</title>
    <!-- Latest compiled and minified Bootstrap CSS (Apply your Bootstrap here -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>create order</title>

    <style>
        .error {
            color: red;
        }
    </style>

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
            <h1>Create Order</h1>
        </div>

        <?php
        include 'config/database.php';

        $useErr = $proErr = $quaErr = "";
        $flag = false;

        if ($_POST) {

            if (empty($_POST["customer_id"])) {
                $useErr = "Username is required *";
                $flag = true;
            } else {
                $customer_id = htmlspecialchars(strip_tags($_POST['customer_id']));
            }

            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            if ($flag == false) {
                $total_amount = 0;

                //count total amount
                for ($a = 0; $a < 3; $a++) {
                    $query = "SELECT price, promotion_price FROM products WHERE id=:id";
                    // bind choosen (product id) to order_details (order id)
                    $stmt = $con->prepare($query);
                    $stmt->bindParam(':id', $product_id[$a]);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($row['promotion_price'] == 0) {
                        $price = $row['price'];
                    } else {
                        $price = $row['promotion_price'];
                    }

                    //combine the amount with previous amount
                    $total_amount = $total_amount + ((float)$price * (int)$quantity[$a]);
                }

                //send data to order_summary
                $query = "INSERT INTO order_summary SET customer_id=:customer_id, order_date=:order_date, total_amount=:total_amount";
                $stmt = $con->prepare($query);
                $stmt->bindParam(':customer_id', $customer_id);
                $order_date = date('Y-m-d');
                $stmt->bindParam(':order_date', $order_date);
                $stmt->bindParam(':total_amount', $total_amount);

                if ($stmt->execute()) {

                    echo "<div class='alert alert-success'>Able to create order.</div>";
                    // put order id that created to order_detail table
                    $order_id = $con->lastInsertId();

                    // take price and promo price from database
                    for ($a = 0; $a < 3; $a++) {
                        $query = "SELECT price, promotion_price FROM products WHERE id = :id";
                        $stmt = $con->prepare($query);
                        // bind choosen (product id) to order_details (order id)
                        $stmt->bindParam(':id', $product_id[$a]);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($row["promotion_price"] == 0) {
                            $price = $row['price'];
                        } else {
                            $price = $row["promotion_price"];
                        }

                        $price_each = ((float)$price * (int)$quantity[$a]);

                        //send data to order_detail
                        $query = "INSERT INTO order_detail SET product_id=:product_id, quantity=:quantity, order_id=:order_id, price_each=:price_each";
                        $stmt = $con->prepare($query);
                        $stmt->bindParam(':product_id', $product_id[$a]);
                        $stmt->bindParam(':quantity', $quantity[$a]);
                        $stmt->bindParam(':order_id', $order_id);
                        $stmt->bindParam(':price_each', $price_each);
                        $stmt->execute();
                    }
                } else {
                    echo "<div class='alert alert-danger'>Unable to create order.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Unable to create order.</div>";
            }
        } ?>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <?php
            //Username from database
            $query = "SELECT customer_id, username FROM customers ORDER BY customer_id DESC";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            ?>

            <div class="row ">
                <div class="col-12 mb-2">
                    <label class="order-form-label">Username</label>
                </div>

                <div class="col-6 mb-2">
                    <span class="error"><?php echo $useErr; ?></span>
                    <select class="form-select form-select mb-3 bg-white " name="customer_id" aria-label="customer_id">
                        <option value="" selected>Choose your username</option>

                        <?php if ($num > 0) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                extract($row); ?>
                                <option value="<?php echo $customer_id; ?>"><?php echo htmlspecialchars($username, ENT_QUOTES); ?></option>
                        <?php }
                        } ?>

                    </select>
                </div>
            </div>
            <span class="error"><?php echo $proErr; ?></span>
            <span class="error"><?php echo $quaErr; ?></span>
            <?php

            for ($a = 0; $a < 3; $a++) {

                $query = "SELECT id, name, price, promotion_price FROM products ORDER BY id DESC";
                $stmt = $con->prepare($query);
                $stmt->execute();
                $num = $stmt->rowCount();
            ?>

                <div class="row ">
                    <div class="col-6 mb-2">
                        <label class="order-form-label">Product</label>
                    </div>
                    <div class="col-3 mb-2">
                        <label class="order-form-label">Quantity</label>
                    </div>

                    <div class="col-6 mb-2">
                        <select class="form-select form-select mb-3 bg-dark text-white " name="product_id[]" aria-label=".form-select-lg example">
                            <option value="" selected>Choose your product </option>

                            <?php if ($num > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row); ?>
                                    <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($name, ENT_QUOTES);
                                                                        if ($promotion_price == 0) {
                                                                            echo " (RM$price)";
                                                                        } else {
                                                                            echo " (RM$promotion_price)";
                                                                        } ?></option>
                            <?php }
                            } ?>

                        </select>

                    </div>
                    <div class="col-3 mb-2">

                        <input type='number' name='quantity[]' class='form-control' min=1 />
                    </div>
                <?php } ?>

                <div class="col-3 mb-2">
                    <input type='submit' value='Order' class='btn btn-success' />
                </div>
                </div>
        </form>


    </div>
    <!-- end .container -->

    <?php
    include 'copyright.php';
    ?>

</body>

</html>