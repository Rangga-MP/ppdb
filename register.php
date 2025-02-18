<link rel="icon" type="image/png" href="Logo CB.png">
<?php
session_start();
include 'dbconnect.php';
include 'config.php';
$alert = '';

// Cek jika user sudah login
if (isset($_SESSION['role'])) {
    header("location:index.php");
    exit;
}

// Proses pendaftaran
if (isset($_POST['btn-daftar'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $verification_code = bin2hex(random_bytes(16)); // Membuat token unik

    // Cek apakah email sudah terdaftar
    $result = mysqli_query($conn, "SELECT * FROM user WHERE useremail = '$email'");
    $rowCount = mysqli_num_rows($result);

    if ($rowCount == 0) {
        // Jika email belum terdaftar, lakukan pendaftaran
        $insert = mysqli_query($conn, "INSERT INTO user (useremail, userpassword, verification_code, is_verified) 
                                       VALUES ('$email', '$password', '$verification_code', 0)");

        if ($insert) {
            // Kirim email verifikasi
            if (sendVerificationEmail($email, $verification_code)) {
                $_SESSION['notif'] = "Pendaftaran berhasil! Silakan cek email untuk verifikasi.";
            } else {
                $_SESSION['notif'] = "Pendaftaran berhasil, namun gagal mengirim email verifikasi.";
            }
        } else {
            $_SESSION['notif'] = "Gagal melakukan pendaftaran. Silakan coba lagi.";
        }
    } else {
        // Jika email sudah terdaftar
        $_SESSION['notif'] = "Email sudah terdaftar. Silakan login.";
    }

    // Redirect ke index.php
    header("Location: index.php");
    exit;
}
?>
    


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran PPDB</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-144808195-1');
	</script>
    <script src="jquery.min.js"></script>
	<style>body{background-color:#17a2b8;}
	@media screen and (max-width: 600px) {
h4{font-size:85%;}
}
.container{
	background-color:#2c3e50;
	width:70%;
	border: 3px white;
	border-style:solid;
	border-radius:30px;
	padding-left:10%;
	padding-right:10%;
	padding-top:3%;
	padding-bottom:2%;
}
.btn{
	width:40%;
}
	</style>
	<link rel="icon" 
      type="image/png" 
      href="favicon.png">
  </head>
  <body>
  
  <div align="center">
  
  
  

  <img src="Logo CB.png" width="20%" style="margin-top:2%" \>

	<br \><br \>
			<div class="container">
					<div style="color:white">
					<label>Pendaftaran PPDB Online</label><br \>
                    <label><?php echo $alert ?></label>
					</div>
                <form method="post">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email" autofocus required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btn-daftar">Daftar</button>
                </form>
			
			<br \>
        </div></div>
       
     
	
	
  </body>
</html>
