<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercise 2</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        p {
            font-size: 50px;
        }

        .bigger {
            font-weight: bold;
            font-size: 60px;
            color: white;
        }
    </style>
</head>

<body>

    <?php
    $a = rand(10, 100);
    $b = rand(10, 100);
    ?>

    <div class="container text-center p-5 ">
        <div class="row justify-content-center text-black">
            <div class="col-2 bg-success">
                <p>
                    <?php
                    if ($a > $b) {
                        echo "<span class=\"bigger\">";
                        echo $a;
                        echo "</span>";
                    } else {
                        echo $a;
                    }
                    ?>
                </p>

            </div>
            <div class="col-2 bg-primary">
                <p>
                    <?php
                    if ($b > $a) {
                        echo "<span class=\"bigger\">";
                        echo $b;
                        echo "</span>";
                    } else {
                        echo $b;
                    }
                    ?>
                </p>

            </div>
        </div>
    </div>

</body>

<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>