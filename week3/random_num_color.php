<!DOCTYPE html>

<html>

<head>
    <style>
        .bigger {
            font-weight: bold;
            font-size: larger;
        }
    </style>
</head>

<body>

    <?php
    $a = rand(10, 100);
    $b = rand(10, 100);

    if ($a > $b) {
        echo "<span class=\"bigger\">";
        echo $a;
        echo "</span>";
        echo $b;
    } else {
        echo "<span class=\"bigger\">";
        echo $b;
        echo "</span>";
        echo $a;
    }

    ?>

</body>

</html>