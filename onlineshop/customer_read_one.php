<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Read One Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <!-- container -->
    <div class="container mt-5 p-5">
        <div class="page-header text-center">
            <h1>Read Customer</h1>
        </div>

        <!-- PHP read one record will be here -->
        <?php

        //include database connection
        include 'config/database.php';

        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $username = isset($_GET['username']) ? $_GET['username'] : die('ERROR: Record Username not found.');

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT username, first_name, last_name, gender, date_of_birth FROM customers WHERE username = ? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $username);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $username = $row['username'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $gender = $row['gender'];
            $date_of_birth = $row['date_of_birth'];
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <!-- HTML read one record table will be here -->
        <!--we have our html table here where the record will be displayed-->
        <div class='row justify-content-center mt-5'>
            <div class='col-auto'>
                <table class='table table-hover table-responsive table-bordered text-center'>
                    <tr>
                        <td>Username</td>
                        <td><?php echo htmlspecialchars($username, ENT_QUOTES);  ?></td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><?php echo htmlspecialchars($first_name, ENT_QUOTES);  ?></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><?php echo htmlspecialchars($last_name, ENT_QUOTES);  ?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><?php echo htmlspecialchars($gender, ENT_QUOTES);  ?></td>
                    </tr>
                    <tr>
                    <tr>
                        <td>Date Of Birth</td>
                        <td><?php echo htmlspecialchars($date_of_birth, ENT_QUOTES);  ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a href='customer_read.php' class='btn btn-danger p-3'>Back to read customers</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div> <!-- end .container -->

    <div class="container-fluid p-1 pt-3 bg-success text-white text-center">
        <p>Copyrights &copy; 2022 Online Shop. All rights reserved.</p>
    </div>

</body>

</html>