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
    <div class="container-fluid mt-5 pt-5">
        <div class="page-header text-center">
            <h1>Update Order</h1>
        </div>

        <!-- PHP read record by ID will be here -->

        <?php
        //include database connection
        include 'config/database.php';

        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die('ERROR: Record Customer ID not found.');

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT customer_id, username, password, first_name, last_name, gender, date_of_birth FROM customers WHERE order_id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $order_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $username = $row['username'];
        }
        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <?php
        $pasErr = "";
        $flag = false;

        if ($_POST) {
            try {
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?customer_id={$order_id}"); ?>" method="post">
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
                            <td></td>
                            <td>
                                <input type='submit' value='Save Changes' class='btn btn-primary' />
                                <a href='order_read.php' class='btn btn-danger'>Back to order list</a>
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