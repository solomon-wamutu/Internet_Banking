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
            <?php
            $client_number = $_GET['client_number'];
            $ret = "SELECT * FROM  ib_clients  WHERE client_number = ? ";
            $stmt = $mysqli->prepare($ret);
            $stmt->bind_param('s', $client_number);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($row = $res->fetch_object()) {
                //set automatically logged in user default image if they have not updated their pics
                if ($row->profile_pic == '') {
                    $profile_picture = "

                        <img class='img-fluid'
                        src='dist/img/user_icon.png'
                        alt='User profile picture'>

                        ";
                } else {
                    $profile_picture = "

                        <img class=' img-fluid'
                        src='dist/img/$row->profile_pic'
                        alt='User profile picture'>

                        ";
                }


            ?>
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1><?php echo $row->name; ?> Profile</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="pages_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="pages_manage_clients.php">iBanking Clients</a></li>
                                    <li class="breadcrumb-item"><a href="pages_manage_clients.php">Manage</a></li>
                                    <li class="breadcrumb-item active"><?php echo $row->name; ?></li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">

                                <!-- Profile Image -->
                                <div class="card card-purple card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <?php echo $profile_picture; ?>
                                        </div>

                                        <h3 class="profile-username text-center"><?php echo $row->name; ?></h3>

                                        <p class="text-muted text-center">Client @iBanking </p>

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>ID No.: </b> <a class="float-right"><?php echo $row->national_id; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Email: </b> <a class="float-right"><?php echo $row->email; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Phone: </b> <a class="float-right"><?php echo $row->phone; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>ClientNo: </b> <a class="float-right"><?php echo $row->client_number; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Address: </b> <a class="float-right"><?php echo $row->address; ?></a>
                                            </li>

                                        </ul>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                                <!-- About Me Box -->
                                <div class="card card-purple">
                                    <div class="card-header">
                                        <h3 class="card-title">About Me</h3>
                                    </div>
                                    <div class="card-body">
                                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                        <p class="text-muted">
                                            B.S. in Computer Science from the University of Tennessee at Knoxville
                                        </p>

                                        <hr>

                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                        <p class="text-muted">Malibu, California</p>

                                        <hr>

                                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                                        <p class="text-muted">
                                            <span class="tag tag-danger">UI Design</span>
                                            <span class="tag tag-success">Coding</span>
                                            <span class="tag tag-info">Javascript</span>
                                            <span class="tag tag-warning">PHP</span>
                                            <span class="tag tag-primary">Node.js</span>
                                        </p>

                                        <hr>

                                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>


                                    <?php
                                }
                                    ?>