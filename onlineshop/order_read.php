<?php
include 'session.php';
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Order List</title>
    <!-- Latest compiled and minified Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php
    include 'menu.php';
    ?>

    <!-- container -->
    <div class="container-fluid">
        <div class="page-header text-center mt-5 pt-5">
            <h1>Order List</h1>
        </div>

        <?php
        // include database connection
        include 'config/database.php';

        // delete message prompt will be here
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        // if it was redirected from delete.php
        if ($action == 'deleted') {
            echo "<div class='alert alert-success'>Record was deleted.</div>";
        }
        if ($action == 'done') {
            echo "<div class='alert alert-success'>New order has created.</div>";
        }

        // select all data
        $query = "SELECT order_id, o.customer_id, first_name, last_name, order_date, total_amount
        FROM order_summary o
        INNER JOIN customers c
        ON c.customer_id = o.customer_id
        ORDER BY order_id DESC";

        $stmt = $con->prepare($query);
        $stmt->execute();

        // this is how to get number of rows returned
        $num = $stmt->rowCount();
        ?>

        <!-- link to create record form-->
        <div class="col text-center">
            <a href='create_order.php' class='btn btn-success m-b-1em text-center'>Create New Order</a>
        </div>

        <!-- check if more than 0 record found -->
        <?php
        if ($num > 0) {

            // data from database will be here
            echo "<div class='row justify-content-center mt-3'>";
            echo "<div class='col-auto'>";
            echo "<table class='table table-hover table-responsive table-bordered text-center mb-5'>"; //start table

            //creating our table heading
            echo "<tr>";
            echo "<th>Order ID</th>";
            echo "<th>Customer ID</th>";
            echo "<th>Name</th>";
            echo "<th>Total Order Amount (RM)</th>";
            echo "<th>Order Date & Time</th>";
            echo "<th>Action</th>";
            echo "</tr>";

            // table body will be here
            // retrieve our table contents
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['firstname'] to just $firstname only
                extract($row);
                // creating new table row per record
                echo "<tr>";
                echo "<td>{$order_id}</td>";
                echo "<td>{$customer_id}</td>";
                echo "<td>{$first_name} {$last_name}</td>";
                echo "<td class= \"text-end\" > " . number_format((float)$total_amount, 2, '.', '') . "</td>";
                echo "<td>{$order_date}</td>";
                echo "<td>";
                // read one record
                echo "<a href='order_read_one.php?order_id={$order_id}' class='btn btn-info m-r-1em'>Read</a>";
                echo "<a href='order_update.php?id={$order_id}' class='btn btn-primary m-r-1em'>Edit</a>";
                echo "<a href='#' onclick='delete_user({$order_id});'  class='btn btn-danger'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }

            // end table
            echo "</div>";
            echo "</div>";
            echo "</table>";
        }
        // if no records found
        else {
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
        ?>

    </div> <!-- end .container -->

    <?php
    include 'copyright.php';
    ?>

    <!-- confirm delete record will be here -->
    <script type='text/javascript'>
        // confirm record deletion

        function delete_user(order_id) {
            var answer = confirm('Are you sure ? ');
            if (answer) {
                // if user clicked ok,
                // pass the id to delete.php and execute the delete query
                window.location = 'order_delete.php?order_id=' + order_id;
            }
        }
    </script>

</body>

</html>