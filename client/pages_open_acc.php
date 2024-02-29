<?php
session_start();
include('conf/config.php');
include('conf/checklogin.php');
check_login();
$client_id = $_SESSION['client_id'];
if (isset($_POST['open_account'])) {
    $acc_name = $_POST['acc_name'];
    $account_number = $_POST['account_number'];
    $acc_type = $_POST['acc_type'];
    $acc_rates = $_POST['acc_rates'];
    $acc_status = $_POST['acc_status'];
    $acc_amount = $_POST['acc_amount'];
    $client_id = $_SESSION['client_id'];
    $client_national_id = $_POST['client_national_id'];
    $client_name = $_POST['client_name'];
    $client_phone = $_POST['client_phone'];
    $client_number = $_POST['client_number'];
    $client_email = $_POST['client_email'];
    $client_adr = $_POST['client_adr'];

    $ins = "INSERT INTO ib_bankaccounts (account_number, acc_name, client_phone, acc_type, acc_rates, acc_status, acc_amount,client_number, client_email, client_adr,client_id,client_name,client_national_id) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($ins);
    $bp = $stmt->bind_param('sssssssssssss', $account_number, $acc_name, $client_phone, $acc_type, $acc_rates, $acc_status, $acc_amount, $client_number, $client_email, $client_adr, $client_id, $client_name, $client_national_id);
    $stmt->execute();

    if ($stmt) {
        $success = "iBank Account Opened successfully";
    } else {
        $err = "Please try again or Try Again";
    }
}
?>
<!DOCTYPE html>
<html lang="en">


<meta charset="UTF-8">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include("dist/_partials/head.php"); ?>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include("dist/_partials/nav.php"); ?>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <?php include("dist/_partials/sidebar.php"); ?>

        <?php
        $client_id = $_SESSION['client_id'];
        $sel = "SELECT * FROM ib_clients WHERE client_id = ?";
        $stmt = $mysqli->prepare($sel);
        $stmt->bind_param('i', $client_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $cnt = 1;

        while ($row = $res->fetch_object()) {


        ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Open <?php echo $row->name; ?>iBanking Account</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="pages_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="pages_open_acc.php">iBanking Accounts</a></li>
                                    <li class="breadcrumb-item"><a href="pages_open_acc.php">Open</a></li>
                                    <li class="breadcrumb-item active"><?php echo $row->name ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="card card-purple">
                                    <div class="card-header">
                                        <h3 class="card-title">Fill All Fields</h3>
                                    </div>
                                    <!-- form start -->
                                    <form method="post" enctype="multipart/form-data" role="form">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Client Name</label>
                                                    <input type="text" readonly name="client_name" value="<?php echo $row->name; ?>" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputPassword1">Client Number</label>
                                                    <input type="text" readonly name="client_number" value="<?php echo $row->client_number; ?>" class="form-control" id="exampleInputPassword1">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Client Phone Number</label>
                                                    <input type="text" readonly name="client_phone" value="<?php echo $row->phone; ?>" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputPassword1">Client National ID No.</label>
                                                    <input type="text" readonly value="<?php echo $row->national_id; ?>" name="client_national_id" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Client Email</label>
                                                    <input type="email" readonly name="client_email" value="<?php echo $row->email; ?>" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Client Address</label>
                                                    <input type="text" name="client_adr" readonly value="<?php echo $row->address; ?>" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                            </div>
                                            <!-- ./End Personal Details -->

                                            <!--Bank Account Details-->
                                            <div class="row">

                                                <div class="col-md-6 form-group">
                                                    <label for="exampleInputEmail">Account Type Rates(%)</label>
                                                    <input type="number" class="form-control" name="acc_rates" required>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="exampleInputEmail">Account Status</label>
                                                    <input type="text" class="form-control" name="acc_status" value="Active" readonly required>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="exampleInputEmail">Account Amount</label>
                                                    <input type="text" class="form-control" readonly required name="acc_amount">
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="exampleInputEmail">Account Name</label>
                                                    <input type="text" class="form-control" name="acc_name" readonly required id="exampleInputEmail">
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="exampleInputEmail">Account Number</label>
                                                    <?php
                                                    $length = 12;
                                                    $_accnumber = substr(str_shuffle('0123456789'), 1, $length);
                                                    ?>
                                                    <input type="text" class="form-control" value="<?php echo $_accnumber; ?>" id="exampleInputEmail" name="account_number" required readonly>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">iBank Account Type</label>
                                                    <select class="form-control" onChange="getiBankAccs(this.value);" name="acc_type">
                                                        <option>Select Any iBank Account types</option>
                                                        <?php
                                                        //fetch all iB_Acc_types
                                                        $ret = "SELECT * FROM  ib_acc_types ORDER BY RAND() ";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        $cnt = 1;
                                                        while ($row = $res->fetch_object()) {

                                                        ?>
                                                            <option value="<?php echo $row->name; ?> "> <?php echo $row->name; ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                            <button type="submit" name="open_account" class="btn btn-success">Open iBanking Account</button>
                                        </div>
                                        
                               
                            </form>
                        </div>
                        <!-- /.card -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
        <?php } ?>
        <!-- /.content-wrapper -->
        <?php include("dist/_partials/footer.php"); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
<!-- </body>

</html>
</div>
</div> -->

</body>

</html>