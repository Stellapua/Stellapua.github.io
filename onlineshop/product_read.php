<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <?php
    include 'session.php';
    include 'menu.php';
    ?>

    <!-- container -->
    <div class="container mt-5 pt-5">
        <div class="page-header text-center">
            <h1>Read Products</h1>
        </div>
    </div>

    <?php
    // include database connection
    include 'config/database.php';

    // delete message prompt will be here

    // select all data
    $query = "SELECT id, name, description, price FROM products ORDER BY id DESC";
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
        echo "<th>Price</th>";
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
            echo "<td>{$description}</td>";
            echo "<td>{$price}</td>";
            echo "<td>";
            // read one record
            echo "<a href='product_read_one.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";

            // we will use this links on next part of this post
            echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

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

    <!-- confirm delete record will be here -->

    <?php
    include 'copyright.php';
    ?>

</body>

</html>