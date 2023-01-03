<?php
include 'session.php';
?>

<!DOCTYPE html>

<!DOCTYPE HTML>
<html>

<head>
    <title>Home</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>home</title>

    <style>

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <?php
    include 'menu.php';

    include 'config/database.php';

    $query = "SELECT * FROM customers";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $total_customer = $stmt->rowCount();

    $query = "SELECT * FROM products";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $total_product = $stmt->rowCount();

    $query = "SELECT * FROM order_summary";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $total_order = $stmt->rowCount();

    //latest order
    $query = "SELECT first_name, last_name, total_amount, order_date FROM order_summary o 
    INNER JOIN customers c ON c.customer_id = o.customer_id
    ORDER BY order_id DESC LIMIT 0,1";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $total_amount = $row['total_amount'];
    $order_date = $row['order_date'];

    // highest purchased amount
    $query = "SELECT first_name, last_name, total_amount, order_date FROM order_summary o 
    INNER JOIN customers c ON c.customer_id = o.customer_id
    ORDER BY total_amount DESC LIMIT 0,1";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $first_name2 = $row['first_name'];
    $last_name2 = $row['last_name'];
    $total_amount2 = $row['total_amount'];
    $order_date2 = $row['order_date'];

    ?>
    <div class="container-fluid text-center p-5 mt-5 ">
        <div class="row align-item-center ">
            <div class="col-12">
                <h2>PLANT WHOLESALE ONLINE SHOP</h2>
                <h5>We provide plants and flowers for both indoor and outdoor with total of 200 species you can find in the Malaysia.</h5>
            </div>
        </div>
    </div>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/plant7.jpg" class="d-block w-100" alt="p1">
            </div>
            <div class="carousel-item">
                <img src="images/plant3.jpg" class="d-block w-100" alt="p2">
            </div>
            <div class="carousel-item">
                <img src="images/plant6.jpg" class="d-block w-100" alt="p3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container-fluid text-center p-5 mt-5 ">
        <div class="row align-item-center ">
            <div class="col-12">
                <h3>About Us</h3>
                <p>The Plant Room are established since 2002 in Cheras, we has evolved into becoming a full range of landscaping plants nursery, grower, trader and wholesaler in Malaysia. Our garden plants nursery nurture & grow a variety of tropical palms, trees, bamboos, shrubs and ground covers. With years of experiences in plant nurturing, plant nursery management and landscaping business, we always strive to provide quality plants and services to our valuable customers.</p>
            </div>
        </div>
    </div>

    <div class="container-fluid text-center p-5 bg-success">
    </div>

    <div class="container-fluid text-center p-5">
        <div class="container mx-auto mt-4">

            <h3>Dashboard</h3>

            <div class="row mt-4 mb-5">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total Products</h5>
                            <p class="card-text"><?php echo $total_product; ?></p>
                            <a class="btn btn-warning m-2" href="product_read.php" role="button">CHECK LIST</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total Customers</h5>
                            <p class="card-text"><?php echo $total_customer; ?></p>
                            <a class="btn btn-warning m-2" href="customer_read.php" role="button">CHECK LIST</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total Orders</h5>
                            <p class="card-text"><?php echo $total_order; ?></p>
                            <a class="btn btn-warning m-2" href="order_read.php" role="button">CHECK LIST</a>
                        </div>
                    </div>
                </div>
            </div>

            <table class='table table-hover table-responsive table-bordered text-center mt-3 mb-5'>
                <tr>
                    <th colspan="3" text-start>Latest order</th>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <th>Transaction Date</th>
                    <th>Purchase Amount</th>
                </tr>
                <tr>
                    <td><?php echo $first_name;
                        echo $last_name; ?></td>
                    <td><?php echo $order_date; ?></td>
                    <td><?php echo $total_amount; ?></td>
                </tr>
            </table>

            <table class='table table-hover table-responsive table-bordered text-center mt-3 mb-5'>
                <tr>
                    <th colspan="3" text-start>Highest purchased amount</th>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <th>Transaction Date</th>
                    <th>Purchased Amount</th>
                </tr>
                <tr>
                    <td><?php echo $first_name2;
                        echo $last_name2; ?></td>
                    <td><?php echo $order_date2; ?></td>
                    <td><?php echo $total_amount2; ?></td>
                </tr>
            </table>

            <?php
            //top6 best selling
            $query = "SELECT o.product_id, SUM(o.quantity) as totalquantity ,p.name, p.description FROM order_detail o
            INNER JOIN products p ON o.product_id = p.id
            GROUP BY o.product_id
            ORDER BY totalquantity DESC LIMIT 6";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            ?>

            <h4>Top 6 best selling products</h4>

            <div class="row mt-4 mb-5">
                <?php if ($num > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row); ?>

                        <div class="col-md-4 mt-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $name; ?></h5>
                                    <h6 class="card-sub-title text-muted"><?php echo "quantity: " . $totalquantity; ?></h6>
                                    <p class="card-text"><?php echo $description; ?></p>
                                    <a class="btn btn-warning m-2" href="create_order.php" role="button">BUY IT NOW</a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>

            <?php
            //product never purchased
            $query = "SELECT p.name, p.description FROM products p
            LEFT JOIN order_detail o ON o.product_id = p.id
            WHERE o.product_id iS NULL LIMIT 3";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            ?>

            <h4>Products that never purchase by any customer</h4>

            <div class="row mt-4 mb-5">
                <?php if ($num > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row); ?>

                        <div class="col-md-4 mt-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $name; ?></h5>
                                    <p class="card-text"><?php echo $description; ?></p>
                                    <a class="btn btn-warning m-2" href="create_order.php" role="button">BUY IT NOW</a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>

    <?php
    include 'copyright.php';
    ?>

</body>

</html>