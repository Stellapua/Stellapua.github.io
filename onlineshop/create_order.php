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
    <div class="container mt-5 p-5 mb-4">
        <div class="page-header text-center mb-4">
            <h1>Create Order</h1>
        </div>

        <?php
        include 'config/database.php';

        $useErr = $proErr = "";
        $flag = false;

        if ($_POST) {

            $customer_id = htmlspecialchars(strip_tags($_POST['customer_id']));
            $product_id = $_POST['product_id'];
            $value = array_count_values($product_id);
            $quantity = $_POST['quantity'];

            if (empty($_POST["customer_id"])) {
                $useErr = "Username is required *";
                $flag = true;
            }

            for ($x = 0; $x < count($product_id); $x++) {

                if (empty($product_id[0])) {
                    $proErr = "Please at least choose a product *";
                    $flag = true;
                } else {
                    if ($product_id[$x] !== "") {
                        if (empty($quantity[$x])) {
                            $proErr = "Please type the quantity of product *";
                            $flag = true;
                        }
                        if ($value[$product_id[$x]] > 1) {
                            $proErr = "Do not choose the same product *";
                            $flag = true;
                        }
                    }
                }
            }

            if ($flag == false) {

                $total_amount = 0;

                for ($x = 0; $x < count($product_id); $x++) {
                    $query = "SELECT price, promotion_price FROM products WHERE id =:id";
                    $stmt = $con->prepare($query);
                    $stmt->bindParam(':id', $product_id[$x]);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $num = $stmt->rowCount();
                    $price = 0;

                    if ($num > 0) {
                        if ($row['promotion_price'] == 0) {
                            $price = $row['price'];
                        } else {
                            $price = $row['promotion_price'];
                        }
                    }
                    $total_amount = $total_amount + ((float)$price * (int)$quantity[$x]);
                }
                //send data to order_summary
                $query = "INSERT INTO order_summary SET customer_id=:customer_id, order_date=:order_date, total_amount=:total_amount ";
                $stmt = $con->prepare($query);
                $stmt->bindParam(':customer_id', $customer_id);
                date_default_timezone_set("Asia/Kuala_Lumpur");
                $order_date = date('Y-m-d H:i:s');
                $stmt->bindParam(':order_date', $order_date);
                $stmt->bindParam(':total_amount', $total_amount);

                if ($stmt->execute()) {
                    $order_id = $con->lastInsertId();

                    for ($x = 0; $x < count($product_id); $x++) {

                        if ($product_id[$x] !== "") {

                            $query = "SELECT price, promotion_price FROM products WHERE id = :id";
                            $stmt = $con->prepare($query);
                            $stmt->bindParam(':id', $product_id[$x]);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $num = $stmt->rowCount();

                            if ($num > 0) {
                                if ($row['promotion_price'] == 0) {
                                    $price = $row['price'];
                                } else {
                                    $price = $row['promotion_price'];
                                }
                            }

                            $price_each = ((float)$price * (int)$quantity[$x]);

                            $query = "INSERT INTO order_detail SET product_id=:product_id, quantity=:quantity, order_id=:order_id, price_each=:price_each ";
                            $stmt = $con->prepare($query);
                            $stmt->bindParam(':product_id', $product_id[$x]);
                            $stmt->bindParam(':quantity', $quantity[$x]);
                            $stmt->bindParam(':order_id', $order_id);
                            $stmt->bindParam(':price_each', $price_each);
                            $stmt->execute();
                        }
                    }
                    header('Location:order_read.php?action=done');
                } else {
                    echo "<div class='alert alert-danger'>Unable to execute.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Unable to create order.</div>";
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

            <span class="error"><?php echo $useErr; ?></span>
            <div class="row">
                <div class="col-12 mb-2 ">
                    <label class="order-form-label">Username</label>
                </div>

                <div class="col-12 mb-2">
                    <select class="form-select rounded mb-4" name="customer_id">
                        <option value="" selected>Choose your username </option>
                        <?php if ($num > 0) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                extract($row); ?>
                                <option value="<?php echo $customer_id; ?>"><?php echo htmlspecialchars($username, ENT_QUOTES); ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </div>

            <?php
            $query = "SELECT id, name, price, promotion_price FROM products ORDER BY id DESC";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            ?>

            <span class="error"><?php echo $proErr; ?></span>

            <div class="pRow">
                <div class="row">
                    <div class="col-8 mb-2 ">
                        <label class="order-form-label">Product</label>
                    </div>

                    <div class="col-4 mb-2">
                        <label class="order-form-label">Quantity</label>
                    </div>

                    <div class="col-8 ">
                        <select class="form-select mb-3" name="product_id[]" aria-label="form-select-lg example">
                            <option value="" selected>Choose your product </option>

                            <?php if ($num > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row); ?>
                                    <option value="<?php echo $id; ?>">
                                        <?php echo htmlspecialchars($name, ENT_QUOTES);
                                        if ($promotion_price == 0) {
                                            echo " (RM$price)";
                                        } else {
                                            echo " (RM$promotion_price)";
                                        } ?>

                                    </option>
                            <?php }
                            }
                            ?>

                        </select>
                    </div>

                    <div class="col-4 ">
                        <input type='number' name='quantity[]' class='form-control' min=1 />
                    </div>
                </div>
            </div>
            <div class="col-8">
                <input type="button" value="Add More" class="add_one btn btn-warning" />
                <input type="button" value="Delete" class="delete_one btn btn-warning" />
                <input type='submit' value='Order' class='btn btn-success' />
            </div>
        </form>

    </div>
    <!-- end .container -->

    <script>
        document.addEventListener('click', function(event) {
            if (event.target.matches('.add_one')) {
                var element = document.querySelector('.pRow');
                var clone = element.cloneNode(true);
                element.after(clone);
            }
            if (event.target.matches('.delete_one')) {
                var total = document.querySelectorAll('.pRow').length;
                if (total > 1) {
                    var element = document.querySelector('.pRow');
                    element.remove(element);
                }
            }
        }, false);
    </script>

    <?php
    include 'copyright.php';
    ?>

</body>

</html>