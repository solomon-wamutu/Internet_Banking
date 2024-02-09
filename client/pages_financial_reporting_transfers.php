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
<?php include("./dist/_partials/head.php");  ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include("./dist/_partials/nav.php"); ?>
        <?php include("./dist/_partials/sidebar.php"); ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Report : Withdrawal</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="pages_dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="pages_financial_reporting_withdrawals.php">Advanced Reporting</a></li>
                                <li class="breadcrumb-item active">Withdrawal</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Transactions Under Withdrawal Category</h4>
                            </div>
                            <div class="card-body">
                                <table id="export" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Transaction Code</th>
                                            <th>Account No.</th>
                                            <th>Amount</th>
                                            <th>Acc. Owner</th>
                                            <th>Receiver's Acc.</th>
                                            <th>Receiver</th>
                                            <th>Timestamp</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $client_id = $_SESSION['client_id'];
                                        $sel = "SELECT * FROM ib_transactions WHERE tr_type = 'Transfer'AND client_id = ?";
                                        $stmt = $mysqli->prepare($sel);
                                        $stmt->bind_param('i', $client_id);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                            $transTstamp = $row->created_at;

                                            if ($row->tr_type == 'Deposit') {
                                                $alertClass = "<span class='badge badge-success'>$row->tr_type</span>";
                                            } elseif ($row->tr_type == 'Withdrawal') {
                                                $alertClass = "<span class='badge badge-danger'>$row->tr_type</span>";
                                            } else {
                                                $alertClass = "<span class='badge badge-warning'>$row->tr_type</span>";
                                            }
                                        ?>

                                            <tr>
                                                <td><?php echo $cnt  ?></td>
                                                <td><?php echo $row->tr_code; ?></td>
                                                <td><?php echo $row->account_number  ?></td>
                                                <td><?php echo $row->transaction_amt  ?></td>
                                                <td><?php echo $row->client_name  ?></td>
                                                <td><?php echo $row->receiving_acc_no  ?></td>
                                                <td><?php echo $row->receiving_acc_holder   ?></td>
                                                <td><?php echo date("d-M-Y h:m:s ", strtotime($transTstamp));   ?></td>
                                            </tr>

                                        <?php
                                            $cnt = $cnt + 1;
                                        }
                                        ?>
                                        </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>