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

    <nav class="navbar navbar-dark bg-success fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand " href="#">Online Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-success " tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Online Shop</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 ">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="product_create.php">Create Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="contact_us.php">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

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
            <a class="btn btn-outline-success mb-2" href="contact_us.php" role="button">CONTACT</a>
        </div>
    </div>

    <div class="container-fluid p-1 pt-3 bg-success text-white text-center">
        <p>Copyrights &copy; 2022 Online Shop. All rights reserved.</p>
    </div>

</body>
<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>