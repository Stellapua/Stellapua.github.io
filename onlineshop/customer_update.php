<?php
include 'session.php';
?>

<!DOCTYPE HTML>

<html>

<head>

    <title>Update Customers</title>

    <!-- Latest compiled and minified Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .error {
            color: red;
        }
    </style>

</head>

<body>

    <?php
    include 'menu.php';
    ?>

    <!-- container -->
    <div class="container mt-5 pt-5">
        <div class="page-header text-center">
            <h1>Update Customers</h1>
        </div>

        <!-- PHP read record by ID will be here -->

        <?php
        //include database connection
        include 'config/database.php';

        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die('ERROR: Record Customer ID not found.');

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT customer_id, username, password, first_name, last_name, gender, date_of_birth FROM customers WHERE customer_id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $customer_id);
            // execute our query
            $stmt->execute();
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $username = $row['username'];
            $password = $row['password'];
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

        <!-- HTML form to update record will be here -->
        <!-- PHP post to update record will be here -->

        <?php
        $pasErr = $firErr = $lasErr = $genErr = $dateErr = $conErr = $oldErr =  "";
        $flag = false;

        // check if form was submitted
        if ($_POST) {
            try {

                // posted values

                if (!empty($_POST["password"]) or !empty($_POST["old_password"]) or !empty($_POST["comfirm_password"])) {

                    if (md5($_POST['old_password']) == $password) {

                        if (md5($_POST['old_password']) == md5($_POST['password'])) {
                            $pasErr = "New password cannot be the same as your old password";
                            $flag = true;
                        } else {
                            $password = md5($_POST['password']);
                        }
                        if (empty($_POST["comfirm_password"])) {
                            $conErr = "Please comfirm your password *";
                            $flag = true;
                        } else {
                            $comfirm_password = ($_POST['comfirm_password']);
                            if (($_POST['password']) != ($_POST['comfirm_password'])) {
                                $conErr = "Please type the correct new password *";
                                $flag = true;
                            }
                        }
                    } else {
                        $oldErr = "Please type you old password *";
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

                $gender = htmlspecialchars(strip_tags($_POST['gender']));
                $date_of_birth = htmlspecialchars(strip_tags($_POST['date_of_birth']));

                $date2 = date("Y-m-d");
                $diff = (strtotime($date2) - strtotime($date_of_birth));
                $years = floor($diff / (365 * 60 * 60 * 24));

                if ($years < 18) {
                    $dateErr = "Your age should above 18 *";
                    $flag = true;
                }

                if ($flag == false) {
                    // write update query
                    // in this case, it seemed like we have so many fields to pass and
                    // it is better to label them and not use question marks
                    $query = "UPDATE customers SET password=:password, first_name=:first_name, last_name=:last_name, gender=:gender, date_of_birth=:date_of_birth WHERE customer_id =:customer_id";
                    // prepare query for excecution
                    $stmt = $con->prepare($query);
                    // bind the parameters
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':first_name', $first_name);
                    $stmt->bindParam(':last_name', $last_name);
                    $stmt->bindParam(':gender', $gender);
                    $stmt->bindParam(':date_of_birth', $date_of_birth);
                    $stmt->bindParam(':customer_id', $customer_id);

                    // Execute the query
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record was updated.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                }
            }
            // show errors
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        } ?>

        <!--we have our html form here where new record information can be updated-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?customer_id={$customer_id}"); ?>" method="post">
            <div class='row justify-content-center mt-1'>
                <div class='col-auto'>
                    <table class='table table-hover table-responsive table-bordered'>
                        <tr>
                            <td>Username</td>
                            <td>
                                <?php echo htmlspecialchars($username, ENT_QUOTES);  ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Old Password</td>
                            <td><span class="error"><?php echo $oldErr; ?></span>
                                <input type='password' name='old_password' class='form-control' value='<?php if (isset($_POST['old_password'])) {
                                                                                                            echo $_POST['old_password'];
                                                                                                        } ?>' />
                            </td>
                        </tr>
                        <tr>
                            <td>New Password</td>
                            <td><span class="error"><?php echo $pasErr; ?></span>
                                <input type='password' name='password' class='form-control' value='<?php if (isset($_POST['password'])) {
                                                                                                        echo $_POST['password'];
                                                                                                    } ?>' />
                            </td>
                        </tr>
                        <tr>
                            <td>Comfirm Password</td>
                            <td><span class="error"><?php echo $conErr; ?></span>
                                <input type='password' name='comfirm_password' class='form-control' value='<?php if (isset($_POST['comfirm_password'])) {
                                                                                                                echo $_POST['comfirm_password'];
                                                                                                            } ?>' />
                            </td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><span class="error"><?php echo $firErr; ?></span>
                                <input type='text' name='first_name' value="<?php echo htmlspecialchars($first_name, ENT_QUOTES);  ?>" class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><span class="error"><?php echo $lasErr; ?></span>
                                <input type='text' name='last_name' value="<?php echo htmlspecialchars($last_name, ENT_QUOTES);  ?>" class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>
                                <input type="radio" name="gender" class="form-check-label" value="Male" <?php if ($gender == 'Male') {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                                <label for="Male">
                                    Male
                                </label>
                                <input type="radio" name="gender" class="form-check-label" value="Female" <?php if ($gender == 'Female') {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                                <label for="Female">
                                    Female
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Date Of Birth</td>
                            <td><span class="error"><?php echo $dateErr; ?></span>
                                <input type='date' name='date_of_birth' value="<?php echo htmlspecialchars($date_of_birth, ENT_QUOTES);  ?>" class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type='submit' value='Save Changes' class='btn btn-primary' />
                                <a href='customer_read.php' class='btn btn-danger'>Back to read customers</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>

    </div>
    <!-- end .container -->

    <?php
    include 'copyright.php';
    ?>

</body>

</html>