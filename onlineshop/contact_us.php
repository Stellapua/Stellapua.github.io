<!DOCTYPE html>

<!DOCTYPE HTML>
<html>

<head>
    <title>Contact Us</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>contact us</title>

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
                            <a class="nav-link " href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="product_create.php">Create Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active " aria-current="page" href="contact_us.php">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid text-center p-5 mt-5 ">
        <div class="row align-item-center">
            <div class="col-12">
                <h1>Interested?</h1>
                <h5>FILL UP YOUR INFORMATION </h5>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 ">
            <form>
                <div class="mb-3 ">
                    <label for="exampleInputEmail1" class="form-label "><strong>EMAIL ADDRESS</strong></label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3 ">
                    <label for="product" class="form-label"><strong>PRODUCT TYPE</strong></label>
                    <input type="email" class="form-control" id="product">
                    <div id="emailHelp" class="form-text">The product you want to sell</div>
                </div>
                <div class="mb-3 ">
                    <label for="description" class="form-label"><strong>DESCRIPTION</strong></label>
                    <textarea name='description' class='form-control'></textarea>
                    <div id="emailHelp" class="form-text">Introduce your product</div>
                </div>
                <button type="submit" class="btn btn-outline-success mb-5">Submit</button>
            </form>
        </div>
    </div>

    <div class="container-fluid text-center text-white bg-success p-5 mt-5 ">
        <div class="row align-item-center">
            <div class="col-12">
                <h1>Or </h1>
                <h5>CREATE YOUR PRODUCT NOW</h5>
            </div>
        </div>
        <div class="col text-center">
            <a class="btn btn-outline-white mb-2" href="product_create.php" role="button">CREATE</a>
        </div>

    </div>

    <div class="container-fluid p-1 pt-3 bg-white text-success text-center">
        <p>Copyrights &copy; 2022 Online Shop. All rights reserved.</p>
    </div>


</body>
<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>