<?php
session_start();
include('conf/config.php');

if(isset($_POST['create_account'])){
    $name = $_POST['name'];
    $national_id = $_POST['national_id'];
    $client_number = $_POST['client_number'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = sha1(md5($_POST['password']));
    $address = $_POST['address'];
    $profile_pic = $_POST['profile_pic'];
    // move_uploaded_file($_POST["profile_pic"]["tmp_name"],"dist/img/".$_FILES["profile_pic"]);

  $sel = "SELECT * FROM ib_clients WHERE name = ?";
  $stmt = $mysqli ->prepare($sel);
  $stmt->bind_param("s", $name);
  $stmt->execute();
  $res = $stmt ->get_result();
  if($res->num_rows > 0 ){
    $err = "Dublicate username, please consider using different username";
  // $del = "DELETE * FROM ib_clients WHERE name > 0";
  // $stmt = $mysqli ->prepare($sel);
  // $stmt->bind_param("s", $name);
  // $stmt->execute();
  }
else{
$ins = "INSERT INTO `ib_clients` (name, national_id,client_number, phone, email, password, address,profile_pic) VALUES (?,?,?,?,?,?,?,?)";
$stmt=$mysqli->prepare($ins);
$bp=$stmt->bind_param('ssssssss',$name,$national_id,$client_number,$phone,$email,$password,$address,$profile_pic);   
$stmt->execute(); 

if($stmt){
    $success = "Account created successfully";
    // echo "Account created successfully";
}
else{
  $err = "Account not created successfully";
}
}

}
$sel = "SELECT * FROM `ib_systemsettings`";
$stmt = $mysqli->prepare($sel);
$stmt->execute();
$res=$stmt->get_result();
while ($auth=$res->fetch_object()){

?>

<!DOCTYPE html>
  <html>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <?php include("dist/_partials/head.php"); ?>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <p><?php echo $auth->sys_name; ?> - Sign Up</p>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign Up To Use Our IBanking System</p>

          <form method="post">
            <div class="input-group mb-3">
              <input type="text" name="name" required class="form-control" placeholder="Client Full Name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" name="national_id" required class="form-control" placeholder="National ID Number">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-tag"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3" style="display:block;">
              <?php
              //PHP function to generate random
              $length = 8;
              $Number =  substr(str_shuffle('0123456789'), 1, $length); ?>
              <input type="text" name="client_number" value="iBank-CLIENT-<?php echo $Number; ?>" class="form-control" placeholder="Client Number">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" name="phone" required class="form-control" placeholder="Client Phone Number">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-phone"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" name="address" required class="form-control" placeholder="Client Address">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-map-marker"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" name="email" required class="form-control" placeholder="Client Address">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" required class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="file" name="profile_pic" required class="form-control" placeholder="profile">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" name="create_account" class="btn btn-success btn-block">Sign Up</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="mb-0">
            <a href="pages_client_index.php" class="text-center">Login</a>
          </p>

        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

  </body>

  </html>
<?php
} ?>