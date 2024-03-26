<?php
session_start();
include('conf/config.php');
include('conf/checklogin.php');
check_login();
$client_id = $_SESSION['client_id'];

<?php
include("admin/conf/config.php");
/* Persisit System Settings On Brand */
$ret = "SELECT * FROM `ib_systemsettings` ";
// iB_SystemSettings
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>



<?php
} ?>