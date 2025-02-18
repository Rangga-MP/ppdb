<?php
session_start();
include 'dbconnect.php';
$alert = '';

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];

    if ($role == 'Admin') {
        header("location:admin");
    } else {
        header("location:user");
    }
}

if (isset($_POST['btn-login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $cariadmin = mysqli_query($conn, "select * from admin where adminemail='$email' and adminpassword='$password';");
    $cariuser = mysqli_query($conn, "select * from user where useremail='$email' and userpassword='$password';");

    $cekadmin = mysqli_num_rows($cariadmin);
    $cekuser = mysqli_num_rows($cariuser);

    if ($cekadmin > 0) {
        $data = mysqli_fetch_assoc($cariadmin);
        $_SESSION['email'] = $data['adminemail'];
        $_SESSION['role'] = "Admin";
        header("location:admin");
    } else if ($cekuser > 0) {
        $data = mysqli_fetch_assoc($cariuser);
        $_SESSION['email'] = $data['useremail'];
        $_SESSION['userid'] = $data['userid'];
        $_SESSION['role'] = "User";
        header("location:user");
    } else {
        echo "<div class='alert alert-warning'>Username atau Password salah</div>
              <meta http-equiv='refresh' content='2'>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="Logo CB.png">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="Logo CB.png" alt="IMG">
            </div>

            <!-- Form yang disesuaikan agar kompatibel dengan PHP -->
            <form class="login100-form validate-form" method="post">
                <span class="login100-form-title">
                    Member Login
                </span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="email" name="email" placeholder="Email" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn" name="btn-login">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt3" href="index.php">
                        <i class="fa fa-long-arrow-left m-l-5" style="margin-left: 170px;" aria-hidden="true"></i>
                        Back to Home
                    </a>
                    <a class="txt2" href="register.php">
                        Create your Account
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/tilt/tilt.jquery.min.js"></script>
<script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<script src="js/main.js"></script>

</body>
</html>
