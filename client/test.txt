<?php 
session_start();
include('./conf/config.php');
if(isset($_POST['reset_password'])){
    $error = 0;
    if(isset($_POST['email']) && !empty($_POST['email'])){
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    }
    else{
    $error = 1;
    $err = "Enter your email address";
    }
     
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $err = "Invalid email address";
    }
    $checkEmail = mysqli_query($mysqli, "SELECT `email` FROM `ib_clients` WHERE `email` = `" . $_POST['email'] . "`") or exit(mysqli_error($mysqli));

    if (mysqli_num_rows($checkEmail) > 0) {

        $n = date('y');
        $new_password = bin2hex(random_bytes($n));
        //Insert Captured information to a database table
        $query = "UPDATE ib_clients SET  password=? WHERE email =?";
        $stmt = $mysqli->prepare($query);
        //bind paramaters
        $rc = $stmt->bind_param('ss', $new_password, $email);
        $stmt->execute();
        $_SESSION['email'] = $email;
    
        if ($stmt) {
          /* Alert */
          $success = "Confim Your Password" && header("refresh:1; url=pages_confirm_password.php");
        } else {
          $err = "Password reset failed";
        }
      } else  // user does not exist
      {
        $err = "Email Does Not Exist";
      }
}

$sel = "SELECT * FROM `ib_systemsettings`";
$stmt = $mysqli->prepare($sel);
$stmt->execute();
$res = $stmt->get_result();
while ($auth = $res->fetch_object()) {
    ?>
<!DOCTYPE html>
<html lang="en">
<?php include("./dist/_partials/head.php"); ?>
<body class="hold-transition login.php">
    
<div class="login-box">
    <div class="login-logo"></div>
    <div class="card">
        <div class="card-body login-card-body">
                    <p class="login-box-msg">You've lost your password, don't worry we'll help you recover it</p>


                

        <form action="" method="post">
            <div class="input-group mb-3">
                <input type="email" name="email" id="email" required placeholder="Email" class="form-control">
                <div class="input-group-append">
                    <div class="input-group-text"></div>
                    <span class="fas fa-envelope"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" name="reset_password" class="btn btn-success btn-block">Request for Password</button>
                </div>
            </div>
        </form>
            <p class="mt-3 mb-1">
            <a href="pages_client_index.php">Login</a>
            </p>
        </div>
    </div>
</div>
<script src="./plugins/jquery/jquery.min.js"></script>
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./dist/js/adminlte.min.js"></script>
</body>
</html>

<?php
}
?> 