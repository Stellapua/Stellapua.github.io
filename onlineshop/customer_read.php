<?php
include 'session.php';
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Read Customers</title>
    <!-- Latest compiled and minified Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <?php
    include 'menu.php';
    ?>

    <!-- container -->
    <div class="container-fluid mt-5 pt-5">
        <div class="page-header text-center">
            <h1>Read Customers</h1>
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
            echo "<div class='alert alert-danger'>You cannot delete customer that had ordered product.</div>";
        }
        if ($action == 'done') {
            echo "<div class='alert alert-success'>New customer has created.</div>";
        }

        // select all data
        $query = "SELECT customer_id, username, first_name, last_name, gender, date_of_birth FROM customers ORDER BY customer_id DESC";
        $stmt = $con->prepare($query);
        $stmt->execute();

        // this is how to get number of rows returned
        $num = $stmt->rowCount();
        ?>

        <!-- link to create record form-->
        <div class="col text-center">
            <a href='create_customer.php' class='btn btn-success m-b-1em text-center'>Create New Customer</a>
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
            echo "<th>Customer ID</th>";
            echo "<th>Username</th>";
            echo "<th>First Name</th>";
            echo "<th>Last name</th>";
            echo "<th>Gender</th>";
            echo "<th>Date Of Birth</th>";
            echo "<th>Action</th>";
            echo "</tr>";


            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                echo "<tr>";
                echo "<td>{$customer_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$first_name}</td>";
                echo "<td>{$last_name}</td>";
                echo "<td>{$gender}</td>";
                echo "<td>{$date_of_birth}</td>";
                echo "<td>";
                // read one record
                echo "<a href='customer_read_one.php?customer_id={$customer_id}' class='btn btn-info m-r-1em'>Read</a>";

                // we will use this links on next part of this post
                echo "<a href='customer_update.php?customer_id={$customer_id}' class='btn btn-primary m-r-1em'>Edit</a>";

                // we will use this links on next part of this post
                echo "<a href='#' onclick='delete_user({$customer_id});'  class='btn btn-danger'>Delete</a>";
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

        function delete_user(customer_id) {
            var answer = confirm('Are you sure ? ');
            if (answer) {
                // if user clicked ok,
                // pass the id to delete.php and execute the delete query
                window.location = 'customer_delete.php?customer_id=' + customer_id;
            }
        }
    </script>



</body>

</html>