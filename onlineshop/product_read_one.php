<?php
include 'session.php';
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Read Product</title>
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
            <h1>Read Product</h1>
        </div>


        <!-- PHP read one record will be here -->
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

        <!-- HTML read one record table will be here -->
        <!--we have our html table here where the record will be displayed-->
        <div class='row justify-content-center mt-5'>
            <div class='col-auto'>
                <table class='table table-hover table-responsive table-bordered text-center'>
                    <tr>
                        <td>Name</td>
                        <td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><?php if (htmlspecialchars($description, ENT_QUOTES) == NULL) {
                                echo "-";
                            } else {
                                echo htmlspecialchars($description, ENT_QUOTES);
                            }; ?></td>
                    </tr>
                    <tr>
                        <td>Price (RM)</td>
                        <td><?php echo number_format((float)htmlspecialchars($price, ENT_QUOTES), 2, '.', '');  ?></td>
                    </tr>
                    <tr>
                        <td>Promotion Price (RM)</td>
                        <td><?php if (htmlspecialchars($promotion_price, ENT_QUOTES) == NULL) {
                                echo "-";
                            } else {
                                echo number_format((float)htmlspecialchars($promotion_price, ENT_QUOTES), 2, '.', '');
                            }; ?></td>
                    </tr>
                    <tr>
                        <td>Manufacture Date</td>
                        <td><?php echo htmlspecialchars($manufacture_date, ENT_QUOTES);  ?></td>
                    </tr>
                    <tr>
                        <td>Expired Date</td>
                        <td><?php if (htmlspecialchars($expired_date, ENT_QUOTES) == NULL) {
                                echo "-";
                            } else {
                                echo htmlspecialchars($expired_date, ENT_QUOTES);
                            }; ?></td>
                    </tr>
                </table>
                <div class='row justify-content-center mt-5'>
                    <div class='col-auto'>
                        <a href='product_read.php' class='btn btn-danger p-3'>Back to read products</a>
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