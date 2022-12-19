
<?php

// include database connection
include 'config/database.php';
try {

    $flag = false;

    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

    $query = "SELECT product_id, order_detail_id FROM order_detail ORDER BY order_detail_id DESC";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $num = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $product_id = $row['product_id'];

    if ($num > 0) {
        if ($id == $product_id) {
            $flag = true;
        }
    } else {
        die('ERROR: Product ID not found.');
    }

    if ($flag == false) {
        // delete query
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            // redirect to read records page and
            // tell the user record was deleted
            header('Location:product_read.php?action=deleted');
        } else {
            die('Unable to delete record.');
        }
    } else {
        header('Location:product_read.php?action=failed');
    }
}
// show error
catch (PDOException $exception) {
    die('ERROR: ' . $exception->getMessage());
}

?>