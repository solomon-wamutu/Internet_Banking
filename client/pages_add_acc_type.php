<?php 
session_start();
include('./conf/config.php');
include('./conf/checklogin.php');
check_login();
$admin_id = $_SESSION['admin_id'];
if(isset($_POST['create_acc_type'])){
    
}
?>