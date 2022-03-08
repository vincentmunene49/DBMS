<?php
require_once "config.php";
require_once "database.php";

$db = connect(DB_SERVER,USER,PASSWORD,DB_NAME);
session_start();
$_SESSION['name'] = $_POST['name'];
$_SESSION['adm_number'] = $_POST['admissionNo'];
$reg_btn = $_POST['btn_register'];

//insert into students and stage table
if(isset($reg_btn)){
    insert_into_student($db,$_SESSION['name'] ,$_SESSION['adm_number']);

    echo "
                        <script>
                        window.location.href='register_sem.php';
                        </script>";
    
} 

