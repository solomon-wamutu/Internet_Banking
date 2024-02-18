<?php
session_start();
include('./conf/config.php');
include('./conf/checklogin.php');
check_login();
$admin_id = $_SESSION['admin_id'];
if (isset($_POST['create_acc_type'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $rate = $_POST['rate'];
    $code = $_POST['code'];


    $querry = "INSERT INTO ib_acc_types (name, description, rate, code) VALUES(?,?,?,?)";
    $stmt = $mysqli->prepare($querry);
    $rc = $stmt->bind_param('ssss', $name, $description, $rate, $code);
    $stmt->execute();

    if ($stmt) {
        $success = "Account Category Created";
    } else {
        $err = "Try again later";
    }
}
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php include("dist/_partials/head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">