<?php
session_start();
include('/opt/lampp/htdocs/internet_bank/InternetBanking-PHP2/admin/conf/config.php');
if(isset($_POST['reset_password'])){
    $error = 0;
if(isset($_POST['email']) && !empty($_POST['email'])){
$email = mysqli_real_escape_string($mysqli,trim($_POST['email']));
}
else{
    $error = 1;
    $err = "Enter your email";
}

if(!filter)
}