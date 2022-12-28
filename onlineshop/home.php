<?php
include 'session.php';
?>

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
    include 'menu.php';
    ?>

    <div class="container-fluid text-center p-5 mt-5 ">
        <div class="row align-item-center ">
            <div class="col-12">
                <h2>PLANT WHOLESALE ONLINE SHOP</h2>
                <h5>We provide plants and flowers for both indoor and outdoor with total of 200 species you can find in the Malaysia.</h5>
            </div>
        </div>
    </div>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Images/plant7.jpg" class="d-block w-100" alt="p1">
            </div>
            <div class="carousel-item">
                <img src="Images/plant3.jpg" class="d-block w-100" alt="p2">
            </div>
            <div class="carousel-item">
                <img src="Images/plant6.jpg" class="d-block w-100" alt="p3">
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
        <div class="row align-item-center ">
            <div class="col-12">
                <h3>About Us</h3>
                <p>Established since 2002 in Cheras, we has evolved into becoming a full range of landscaping plants nursery, grower, trader and wholesaler in Malaysia. Our garden plants nursery nurture & grow a variety of tropical palms, trees, bamboos, shrubs and ground covers. With years of experiences in plant nurturing, plant nursery management and landscaping business, we always strive to provide quality plants and services to our valuable customers.</p>
            </div>
        </div>
    </div>

    <div class="container-fluid text-center p-5 bg-success">
    </div>

    <div class="container-fluid text-center p-5 mt-5 ">
        <div class="container mx-auto mt-4">
            <div class="row">
                <h3>Our Products</h3>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="Images/tulip.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Tulip</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Best Selling Top 1</h6>
                            <p class="card-text">Tulips are a genus of spring-blooming perennial herbaceous bulbiferous geophytes.</p>
                            <a class="btn btn-success m-2" href="create_order.php" role="button">BUY IT NOW</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="Images/rose.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Rose</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Best Selling Top 2</h6>
                            <p class="card-text">A rose is either a woody perennial flowering plant of the genus Rosa, in the family Rosaceae.</p>
                            <a class="btn btn-success m-2" href="create_order.php" role="button">BUY IT NOW</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="Images/lily.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Lily</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Best Selling Top 3</h6>
                            <p class="card-text">Lilium is a genus of herbaceous flowering plants growing from bulbs.</p>
                            <a class="btn btn-success m-2" href="create_order.php" role="button">BUY IT NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="Images/coconut.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Coconut Tree</h5>
                            <p class="card-text">Cocos nucifera is a large palm, growing up to 30 metres (100 feet) tall.</p>
                            <a class="btn btn-success m-2" href="create_order.php" role="button">BUY IT NOW</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="Images/hibiscus.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Hibiscus</h5>
                            <p class="card-text">Hibiscus is a genus of flowering plants in the mallow family, Malvaceae.</p>
                            <a class="btn btn-success m-2" href="create_order.php" role="button">BUY IT NOW</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="Images/palm.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Palm Tree</h5>
                            <p class="card-text">A family of perennial flowering plants in the monocot order Arecales. .</p>
                            <a class="btn btn-success m-2" href="create_order.php" role="button">BUY IT NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid text-center p-5 bg-success">
    </div>

    <div class="container-fluid text-center p-5 mt-5 ">
        <div class="row align-item-center">
            <div class="col-12">
                <h2>WANT TO SELL</h2>
                <h5>You can also sell your plant to us as a busniness.</h5>
            </div>
        </div>
        <div class="col text-center">
            <a class="btn btn-outline-success m-2" href="contact_us.php" role="button">CONTACT</a>
        </div>
    </div>

    <?php
    include 'copyright.php';
    ?>

</body>

</html>