<?php
session_start();
include('./conf/config.php');
include('./conf/checklogin.php');
check_login();
$client_id = $_SESSION['client_id'];

?>

<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php include("dist/_partials/head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include("dist/_partials/nav.php") ?>
        <?php include("dist/_partials/sidebar.php") ?>

        <?php 
            $client_id = $_SESSION['client_id'];
            $sel = "SELECT * FROM ib_clients wHERE client_id = ?";
            $stmt = $mysqli->prepare($sel);
            $stmt->bind_param('i', $client_id);
            $stmt->execute();
            $res = $stmt->get_result();
            $cnt = 1;
            while($row = $res ->fetch_object()) {

            }
            ?>
            