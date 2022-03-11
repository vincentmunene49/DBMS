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
    if($_SESSION['user'] === "Admin"){
       insert_into_student($db,$_SESSION['name'] ,$_SESSION['adm_number']);

        echo "
                            <script>
                            window.location.href='register_sem.php';
                            </script>";
        

    }elseif(!(isset($_SESSION['user']))){
        echo "
        <script>
        alert('unknown user, login first');
        window.location.href = 'login_file.php';
        </script>
        
        
        ";
    }
    
    else{
        $lecDB = mysqli_connect("localhost","Lecturer","","mas");
        insert_into_student($lecDB,$_SESSION['name'] ,$_SESSION['adm_number']);
      
    }

   
    
} 

