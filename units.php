<?php

require_once "config.php";
require_once "database.php";
$db = connect(DB_SERVER,USER,PASSWORD,DB_NAME);
session_start();


$student_id = select_studentId($db,$_SESSION['adm_number']);
$checked_units = $_POST['units'];
if(isset($_POST['registered'])){
    foreach($student_id as $id){
       // insert_into_student_course($db,$id)
       foreach($checked_units as $unit){
           $code = substr($unit,0,6);
           insert_into_student_course($db,$id['ID'],$code);
       }

    }

    echo"
    <script>
    alert('successfully registered, Login to view Registered units');

    window.location.href='login.html'
    
    
    </script>
    
    
    ";
   
}