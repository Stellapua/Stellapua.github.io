<?php
include 'session.php';
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Create Customer</title>
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

    <?php
    include 'menu.php';
    ?>

    <!-- container -->
    <div class="container mt-5 p-5">
        <div class="page-header text-center">
            <h1>Create Customer</h1>
        </div>

        <!-- html form to create product will be here -->
        <!-- PHP insert code will be here -->

        <?php
        $useErr = $pasErr = $firErr = $lasErr = $genErr = $dateErr = $conErr = "";
        $flag = false;

        if ($_POST) {
            // include database connection
            include 'config/database.php';
            try {

                // posted values
                if (empty($_POST["username"])) {
                    $useErr = "Username is required *";
                    $flag = true;
                } else {
                    $username = htmlspecialchars(strip_tags($_POST['username']));
                    if (strlen($_POST["username"]) < 6) {
                        $useErr = "Username is too short *";
                        $flag = true;
                    }
                }
                if (empty($_POST["password"])) {
                    $pasErr = "Password is required *";
                    $flag = true;
                } else {
                    $password = md5($_POST['password']);
                }
                if (empty($_POST["confirm_password"])) {
                    $conErr = "Please comfirm your password *";
                } else {
                    $confirm_password = ($_POST['confirm_password']);
                    if (($_POST['password']) != ($_POST['confirm_password'])) {
                        $conErr = "Please type the correct password *";
                        $flag = true;
                    }
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

                    $date2 = date("Y-m-d");
                    $diff = (strtotime($date2) - strtotime($date_of_birth));
                    $years = floor($diff / (365 * 60 * 60 * 24));

                    if ($years < 18) {
                        $dateErr = "Your age should above 18 *";
                        $flag = true;
                    }
                }

                $query = "SELECT username FROM customers WHERE username=:username";
                $stmt = $con->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                $num = $stmt->rowCount();

                if ($num > 0) {
                    $useErr = "Username has been taken *";
                    $flag = true;
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
                        header('Location:customer_read.php?action=done');
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
                        <input type='text' name='username' class='form-control' value='<?php if (isset($_POST['username'])) {
                                                                                            echo $_POST['username'];
                                                                                        } ?>' />
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><span class="error"><?php echo $pasErr; ?></span>
                        <input type="password" name="password" class="form-control" value='<?php if (isset($_POST['password'])) {
                                                                                                echo $_POST['password'];
                                                                                            } ?>' />
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><span class="error"><?php echo $conErr; ?></span>
                        <input type="password" name="confirm_password" class="form-control" value='<?php if (isset($_POST['confirm_password'])) {
                                                                                                        echo $_POST['confirm_password'];
                                                                                                    } ?>' />
                    </td>
                </tr>
                <tr>
                    <td>First name</td>
                    <td><span class="error"><?php echo $firErr; ?></span>
                        <input type='text' name='first_name' class='form-control' value='<?php if (isset($_POST['first_name'])) {
                                                                                                echo $_POST['first_name'];
                                                                                            } ?>' />
                    </td>
                </tr>
                <tr>
                    <td>Last name</td>
                    <td><span class="error"><?php echo $lasErr; ?></span>
                        <input type='text' name='last_name' class='form-control' value='<?php if (isset($_POST['last_name'])) {
                                                                                            echo $_POST['last_name'];
                                                                                        } ?>' />
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><span class="error"><?php echo $genErr; ?></span>
                        <input type="radio" name="gender" class="form-check-label" value="Male" <?php if (isset($_POST['gender'])) {
                                                                                                    if (($_POST['gender']) == 'Male') {
                                                                                                        echo "checked";
                                                                                                    }
                                                                                                } ?>>
                        <label for="Male">
                            Male
                        </label>
                        <input type="radio" name="gender" class="form-check-label" value="Female" <?php if (isset($_POST['gender'])) {
                                                                                                        if (($_POST['gender']) == 'Female') {
                                                                                                            echo "checked";
                                                                                                        }
                                                                                                    } ?>>
                        <label for="Female">
                            Female
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><span class="error"><?php echo $dateErr; ?></span>
                        <input type='date' name='date_of_birth' class='form-control' value='<?php if (isset($_POST['date_of_birth'])) {
                                                                                                echo $_POST['date_of_birth'];
                                                                                            } ?>' />
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

    <?php
    include 'copyright.php';
    ?>

</body>

</html>