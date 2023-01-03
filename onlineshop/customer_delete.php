<?php

// include database connection
include 'config/database.php';
try {

    $flag = false;

    $customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die('ERROR: Record ID not found.');

    $query = "SELECT o.customer_id, c.customer_id FROM order_summary o INNER JOIN customers c ON c.customer_id = o.customer_id WHERE o.customer_id = ? LIMIT 0,1";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $customer_id);
    $stmt->execute();
    $num = $stmt->rowCount();

    if ($num > 0) {
        header('Location:customer_read.php?action=failed');
    } else {
        // delete query
        $query = "DELETE FROM customers WHERE customer_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $customer_id);

        if ($stmt->execute()) {
            header('Location:customer_read.php?action=deleted');
        } else {
            die('Unable to delete record.');
        }
    }
}
// show error
catch (PDOException $exception) {
    die('ERROR: ' . $exception->getMessage());
}
