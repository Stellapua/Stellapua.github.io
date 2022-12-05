<?php
include 'session.php';
?>

<!DOCTYPE HTML>

<html>

<head>

    <title>Update Products</title>

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
    <div class="container ">
        <div class="page-header text-center mt-5 pt-5">
            <h1>Update Products</h1>
        </div>

        <!-- PHP read record by ID will be here -->

        <?php
        // get passed parameter value, in this case, the record ID

        // isset() is a PHP function used to verify if a value is there or not
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        //include database connection
        include 'config/database.php';

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT id, name, description, price, promotion_price, manufacture_date, expired_date FROM products WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $id);
            // execute our query
            $stmt->execute();
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $promotion_price = $row['promotion_price'];
            $manufacture_date = $row['manufacture_date'];
            $expired_date = $row['expired_date'];
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <!-- HTML form to update record will be here -->
        <!-- PHP post to update record will be here -->
        <?php
        $nameErr = $priErr = $proErr = $manuErr = $exErr = "";
        $flag = false;

        // check if form was submitted
        if ($_POST) {
            try {
                // posted values
                if (empty($_POST["name"])) {
                    $nameErr = "Name is required *";
                    $flag = true;
                } else {
                    $name = htmlspecialchars(strip_tags($_POST['name']));
                }

                $description = htmlspecialchars(strip_tags($_POST['description']));

                if (empty($_POST["price"])) {
                    $priErr = "Price is required *";
                    $flag = true;
                } else {
                    $price = htmlspecialchars(strip_tags($_POST['price']));
                }

                $promotion_price = htmlspecialchars(strip_tags($_POST['promotion_price']));
                if (($_POST["promotion_price"]) > ($_POST['price'])) {
                    $proErr = "Promotion price should be cheaper than original price *";
                    $flag = true;
                }

                $manufacture_date = htmlspecialchars(strip_tags($_POST['manufacture_date']));

                $expired_date = htmlspecialchars(strip_tags($_POST['expired_date']));

                if (($_POST["expired_date"]) < ($_POST['manufacture_date'])) {
                    $exErr = "Expired date should be later than manufacture date *";
                    $flag = true;
                }

                if ($flag == false) {
                    // write update query
                    // in this case, it seemed like we have so many fields to pass and
                    // it is better to label them and not use question marks
                    $query = "UPDATE products SET name=:name, description=:description, price=:price, promotion_price=:promotion_price, manufacture_date=:manufacture_date, expired_date=:expired_date WHERE id = :id";
                    // prepare query for excecution
                    $stmt = $con->prepare($query);
                    // bind the parameters
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':promotion_price', $promotion_price);
                    $stmt->bindParam(':manufacture_date', $manufacture_date);
                    $stmt->bindParam(':expired_date', $expired_date);
                    $stmt->bindParam(':id', $id);
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <div class='row justify-content-center mt-1'>
                <div class='col-auto'>
                    <table class='table table-hover table-responsive table-bordered'>
                        <tr>
                            <td>Name</td>
                            <td><span class="error"><?php echo $nameErr; ?></span>
                                <input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><span class="error"><?php echo $priErr; ?></span>
                                <input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>" class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td>Promotion Price</td>
                            <td><span class="error"><?php echo $proErr; ?></span>
                                <input type='text' name='promotion_price' value="<?php echo htmlspecialchars($promotion_price, ENT_QUOTES);  ?>" class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td>Manufacture Date</td>
                            <td><span class="error"><?php echo $manuErr; ?></span>
                                <input type='date' name='manufacture_date' value="<?php echo htmlspecialchars($manufacture_date, ENT_QUOTES);  ?>" class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td>Expired Date</td>
                            <td><span class="error"><?php echo $exErr; ?></span>
                                <input type='date' name='expired_date' value="<?php echo htmlspecialchars($expired_date, ENT_QUOTES);  ?>" class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type='submit' value='Save Changes' class='btn btn-primary' />
                                <a href='product_read.php' class='btn btn-danger'>Back to read products</a>
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