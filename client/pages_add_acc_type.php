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
        <?php
        include('./dist/_partials/nav.php');
        include('./dist/_partials/sidebar.php')

        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Create Account Categories</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="pages_dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="pages_add_acc_type.php">iBanking</a></li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-purple">
                                <div class="card-header">
                                    <h3 class="card-title">Fill All Fields</h3>
                                </div>
                            </div>
                            <form method="post" enctype="multipart/form-data" role="form">
                                <div class="card-body">
                                    <div class="row">
                                        <div class=" col-md-4 form-group">
                                            <label for="exampleInputEmail1">Account Category Name</label>
                                            <input type="text" name="name" required class="form-control" id="exampleInputEmail1">
                                        </div>
                                        <div class=" col-md-4 form-group">
                                            <label for="exampleInputEmail1">Account Category Rates % Per Year </label>
                                            <input type="text" name="rate" required class="form-control" id="exampleInputEmail1">
                                        </div>
                                        <div class=" col-md-4 form-group">
                                            <label for="exampleInputPassword1">Account Category Code</label>
                                            <?php
                                            $length = 5;
                                            $_Number =  substr(str_shuffle('0123456789QWERTYUIOPLKJHGFDSAZXCVBNM'), 1, $length);
                                            ?>
                                            <input type="text" readonly name="code" value="ACC-CAT-<?php echo $_Number; ?>" class="form-control" id="exampleInputPassword1">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class=" col-md-12 form-group">
                                            <label for="exampleInputEmail1">Account Category Decription</label>
                                            <textarea type="text" name="description" required class="form-control" id="desc"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="create_acc_type" class="btn btn-success">Add Account Type</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div><!-- /.container-fluid -->
            </section>