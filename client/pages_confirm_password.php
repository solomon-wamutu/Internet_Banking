<?php
session_start();
include('./conf/config.php');
if(isset($_POST['confirm-reset-password'])){
    $error = 0;
    if(isset($_POST['new_password']) && !empty($_POST['new_password'])){
        $new_password = mysqli_real_escape_string($mysqli,trim(sha1(md5($_POST['new_password']))));
    }
    else{
        $error = 1;
        $err = "New password cannot be empty";
    }

    if(isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) {
        $confirm_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['confirm_password']))));
    }
    else{
        $error = 1;
        $err = "confirmation password cannot be empty";
    }
    if(!$error){
        $email = $_SESSION['email'];
        $sel = "SELECT * FROM ib_clients WHERE email = '$email'";
        $res = mysqli_query($mysqli, $sel);
        if(mysqli_num_rows($res) > 0){
            $row = mysqli_fetch_assoc($res);

            if($new_password != $confirm_password){
                $err = "Password does not match";
            }
            else{
                $email = $_SESSION['email'];
                $upd = "UPDATE ib_clients SET password = ? WHERE email = ?";
                $stmt = $mysqli ->prepare($upd);
                $rc = $stmt->bind_param('ss',$new_password,$email);
                $stmt->execute();
                if($stmt){
                    $success = "Password has changed" && header("refresh:1; url = pages_client_index.php");
                }
                else{
                    $err = "Please try again or try later";
                }
            }
        }
    }
}
$sel = "SELECT * FROM `ib_systemsettings`";
$stmt = $mysqli ->prepare($sel);
$stmt ->execute();
$res = $stmt ->get_result();
while ($auth = $res->fetch_object()){


?>

<!DOCTYPE html>
<html>
<?php include("./dist/_partials/head.php") ?>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <p class="login-box-msg"><?php echo $auth->sys_name; ?> - <?php echo $auth->sys_tagline; ?></p>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <?php 
            $email = $_SESSION['email'];
            $sel = "SELECT * FROM ib_clients WHERE email = '$email'";
            $stmt = $mysqli -> prepare($sel);
            $stmt -> execute();
            $ret = $stmt -> get_result();
            while($row = $ret ->fetch_object())
             {
            ?>
                <div><p><?php echo $row->name;?> Please enter and confirm your password</p></div>
            <?php 
            }
            ?>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name = "new_password" placeholder="Enter password" required>
                    
                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type= "submit" class="btn btn-success btn-block" name="confirm-reset-password">Reset password</button>
                    </div>
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="pages_staff_index.php">Login</a>
                    </p>
        </div>
    </div>
</div>
    
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
</body>
</html>

<?php
}
?>