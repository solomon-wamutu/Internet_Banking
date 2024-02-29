<?php
include('../client/conf/config.php');
/* Persisit System Settings On Brand */
$ret = "SELECT * FROM `ib_systemsettings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>


        <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title><?php echo $sys->sys_name; ?> - <?php echo $sys->sys_tagline; ?></title>
                <!-- Tell the browser to be responsive to screen width -->
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <!-- overlayScrollbars -->
                <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
                <!-- Font Awesome -->
                <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
                <!-- Ionicons -->
                <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
                <!-- icheck bootstrap -->
                <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
                <!-- Theme style -->
                <link rel="stylesheet" href="dist/css/adminlte.min.css">
                <!-- Google Font: Source Sans Pro -->
                <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
                <!--Data tables css-->
                <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
                <!--load swal js -->
                <script src="dist/js/swal.js"></script>
                <!-- Favicon -->
                <link rel="icon" type="image/png" sizes="16x16" href="../admin/dist/img/<?php echo $sys->sys_logo; ?>">
                <!-- Data Tables CSS -->
                <link rel="stylesheet" type="text/css" href="plugins/datatable/custom_dt_html5.css">

                <?php if (isset($success)) { ?>

                        <script>
                                setTimeout(() => {
                                        swal("Success", "<?php echo $success; ?>", "success");
                                }, 100);
                        </script>
                <?php } ?>

                <?php if (isset($err)) { ?>

                        <script>
                                setTimeout(() => {
                                        swal("Failed", "<?php echo $err; ?>", "error");
                                }, 100);
                        </script>

                <?php } ?>
        </head>
<?php
}
?>