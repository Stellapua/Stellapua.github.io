<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>date today</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php
    $date = new DateTime();
    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    ?>

    <div class="row justify-content-center p-5">
        <div class="col-2 ">
            <select class="form-select form-select-lg mb-3 bg-info " aria-label=".form-select-lg example">
                <option selected>Day</option>

                <?php for ($d = 1; $d <= 31; $d++) {
                    $tday = ($d == $date->format('d')) ? 'selected' : '';
                ?>
                    <option <?php echo $tday; ?> value="<?php echo $d; ?>"><?php echo $d; ?></option>
                <?php } ?>

            </select>
        </div>

        <div class="col-2 ">
            <select class="form-select form-select-lg mb-3 bg-warning " aria-label=".form-select-lg example">
                <option selected>MONTH</option>

                <?php foreach ($months as $m) {
                    $tmonth = ($m == $date->format('F')) ? 'selected' : '';
                ?>
                    <option <?php echo $tmonth; ?> value="<?php echo $m; ?>"><?php echo $m; ?></option>
                <?php } ?>

            </select>
        </div>

        <div class="col-2 ">
            <select class="form-select form-select-lg mb-3 bg-danger " aria-label=".form-select-lg example">
                <option selected>YEAR</option>

                <?php for ($y = 1990; $y <= 2022; $y++) {
                    $tyear = ($y == $date->format('Y')) ? 'selected' : '';
                ?>

                    <option <?php echo $tyear; ?> value="<?php echo $y; ?>"><?php echo $y; ?></option>

                <?php } ?>

            </select>
        </div>
    </div>

</body>

<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>