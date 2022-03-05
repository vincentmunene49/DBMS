<?php
function connect($server, $user, $password, $db_name)
{
    $db = new mysqli(
        $server,
        $user,
        $password
    );


    $sql = "CREATE DATABASE IF NOT EXISTS maseno";
    $db->query($sql);
    if ($db->query($sql)) {
        $db = new mysqli(
            $server,
            $user,
            $password,
            $db_name
        );
    }


    $sql1 = "CREATE TABLE IF NOT EXISTS student_details (ID int(11) AUTO_INCREMENT, 
    `Sname` varchar(255) NOT NULL,
    adm_number varchar(255) NOT NULL,
    PRIMARY KEY  (ID))";

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