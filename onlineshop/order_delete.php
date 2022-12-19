
<?php

// include database connection
include 'config/database.php';
try {

    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die('ERROR: Record Order ID not found.');

    // delete query
    $query = "DELETE FROM order_summary WHERE order_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $order_id);

    if ($stmt->execute()) {

        $query = "DELETE FROM order_detail WHERE order_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $order_id);

        if ($stmt->execute()) {
            header('Location:order_read.php?action=deleted');
        } else {
            die('Unable to delete in order summary.');
        }
    } else {
        die('Unable to delete in order detail.');
    }
}
// show error
catch (PDOException $exception) {
    die('ERROR: ' . $exception->getMessage());
}

?>