<?php
require_once "config.php";
require_once "database.php";

$db = connect(DB_SERVER,USER,PASSWORD,DB_NAME);

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Dashboard</title>
    <link
      rel="stylesheet"
      href="./bootstrap-5.1.3-dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="./fontawesome-free-6.0.0-web/css/all.css" />
  </head>
  <body>
    <form action="units.php" method="post">
     
      <div class="container">
        <h1>Units</h1>
        <hr>
        <?php
        //todos
        //when button at reg sem is selected, Display all units for that sem
        //insert into student_stage
        session_start();
        $reg_sem = $_POST['registered_sem'];
        $student_adm = $_SESSION['adm_number'];
        $student_id = select_studentId($db,$student_adm);
        $year = $_POST['radio'][0];
        $sem = $_POST['radio'][1];
        $stage_id = select_stage_id($db,$year,$sem);

        if(isset($reg_sem)){

          if(!empty($_POST['radio'])) {
            foreach($stage_id as $id){
             // echo $id['ID'];
             // var_dump($id);
              $sql = "SELECT `code`,`name` FROM stage_course join units on `code` = `unit_code` where stage_id =". $id['ID'];
             foreach($student_id as $std_id){
              insert_into_student_sem($db,$std_id['ID'],$id['ID']);
             }
            }
            
           $resultset = $db->query($sql);
       

            while ($row = $resultset->fetch_assoc()) {
                echo "<input type = 'checkbox' name = 'units[]' value = '".$row['code']." ".$row['name']."'/> ".$row['code']." ".$row['name'] .'<br>';
                
            }
           
    
            }else{
              echo "No semester selected";
            }

            echo "<input type = 'submit' class='btn btn-primary' name = 'registered'/>";

        }
        //todo
        //insert into student sem
        ?>
       
      </div>
     
    </form>
 
  
    
    
 


    <script src="./bootstrap-5.1.3-dist/js/bootstrap.min.js">
    </script>
  </body>
</html>
