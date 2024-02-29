<?php

session_start();
include('conf/config.php');
include('conf/checklogin.php');
check_login();
$client_id = $_SESSION['client_id'];

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<?php include('dist/_partials/head.php'); ?>

<body class="hold-transitons sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include('dist/_partials/nav.php'); ?>
        <?php include('dist/_partials/sidebar.php'); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="content-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Deposits</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="pages_dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="pages_deposits.php">iBank Finances</a></li>
                                <li class="breadcrumb-item active">Deposits</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Select on any account to deposit money
                                </h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Account No.</th>
                                            <th>Rate</th>
                                            <th>Acc. type</th>
                                            <th>Acc. Owner</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $client_id = $_SESSION['client_id'];
                                        $sel = 'SELECT * FROM ib_bankaccounts WHERE client_id = ?';
                                        $stmt = $mysqli->prepare($sel);
                                        $stmt->bind_param('i', $client_id);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                            $dateOpened = $row->created_at;
                                        ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $row->acc_name; ?></td>
                                                <td><?php echo $row->account_number; ?></td>
                                                <td><?php echo $row->acc_rates; ?></td>
                                                <td><?php echo $row->acc_type; ?></td>
                                                <td><?php echo $row->client_name; ?></td>
                                                <td><a href="pages_deposit_money.php?account_id=<?php echo $row->account_id; ?>&account_number=<?php echo $row->account_number; ?>&client_id=<?php echo $row->client_id; ?>" class="btn btn-success btn-sm">
                                                        <li class="fas famoney-bill-alt"></li>
                                                        <li class="fas fa-upload"></li>
                                                        Deposit Money
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $cnt = $cnt + 1;
                                        } ?>
                                        </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include('dist/_partials/footer.php'); ?>
        <aside class="control-sidebar control-sidebar-dark">

        </aside>
    </div>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>

    <script>
        $(function() {
                    $("#example1").DataTable();
                                $("#example2").DataTable({
                                    "paging": true,
                                    "lengthChange": false,
                                    "searching":false,
                                    "ordering":true,
                                    "info":true,
                                    "autoWidth":false,
                                });
                                });
    </script>
</body>

</html>