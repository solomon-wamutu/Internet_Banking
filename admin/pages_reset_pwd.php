<?php
session_start();
include('/opt/lampp/htdocs/internet_bank/InternetBanking-PHP2/admin/conf/config.php');
if (isset($_POST['reset_password'])) {
    $error = 0;
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = "Enter your email";
    }

    if (!filter_list($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $err = 'Invalid email';
    }

    $checkEmail = mysqli_query($mysqli, "SELECT `email` FROM `ib_admin` WHERE `email = '" . $_POST["email"] . "'");
    if (mysqli_num_rows($checkEmail) > 0) {
        $n = date('Y');
        $new_password = bin2hex(random_bytes($n));
        $upd = "UPDATE ib_admin SET password = ? WHERE email =?";
        $stmt = $mysqli->prepare($upd);
        $rc = $stmt->bind_param('ss', $new_password, $email);
        $stmt->execute();
        $_SESSION['email'] = $email;

        if ($stmt) {
            $success = "Confirm Your Password" && header("refresh:1; url=pages_confirm_passwords.php");
        } else {
            $err = "Password reset failed";
        }
    } else {
        $err = "Email does not exist";
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
    <?php include("dist/_partials/head.php"); ?>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <p><?php echo $auth->sys_name; ?> - <?php echo $auth->sys_tagline; ?></p>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="email" name="email" required id="" placeholder="Email" class="form-control">
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </body>

    </html>

<?php
}
?>