<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-dark bg-success fixed-top ">
        <div class="container-fluid">
            <a class="navbar-brand " href="#">Online Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-success " tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Online Shop</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 ">
                        <li class="nav-item">
                            <a class="nav-link " href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="product_create.php">Create Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="product_read.php">Read Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="create_customer.php">Create Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="customer_read.php">Read customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="contact_us.php">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- container -->
    <div class="container mt-5 pt-5">
        <div class="page-header text-center">
            <h1>Read Customers</h1>
        </div>
    </div>

    <?php
    // include database connection
    include 'config/database.php';

    // delete message prompt will be here

    // select all data
    $query = "SELECT username, first_name, last_name, gender, date_of_birth FROM customers ORDER BY username DESC";
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
        echo "<th>Username</th>";
        echo "<th>First Name</th>";
        echo "<th>Last name</th>";
        echo "<th>Gender</th>";
        echo "<th>Date Of Birth</th>";
        echo "</tr>";

        // table body will be here
        // retrieve our table contents
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // extract row
            // this will make $row['firstname'] to just $firstname only
            extract($row);
            // creating new table row per record
            echo "<tr>";
            echo "<td>{$username}</td>";
            echo "<td>{$first_name}</td>";
            echo "<td>{$last_name}</td>";
            echo "<td>{$gender}</td>";
            echo "<td>{$date_of_birth}</td>";
            echo "<td>";
            // read one record
            echo "<a href='customer_read_one.php?username={$username}' class='btn btn-info m-r-1em'>Read</a>";

            // we will use this links on next part of this post
            echo "<a href='update.php?username={$username}' class='btn btn-primary m-r-1em'>Edit</a>";

            // we will use this links on next part of this post
            echo "<a href='#' onclick='delete_user({$username});'  class='btn btn-danger'>Delete</a>";
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

    <div class="container-fluid p-1 pt-3 bg-success text-white text-center">
        <p>Copyrights &copy; 2022 Online Shop. All rights reserved.</p>
    </div>

</body>

</html>