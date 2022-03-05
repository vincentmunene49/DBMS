<?php
require_once "config.php";
require_once "database.php";

$db = connect(DB_SERVER,USER,PASSWORD,DB_NAME);

$name = $_POST['name'];
$adm_number = $_POST['admissionNo'];
$stage = $_POST['semester'];
$year = $stage[1];
$semester = $stage[3];
$reg_btn = $_POST['btn_register'];
//insert into students and stage table
if(isset($reg_btn)){
    insert_into_student_and_stage($db,$name,$adm_number,$year,$semester);

    // echo "
    //                     <script>
    //                     window.location.href='login.html';
    //                     </script>";
    
}

