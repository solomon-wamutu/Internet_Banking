<?php
session_start();
include('conf/config.php');
include('conf/checklogin.php');
check_login();
$client_id = $_SESSION['client_id'];

if(isset($_POST['update_client_account'])){

    $name = $_POST['name'];
    $national_id = $_POST['national_id'];
    $client_number = $_GET['client_number'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

}



<?php
} ?>