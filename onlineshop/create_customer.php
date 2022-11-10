<!DOCTYPE html>

<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS (Apply your Bootstrap here -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>create customer</title>

    <style>
        .error {
            color: red;
        }
    </style>

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
                            <a class="nav-link " href="product_read.php">Read product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="create_customer.php">Create Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="customer_read.php">Read customer</a>
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
    <div class="container mt-5 p-5">
        <div class="page-header text-center">
            <h1>Create Customer</h1>
        </div>

        <!-- html form to create product will be here -->
        <!-- PHP insert code will be here -->

        <?php
        $useErr = $pasErr = $firErr = $lasErr = $genErr = $dateErr = "";
        $flag = false;

        if ($_POST) {
            // include database connection
            include 'config/database.php';
            try {

                $min = 123456;

                // posted values
                if (empty($_POST["username"])) {
                    $useErr = "Username is required *";
                    $flag = true;
                } else {
                    $username = htmlspecialchars(strip_tags($_POST['username']));
                    if (strlen($_POST["username"]) < (strlen($min))) {
                        $useErr = "Username is too short *";
                    }
                }
                if (empty($_POST["password"])) {
                    $pasErr = "Password is required *";
                    $flag = true;
                } else {
                    $password = htmlspecialchars(strip_tags($_POST['password']));
                }
                if (empty($_POST["first_name"])) {
                    $firErr = "First name is required *";
                    $flag = true;
                } else {
                    $first_name = htmlspecialchars(strip_tags($_POST['first_name']));
                }
                if (empty($_POST["last_name"])) {
                    $lasErr = "Last name is required *";
                    $flag = true;
                } else {
                    $last_name = htmlspecialchars(strip_tags($_POST['last_name']));
                }
                if (empty($_POST["gender"])) {
                    $genErr = "Gender is required *";
                    $flag = true;
                } else {
                    $gender = htmlspecialchars(strip_tags($_POST['gender']));
                }
                if (empty($_POST["date_of_birth"])) {
                    $dateErr = "Date of birth is required *";
                    $flag = true;
                } else {
                    $date_of_birth = htmlspecialchars(strip_tags($_POST['date_of_birth']));
                }

                if ($flag == false) {
                    // insert query
                    $query = "INSERT INTO customers SET username=:username, password=:password, first_name=:first_name, last_name=:last_name, gender=:gender, date_of_birth=:date_of_birth, registration_date_time=:registration_date_time";
                    // prepare query for execution
                    $stmt = $con->prepare($query);
                    // bind the parameters
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':first_name', $first_name);
                    $stmt->bindParam(':last_name', $last_name);
                    $stmt->bindParam(':gender', $gender);
                    $stmt->bindParam(':date_of_birth', $date_of_birth);
                    // specify when this record was inserted to the database
                    $registration_date_time = date('Y-m-d H:i:s');
                    $stmt->bindParam(':registration_date_time', $registration_date_time);
                    // Execute the query

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record was saved.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
                }
            }
            // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <!-- html form here where the product information will be entered -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Username</td>
                    <td><span class="error"><?php echo $useErr; ?></span>
                        <input type='text' name='username' class='form-control' />
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><span class="error"><?php echo $pasErr; ?></span>
                        <input type="password" name="password" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <td>First name</td>
                    <td><span class="error"><?php echo $firErr; ?></span>
                        <input type='text' name='first_name' class='form-control' />
                    </td>
                </tr>
                <tr>
                    <td>Last name</td>
                    <td><span class="error"><?php echo $lasErr; ?></span>
                        <input type='text' name='last_name' class='form-control' />
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><span class="error"><?php echo $genErr; ?></span>
                        <input type="radio" name="gender" class="form-check-label" value="Male">
                        <label for="Male">
                            Male
                        </label>
                        <input type="radio" name="gender" class="form-check-label" value="Female">
                        <label for="Female">
                            Female
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><span class="error"><?php echo $dateErr; ?></span>
                        <input type='date' name='date_of_birth' class='form-control' />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-success' />
                        <a href='customer_read.php' class='btn btn-danger'>Back to read customers</a>
                    </td>
                </tr>
            </table>
        </form>


    </div>
    <!-- end .container -->

    <div class="container-fluid p-1 pt-3 bg-success text-white text-center">
        <p>Copyrights &copy; 2022 Online Shop. All rights reserved.</p>
    </div>

</body>

</html>