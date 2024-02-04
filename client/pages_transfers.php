<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <?php include("dist/_partials/head.php"); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include("dist/_partials/nav.php"); ?>
        <?php include("dist/_partials/sidebar.php"); ?>
        <div class="hold-transition content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Funds Transfer</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="pages_dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="pages_transfers">iBank Finances</a></li>
                                <li class="breadcrumb-item active">Transfers</li>
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
                                <h3 class="card-title">Select on any account to transfer funds from </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Acc Number</th>
                                            <th>Rate</th>
                                            <th>Acc type</th>
                                            <th>Acc owner</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //fetch all iB_Accs
                                        $client_id = $_SESSION['client_id'];
                                        $ret = "SELECT * FROM  ib_bankaccounts WHERE client_id =? ";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->bind_param('i', $client_id);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                            //Trim Timestamp to DD-MM-YYYY : H-M-S
                                            $dateOpened = $row->created_at;
                                        ?>

                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $row->acc_name; ?></td>
                                                <td><?php echo $row->account_number; ?></td>
                                                <td><?php echo $row->acc_rates; ?>%</td>
                                                <td><?php echo $row->acc_type; ?></td>
                                                <td><?php echo $row->client_name; ?></td>
                                                <td>
                                                    <a class="btn btn-success btn-sm" href="pages_transfer_money.php?account_id=<?php echo $row->account_id; ?>&account_number=<?php echo $row->account_number; ?>&client_id=<?php echo $row->client_id; ?>">
                                                        <i class="fas fa-money-bill-alt"></i>
                                                        <!-- <i class="fas fa-upload"></i> -->
                                                        Transfer Money
                                                    </a>

                                                </td>

                                            </tr>
                                        <?php $cnt = $cnt + 1;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include("dist/_partials/footer.php"); ?>
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>