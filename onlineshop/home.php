<!DOCTYPE html>

<!DOCTYPE HTML>
<html>

<head>
    <title>Home</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>home</title>

    <style>

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <?php
    include 'session.php';
    include 'menu.php';
    ?>

    <div class="container-fluid text-center p-5 mt-5 ">
        <div class="row align-item-center">
            <div class="col-12">
                <h1>PLANT WHOLESALE ONLINE SHOP</h1>
                <h5>We provide plants for indoor and outdoor with total of 200 species you can find in the Malaysia.</h5>
            </div>
        </div>
    </div>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Images/plant4.jpg" class="d-block w-100" alt="p1">
            </div>
            <div class="carousel-item">
                <img src="Images/plant1.jpg" class="d-block w-100" alt="p2">
            </div>
            <div class="carousel-item">
                <img src="Images/plant2.jpg" class="d-block w-100" alt="p3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container-fluid text-center p-5 mt-5 ">
        <div class="row align-item-center">
            <div class="col-12">
                <h1>WANT TO SELL</h1>
                <h5>You can also sell your plant to us as a busniness.</h5>
            </div>
        </div>
        <div class="col text-center">
            <a class="btn btn-outline-success m-2" href="contact_us.php" role="button">CONTACT</a>
        </div>
        <div class="col-12 mt-5">
            <h5>Click here to logout</h5>
        </div>
        <div class="col text-center">
            <a class="btn btn-danger mt-2" href="logout.php" role="button">LOGOUT</a>
        </div>
    </div>

    <?php
    include 'copyright.php';
    ?>

</body>

</html>