<!DOCTYPE html>

<html>

<head>
    <style>
        .line1 {
            font-style: italic;
            color: green;
        }

        .line2 {
            font-style: italic;
            color: blue;
        }

        .line3 {
            font-weight: bold;
            color: red;
        }

        .line4 {
            font-weight: bold;
            font-style: italic;
            color: black;
        }
    </style>
</head>

<body>

    <?php
    $a =  rand(100, 200);
    $b =  rand(100, 200);

    echo "<span class=\"line1\">";
    echo $a;
    echo "</span> <br>";

    echo "<span class=\"line2\">";
    echo $b;
    echo "</span> <br>";

    echo "<span class=\"line3\">";
    echo ($a + $b);
    echo "</span> <br>";

    echo "<span class=\"line4\">";
    echo ($a * $b);
    echo "</span> <br>";
    ?>

</body>

</html>