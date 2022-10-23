<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercise 3</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <div class="alert alert-success mt-5" role="alert">
        <?php

        $sum = 0;

        for ($x = 1; $x <= 100; $x++) {
            $sum += $x;

            if ($x % 2 == 0) {
                echo "<strong>" . $x . "</strong>";
                if ($x < 100) {
                    echo "+";
                }
            } else {
                echo $x, "+";
            }
        }

        echo "=" . $sum;
        ?>
    </div>

</body>

<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>