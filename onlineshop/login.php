<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .error {
            color: red;
        }
    </style>

</head>

<body>

    <?php
    session_start();

    $useErr =  $pasErr = $staErr = "";

    if ($_POST) {

        include 'config/database.php';

        $username = htmlspecialchars(strip_tags($_POST['username']));

        $query = "SELECT password, account_status FROM customers WHERE username=:username";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $password = $row['password'];
            $account_status = $row['account_status'];

            if ($password == md5($_POST['password'])) {
                if ($account_status == "Active") {
                    header("Location: http://localhost/webdev/onlineshop/home.php");
                    $_SESSION['user'] = $_POST['username'];
                } else {
                    $staErr = "Your Account is suspended *";
                }
            } else {
                $pasErr = "Incorrect Password *";
            }
        } else {
            $useErr = "User not found *";
        }
    }
    ?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="row justify-content-center mt-5">
            <main class="form-signin col-4 mt-4">

                <h1 class="h3 mb-3 fw-normal text-center">SIGN IN</h1>
                <span class="error"><?php echo $useErr; ?></span>
                <span class="error"><?php echo $pasErr; ?></span>
                <span class="error"><?php echo $staErr; ?></span>

                <div class="form-floating ">
                    <input type="text" class="form-control" name="username" value='<?php if (isset($_POST['username'])) {
                                                                                        echo $_POST['username'];
                                                                                    } ?>'>
                    <label for="username">
                        Username
                        </span>
                    </label>
                </div>


                <div class="form-floating">
                    <input type="password" class="form-control" name="password" value='<?php if (isset($_POST['password'])) {
                                                                                            echo $_POST['password'];
                                                                                        } ?>'>
                    <label for="password ">
                        Password
                    </label>
                </div>

                <button class="w-100 btn btn-lg btn-success mt-5 mb-5" type="sign in">Sign in</button>
            </main>
        </div>
    </form>

</body>

</html>