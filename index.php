<?php
 include("admin/conf/config.php"); 
 $sel =" SELECT * FROM `ib_systemsettings`";
 $stmt = $mysqli->prepare($sel);
 $stmt ->execute();
 $res = $stmt ->get_result();
 while ($sys = $res->fetch_object());{

 ?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
    <meta name="description" content="Transfer safely">
    <meta name="author" content="Solomon wamutu">
    <title><?php echo $sys->sys_name; ?> - <?php echo $sys->sys_tagline; ?></title>
    <link rel="stylesheet" href="./dist/css/robust.css">
</head>
<body>
<nav class="navbar navbar-lg navbar-expand-lg navbar-transparent navbar-dark navbar-absolute w-100">
<div class="container">
                <a class="navbar-brand" href="index.php"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" target="_blank" href="admin/pages_index.php">Admin Portal</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" target="_blank" href="staff/pages_staff_index.php">Staff Portal</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" target="_blank" href="client/pages_client_index.php">Client Portal</a>
                        </li>
                    </ul>
                    <a class="btn btn-danger" href="client/pages_client_signup.php" target="_blank">Join Us</a>
                </div>
            </div>
            </nav>

            <div class="intro py-5 py-lg-9 position-relative text-white">
            <div class="bg-overlay-gray">
                <img src="dist/bg.webp" class="img-fluid img-cover"/>
            </div>
            <div class="intro-content py-6 text-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6 mx-auto text-center">
                            <h1 class="my-3 display-4 d-none d-lg-inline-block"></h1>
                            <p class="lead mb-3">
                                </p>
                            <br>
                            <a class="btn btn-success btn-lg mr-lg-2 my-1" target="_blank" href="client/pages_client_signup.php" role="button">Get started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="./dist/js/bundle.js"></script>
</body>
</html>                                                                              
<?php
}
?>