<?php
session_start();
include('conf/config.php');
include('conf/checklogin.php');
check_login();
$client_id = $_SESSION['client_id'];

if (isset($_POST['update_client_account'])) {

    $name = $_POST['name'];
    $national_id = $_POST['national_id'];
    $client_number = $_GET['client_number'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address  = $_POST['address'];

    $profile_pic  = $_FILES["profile_pic"]["name"];
    move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "dist/img/" . $_FILES["profile_pic"]["name"]);
    $query = "UPDATE  ib_clients SET name=?, national_id=?, phone=?, email=?, address=?, profile_pic=? WHERE client_number = ?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssssss', $name, $national_id, $phone, $email,  $address, $profile_pic, $client_number);
    $stmt->execute();

    if ($stmt) {
        $success = "Client Account Upddated";
    } else {
        $err = "Please try again or try later";
    }

    if (isset($_POST['change_client_password'])) {
        $password = sha1(md5($_POST['password']));
        $client_number = $_GET['client_number'];
        //insert unto certain table in database
        $query = "UPDATE ib_clients  SET password=? WHERE  client_number=?";
        $stmt = $mysqli->prepare($query);
        //bind paramaters
        $rc = $stmt->bind_param('ss', $password, $client_number);
        $stmt->execute();
        //declare a varible which will be passed to alert function
        if ($stmt) {
            $success = "Client Password Updated";
        } else {
            $err = "Please Try Again Or Try Later";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php include("dist/_partials/head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include("dist/_partials/nav.php"); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include("dist/_partials/sidebar.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">