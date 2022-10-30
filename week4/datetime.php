<!DOCTYPE html>
<html>

<body>

    <?php
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $t = 12;
    echo $t . "<br>";

    if ($t >= "06" and  $t <= "11") {
        echo "good morning";
    } else if ($t >= "12" and $t <= "18") {
        echo "good afternoon" . "<br>";
        if ($t == "12") {
            echo "lunchtime";
        }
    } else {
        echo "good night";
    }
    ?>

</body>

</html>