<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homework 2</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php

    for ($d = 1; $d <= 31; $d++) {
    }

    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

    for ($y = 1990; $y <= 2022; $y++) {
    }

    ?>

    <div class="row justify-content-center p-5">
        <div class="col-2 ">
            <select class="form-select form-select-lg mb-3 bg-info " aria-label=".form-select-lg example">
                <option selected>DAY</option>
                <option value="1"><?php  ?></option>

            </select>
        </div>


        <div class="col-2 ">
            <select class="form-select form-select-lg mb-3 bg-warning " aria-label=".form-select-lg example">
                <option selected>MONTH</option>
                <option value="1"><?php echo $months[0]; ?></option>
                <option value="1"><?php echo $months[1]; ?></option>
                <option value="1"><?php echo $months[2]; ?></option>
                <option value="1"><?php echo $months[3]; ?></option>
                <option value="1"><?php echo $months[4]; ?></option>
                <option value="1"><?php echo $months[5]; ?></option>
                <option value="1"><?php echo $months[6]; ?></option>
                <option value="1"><?php echo $months[7]; ?></option>
                <option value="1"><?php echo $months[8]; ?></option>
                <option value="1"><?php echo $months[9]; ?></option>
                <option value="1"><?php echo $months[10]; ?></option>
                <option value="1"><?php echo $months[11]; ?></option>
            </select>
        </div>

        <div class="col-2 ">
            <select class="form-select form-select-lg mb-3 bg-danger " aria-label=".form-select-lg example">
                <option selected>YEAR</option>
                <option value="1"><?php  ?></option>

            </select>
        </div>
    </div>


</body>

<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>