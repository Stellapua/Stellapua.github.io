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

        $useErr = $proErr = "";
        $flag = false;

        if ($_POST) {

            if (empty($_POST["customer_id"])) {
                $useErr = "Username is required *";
                $flag = true;
            } else {
                $customer_id = htmlspecialchars(strip_tags($_POST['customer_id']));
            }

            $product_id = $_POST['product_id'];
            //count value, if dup add value 
            $value = array_count_values($product_id);
            $quantity = $_POST['quantity'];

            // var_dump($product_id);
            // echo "<br>";
            // var_dump($quantity);
            // echo "<br>";
            // echo print_r($value);

            // must choose one product
            if ($product_id[0] == "" && $product_id[1] == "" && $product_id[2] == "") {
                $proErr = "Please at least choose a product *";
                echo "<div class='alert alert-danger'>Unable to create order.</div>";
            } else {
                // must type quantity
                if ((!empty($product_id[0]) && empty($quantity[0])) or (!empty($product_id[1]) && empty($quantity[1])) or (!empty($product_id[2]) && empty($quantity[2]))) {
                    $proErr = "Please type the quantity of your product *";
                    echo "<div class='alert alert-danger'>Unable to create order.</div>";
                } else {

                    for ($x = 0; $x < count($product_id); $x++) {
                        // only record the product that have quantity to table
                        if (!empty($product_id[$x]) && !empty($quantity[$x])) {

                            //only record non dup product
                            if ($value[$product_id[$x]] == 1) {

                                if ($flag == false) {
                                    //send data to order_summary
                                    $query = "INSERT INTO order_summary SET customer_id=:customer_id, order_date=:order_date ";
                                    $stmt = $con->prepare($query);
                                    $stmt->bindParam(':customer_id', $customer_id);
                                    $order_date = date('Y-m-d');
                                    $stmt->bindParam(':order_date', $order_date);

                                    if ($stmt->execute()) {

                                        echo "<div class='alert alert-success'>Able to create order.</div>";
                                        // put order id that created to order_detail table
                                        $order_id = $con->lastInsertId();

                                        //send data to order_detail
                                        $query = "INSERT INTO order_detail SET product_id=:product_id, quantity=:quantity, order_id=:order_id ";
                                        $stmt = $con->prepare($query);
                                        $stmt->bindParam(':product_id', $product_id[$x]);
                                        $stmt->bindParam(':quantity', $quantity[$x]);
                                        $stmt->bindParam(':order_id', $order_id);

                                        $stmt->execute();
                                    } else {
                                        echo "<div class='alert alert-danger'>Unable to create order.</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>Unable to create order.</div>";
                                }
                            } else {
                                $proErr = "Please do not choose the same product *";
                            }
                        }
                    }
                }
            }
        }
        ?>


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