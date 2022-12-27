<?php
include 'session.php';
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Read Products</title>
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
            <h1>Read Products</h1>
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
        if ($action == 'failed') {
            echo "<div class='alert alert-danger'>You cannot delete ordered product.</div>";
        }
        if ($action == 'done') {
            echo "<div class='alert alert-success'>New product has created.</div>";
        }

        // select all data
        $query = "SELECT id, name, description, price , promotion_price FROM products ORDER BY id DESC";
        $stmt = $con->prepare($query);
        $stmt->execute();

        // this is how to get number of rows returned
        $num = $stmt->rowCount();
        ?>

        <!-- link to create record form-->
        <div class="col text-center">
            <a href='product_create.php' class='btn btn-success m-b-1em text-center'>Create New Product</a>
        </div>

        <!-- check if more than 0 record found -->
        <?php
        if ($num > 0) {

            // data from database will be here
            echo "<div class='row justify-content-center mt-3'>";
            echo "<div class='col-auto'>";
            echo "<table class='table table-hover table-responsive table-bordered text-center'>"; //start table

            //creating our table heading
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Description</th>";
            echo "<th>Price (RM)</th>";
            echo "<th>Promotion Price (RM)</th>";
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
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                if (htmlspecialchars($description, ENT_QUOTES) == NULL) {
                    echo "<td> " . "-" . "</td>";
                } else {
                    echo "<td> " . htmlspecialchars($description, ENT_QUOTES) . "</td>";
                };
                echo "<td class= \"text-end\" > " . number_format((float)$price, 2, '.', '') . "</td>";
                if (htmlspecialchars($promotion_price, ENT_QUOTES) == NULL) {
                    echo "<td class= \"text-end\" > " . "-" . "</td>";
                } else {
                    echo "<td class= \"text-end\" > " . number_format((float)htmlspecialchars($promotion_price, ENT_QUOTES), 2, '.', '') . "</td>";
                };
                echo "<td>";
                // read one record
                echo "<a href='product_read_one.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";

                // we will use this links on next part of this post
                echo "<a href='product_update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

                // we will use this links on next part of this post
                echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
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

        function delete_user(id) {
            var answer = confirm('Are you sure ? ');
            if (answer) {
                // if user clicked ok,
                // pass the id to delete.php and execute the delete query
                window.location = 'product_delete.php?id=' + id;
            }
        }
    </script>

</body>

</html>