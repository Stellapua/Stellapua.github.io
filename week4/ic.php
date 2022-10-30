<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ic</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php
    $ic = "020521-14-0200";

    $date = substr("$ic", 4, 2);
    $month = substr("$ic", 2, 2);
    $dob = substr("$ic", 0, 6);
    $gender = substr("$ic", 13, 1);
    ?>

    <div class="alert alert-dark text-center mt-5 " role="alert">
        <?php
        if ($gender % 2 == 0) {
            echo "Ms" . "<br>";
        } else {
            echo "Mr" . "<br>";
        }
        ?>
    </div>

    <div class="alert alert-dark text-center mt-5 " role="alert">
        <?php
        $icdob = date_create_from_format("ymd", $dob);
        echo date_format($icdob, "M d, Y");
        ?>
    </div>

    <div class="alert alert-dark text-center mt-5 " role="alert">

        <?php
        if (($month == 03 and $date >= 21) or ($month == 04 and $date <= 19)) {
            echo "Aries" . "<br>";
        ?>
            <img src="Images/aries.jpg" class="rounded " alt="img1">
        <?php
        } else if (($month == 04 and $date >= 20) or ($month == 05 and $date <= 20)) {
            echo "Taurus" . "<br>";
        ?>
            <img src="Images/taurus.jpg" class="rounded " alt="img2">
        <?php
        } else if (($month == 05 and $date >= 21) or ($month == 06 and $date <= 20)) {
            echo "Gemini" . "<br>";
        ?>
            <img src="Images/gemini.jpg" class="rounded " alt="img3">
        <?php
        } else if (($month == 06 and $date >= 21) or ($month == 07 and $date <= 22)) {
            echo "Cancer" . "<br>";
        ?>
            <img src="Images/cancer.jpg" class="rounded " alt="img4">
        <?php
        } else if (($month == 07 and $date >= 23) or ($month == 8 and $date <= 22)) {
            echo "Leo" . "<br>";
        ?>
            <img src="Images/leo.jpg" class="rounded " alt="img5">
        <?php
        } else if (($month == 8 and $date >= 23) or ($month == 9 and $date <= 22)) {
            echo "Vigro" . "<br>";
        ?>
            <img src="Images/vigro.jpg" class="rounded " alt="img6">
        <?php
        } else if (($month == 9 and $date >= 23) or ($month == 10 and $date <= 22)) {
            echo "Libra" . "<br>";
        ?>
            <img src="Images/libra.jpg" class="rounded " alt="img7">
        <?php
        } else if (($month == 10 and $date >= 23) or ($month == 11 and $date <= 21)) {
            echo "Scorpio" . "<br>";
        ?>
            <img src="Images/scorpio.jpg" class="rounded " alt="img8">
        <?php
        } else if (($month == 11 and $date >= 22) or ($month == 12 and $date <= 21)) {
            echo "Sagittarius" . "<br>"; ?>
            <img src="Images/sagittarius.jpg" class="rounded " alt="img9">
        <?php
        } else if (($month == 12 and $date >= 22) or ($month == 01 and $date <= 19)) {
            echo "Capricorn" . "<br>";
        ?>
            <img src="Images/capricorn.jpg" class="rounded " alt="img10">
        <?php
        } else if (($month == 01 and $date >= 20) or ($month == 02 and $date <= 18)) {
            echo "Aquarius" . "<br>";
        ?>
            <img src="Images/aquarius.jpg" class="rounded " alt="img11">
        <?php
        } else if (($month == 02 and $date >= 19) or ($month == 03 and $date <= 20)) {
            echo "Pisces" . "<br>";
        ?>
            <img src="Images/pisces.jpg" class="rounded " alt="img12">
        <?php
        }
        ?>

    </div>

</body>

<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>