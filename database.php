<?php
function connect($server, $user, $password, $db_name)
{
    $db = new mysqli(
        $server,
        $user,
        $password
    );


    $sql = "CREATE DATABASE IF NOT EXISTS mas";
    $db->query($sql);
    if ($db->query($sql)) {
        $db = new mysqli(
            $server,
            $user,
            $password,
            $db_name
        );
    }


    $sql1 = "CREATE TABLE IF NOT EXISTS student_details (id int(11) AUTO_INCREMENT, 
    `Sname` varchar(255) NOT NULL,
    adm_number varchar(255) NOT NULL,
    PRIMARY KEY  (id))";

    if ($db->query($sql1)) {
        // echo "created  successfully";
    } else {
        //  echo "could not create" . mysqli_error($db);
    }
    $sql2 = "CREATE TABLE IF NOT EXISTS units (`code` varchar(255) NOT NULL,
`name` varchar(255) NOT NULL,
PRIMARY KEY  (code(6)))";
    if ($db->query($sql2) === true) {
    }
    $sql3 = "CREATE TABLE IF NOT EXISTS stage (ID int(11) AUTO_INCREMENT,
    `year` int(10) NOT NULL,
    `semester` int(10) NOT NULL,
    PRIMARY KEY  (ID))";
        if ($db->query($sql3) === true) {
        }




    $sql4 = "CREATE TABLE IF NOT EXISTS student_sem (student_id int (30) not null,
`stage_id` int(30) NOT NULL,
FOREIGN KEY (student_id) REFERENCES student_details(ID),
FOREIGN KEY (stage_id) REFERENCES stage(ID))";

    if ($db->query($sql4) === true) {
        // echo "created 3 successfully";
    }



    $sql5 = "CREATE TABLE IF NOT EXISTS student_course (student_id int (20) not null,
unit_code varchar(255) not null,
FOREIGN KEY (unit_code) REFERENCES units(`code`),
FOREIGN KEY (student_id) REFERENCES student_details(ID))";

    if ($db->query($sql5) === true) {
        //echo "created 4 successfully";
    }
    
    $sql6 = "CREATE TABLE IF NOT EXISTS stage_course (stage_id int (20) not null,
unit_code varchar(255) not null,
FOREIGN KEY (unit_code) REFERENCES units(`code`),
FOREIGN KEY (stage_id) REFERENCES stage(ID))";

    if ($db->query($sql6) === true) {
        //echo "created 4 successfully";
    }
    $sql7 = "CREATE TABLE IF NOT EXISTS results (unit_code varchar(50),
    `student_id` int(10) NOT NULL,
    `cat` float ,
    `main` float ,
    `total` float,
    FOREIGN KEY (student_id) REFERENCES student_details(`student_details`))";
        if ($db->query($sql7) === true) {
        }


    return $db;
}
function selectUser(mysqli $db){
    $data = [];
    $sql = "SELECT USER FROM mysql.user";
    $resultset = $db->query($sql);

    while($row = $resultset->fetch_assoc()){
        $data []=$row;
    }
    return $data;
}
function insert_into_student(mysqli $db,$name,$adm_number){
    $sql0 = "INSERT INTO `student_details`( `Sname`, `adm_number`) VALUES ('$name','$adm_number')";
   if( $db-> query($sql0)){


   }else{
       echo mysqli_error($db);
   }
}
function insert_into_student_course(mysqli $db,$student_id,$course_code){
    $sql = "INSERT INTO student_course (student_id,unit_code) values ('$student_id','$course_code')";
    $db -> query($sql);

}
//select student_id
function select_studentId(mysqli $db,$adm_number){
    $data = [];
 $sql = "SELECT ID from student_details where adm_number = '$adm_number'";
 $resultset = $db->query($sql);

 while ($row = $resultset->fetch_assoc()) {
     $data[] = $row;
 }
 return $data;
}
function insert_into_student_sem(mysqli $db,$student_id,$stage_id){
    $sql = "INSERT INTO student_sem (student_id,stage_id) VALUES ('$student_id','$stage_id')";

    $db->query($sql);

}
//select stage_id
function select_stage_id(mysqli $db,$year,$sem){
$data = [];
    $sql = "SELECT ID from stage where `year` = '$year' and `semester` = '$sem'";
    $resultset = $db->query($sql);

    while ($row = $resultset->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
   }

   function insertResult(mysqli $db,$code,$id,$cat,$main){
       $sql = "INSERT INTO results(unit_code,student_id,cat,main) VALUES ('$code','$id','$cat','$main')";
       if($db->query($sql)){

       }else{
           echo mysqli_error($db);
       }

   }
 function createTrigger(mysqli $db){
     $sql = "CREATE TRIGGER `find total` BEFORE INSERT ON `results` FOR EACH ROW SET New.total = New.cat + New.main";
     if($db->query($sql)){
         echo "created";
     }
 }
//function update students

function updateStudent(mysqli $db,$id,$name,$adm_number){
    $sql = "UPDATE student_details SET Sname = '$name', adm_number = '$adm_number' where id = '$id' ";
  if( $db->query($sql)) {

  }else{
      echo mysqli_error($db);
  }
}
//update student_stage
function updateStudentStage(mysqli $db,$id,$stage_id){
    $sql = "UPDATE student_sem SET stage_id = '$stage_id' where student_id = '$id' ";
   if($db->query($sql)){

   }else{
       echo mysqli_error($db);
   }
}

function backup(mysqli $db, $table_name){
    
    $backup_file  = "E:/backups/student_details.sql";
    $sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";
    

mysqli_select_db($db,'mas');
$retval = mysqli_query(  $db,$sql );

if(! $retval ) {
   die('Could not take data backup:'.mysqli_error($db));
}

echo "Backedup  data successfully\n";

mysqli_close($db);

}
//$table_name = "results";


//UPDATE table_name
//SET column1=value, column2=value2,...
//WHERE some_column=some_value 