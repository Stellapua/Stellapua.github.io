<?php
include 'session.php';
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Read Customer</title>
    <!-- Latest compiled and minified Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <?php
    include 'menu.php';
    ?>

    <!-- container -->
    <div class="container-fluid mt-5 p-5">
        <div class="page-header text-center">
            <h1>Read Customer</h1>
        </div>

        <!-- PHP read one record will be here -->
        <?php

        include 'config/database.php';

        $customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die('ERROR: Record Customer ID not found.');

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT customer_id, username, first_name, last_name, gender, date_of_birth, registration_date_time, account_status FROM customers WHERE customer_id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $customer_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $username = $row['username'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $gender = $row['gender'];
            $date_of_birth = $row['date_of_birth'];
            $registration_date_time = $row['registration_date_time'];
            $account_status = $row['account_status'];
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

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
                        <td>Date Of Birth</td>
                        <td><?php echo htmlspecialchars($date_of_birth, ENT_QUOTES);  ?></td>
                    </tr>
                    <tr>
                        <td>Registration Date & Time</td>
                        <td><?php echo htmlspecialchars($registration_date_time, ENT_QUOTES);  ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?php echo htmlspecialchars($account_status, ENT_QUOTES);  ?></td>
                    </tr>
                </table>

                <div class='row justify-content-center mt-5'>
                    <div class='col-auto'>
                        <a href='customer_read.php' class='btn btn-danger p-3'>Back to read customers</a>
                    </div>
                </div>

            </div>
        </div>

    </div> <!-- end .container -->

    <?php
    include 'copyright.php';
    ?>

</body>

</html>