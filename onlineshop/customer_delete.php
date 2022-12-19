<?php

// include database connection
include 'config/database.php';
try {

    $flag = false;

    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $cus_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die('ERROR: Record ID not found.');

    $query = "SELECT customer_id, order_id FROM order_summary ORDER BY order_id DESC";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $num = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $customer_id = $row['customer_id'];

    if ($num > 0) {
        if ($cus_id == $customer_id) {
            $flag = true;
        }
    } else {
        die('ERROR: Product ID not found.');
    }

    if ($flag == false) {
        // delete query
        $query = "DELETE FROM customers WHERE customer_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $cus_id);

        if ($stmt->execute()) {
            // redirect to read records page and
            // tell the user record was deleted
            header('Location:customer_read.php?action=deleted');
        } else {
            die('Unable to delete record.');
        }
    } else {
        header('Location:customer_read.php?action=failed');
    }
}
// show error
catch (PDOException $exception) {
    die('ERROR: ' . $exception->getMessage());
}
