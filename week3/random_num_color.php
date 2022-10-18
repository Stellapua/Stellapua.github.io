<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio Website</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

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
    ?>

    <div class="container text-center mt-5">
        <div class="row justify-content-center p-5 text-white">
            <div class="col-4 bg-success">
                <h1>
                    <?php
                    if ($a > $b) {
                        echo "<span class=\"bigger\">";
                        echo $a;
                        echo "</span>";
                    } else {
                        echo $a;
                    }
                    ?>
                </h1>

            </div>
            <div class="col-4 bg-primary">
                <h1>
                    <?php
                    if ($b > $a) {
                        echo "<span class=\"bigger\">";
                        echo $b;
                        echo "</span>";
                    } else {
                        echo $b;
                    }
                    ?>
                </h1>

            </div>
        </div>
    </div>

</body>

<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>