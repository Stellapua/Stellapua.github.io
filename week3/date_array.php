<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homework 1</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php
    $a = 1;
    $b = 31;

    for ($d = $a; $d <= $b; $d++) {
    }

    $d = 1990;
    $e = 2022;

    for ($y = $d; $y <= $e; $y++) {
    }
    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    ?>

    <div class="row justify-content-center p-5">
        <div class="col-2 btn-group">
            <button class="btn btn-info btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                DAY
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"> <?php echo implode(range($a, $b)); ?> </a></li>
            </ul>
        </div>

        <div class="col-2 btn-group">
            <button class="btn btn-info btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                MONTH
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"> <?php echo $months[0]; ?> </a></li>
                <li><a class="dropdown-item" href="#"> <?php echo $months[1]; ?> </a></li>
                <li><a class="dropdown-item" href="#"> <?php echo $months[2]; ?> </a></li>
                <li><a class="dropdown-item" href="#"> <?php echo $months[3]; ?> </a></li>
                <li><a class="dropdown-item" href="#"> <?php echo $months[4]; ?> </a></li>
                <li><a class="dropdown-item" href="#"> <?php echo $months[5]; ?> </a></li>
                <li><a class="dropdown-item" href="#"> <?php echo $months[6]; ?> </a></li>
                <li><a class="dropdown-item" href="#"> <?php echo $months[7]; ?> </a></li>
                <li><a class="dropdown-item" href="#"> <?php echo $months[8]; ?> </a></li>
                <li><a class="dropdown-item" href="#"> <?php echo $months[9]; ?> </a></li>
                <li><a class="dropdown-item" href="#"> <?php echo $months[10]; ?> </a></li>
                <li><a class="dropdown-item" href="#"> <?php echo $months[11]; ?> </a></li>
            </ul>
        </div>

        <div class="col-2 btn-group">
            <button class="btn btn-info btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                YEAR
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"> <?php echo implode(range($d, $e)); ?> </a></li>
            </ul>
        </div>
    </div>



</body>

<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>