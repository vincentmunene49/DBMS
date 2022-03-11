<?php
session_start();
require_once "config.php";
                require_once "database.php";

                $db = connect(DB_SERVER, USER, PASSWORD, DB_NAME);
                
                

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <?php
        if (isset($_POST['insert_result'])) {
            $_SESSION['unit']  = $_POST['unit'];
            $unit =  $_SESSION['unit'];
            $_SESSION['ADM'] = [];

            if ( $_SESSION['unit']  !== "") {
                //select all students doing that unit

                

                $sql = "SELECT id, Sname, adm_number from student_course join student_details on id = student_id where unit_code = '$unit' ";
                //SELECT Sname, adm_number from student_course join student_details on id = student_id WHERE unit_code = "ccs302"

                $resultset = $db->query($sql);
                if (mysqli_num_rows($resultset) === 0) {
                    echo "no one is taking this unit";
                } else {
                    while ($row = $resultset->fetch_assoc()) {
                        
                        foreach ($resultset as $result) {
                         
                        $_SESSION ['ADM'][] = $result['adm_number'];
                           
                            echo "" . $result['Sname'] . " " . $result['adm_number'].'<br>'.'<br>';

                            echo "cat".'<br>'.'<br>';

                            echo "<input type = 'text' name =cat>".'<br>'.'<br>';
                            echo "main".'<br>'.'<br>';
                            echo "<input type = 'text' name =main >".'<br>'.'<br>';
                            echo "<hr>";

                            
                         
                            
                           
                            
                           

                        }
                       
                    }
                    
                   
                    echo "<input type = 'submit' name = 'submit'>".'<br>'.'<br>';
                }
            } else {
                echo "<script>
        alert('field cannot be empty');
        window.location.href = 'test.php';
        </script>
        
         ";
            }
        }elseif((isset($_GET['editid']))){
            $_SESSION['id'] = $_GET['editid'];
            $sql = "SELECT * FROM student_details where id =".$_GET['editid'];
            $resultset = $db->query($sql);
         while ($row = $resultset->fetch_assoc()) {
                
                      
                echo "
                Name <br><br>
                <input type='text' name='sname'  value='"  .$row['Sname']. "'> <br><br>
                Adm Number <br><br>
                <input type='text' name='adm_number' value='" . $row['adm_number']. "'> <br><br>
              
    
                
                
                ";
              
                
  
    
                
            
        }
            $sql = "SELECT `year`,semester FROM stage where id = (SELECT stage_id from student_sem where student_id = ".$_GET['editid'].")";
            $stageresult = $db->query($sql);

            while($stages = $stageresult->fetch_assoc()){
                
                   
                    echo "
                    YEAR <br><br>
            <input type='text' name='year'  value='" .$stages['year']. "'> <br><br>
            SEMESTER <br><br>
            <input type='text' name='semester' value='". $stages['semester']. "'> <br><br>
          

            
            
            ";

                
            }

          //  echo "<input type = 'submit' name = 'update' value = 'Update'";
           
        }

       
        
       
        ?>
     <input type="submit" name="update" value="update">

    </form>

</body>

</html>
<?php
 if(isset($_POST['submit'])){
     
 

//   var_dump($ids);
//var_dump($_SESSION['ADM']);
foreach($_SESSION['ADM'] as $adm){
 $ids = select_studentId($db,$adm);
  
    foreach($ids as $id){
        // var_dump($_POST['cat']);
        // var_dump($_POST['main']);
  

        
        
        //echo $_SESSION['unit'];
insertResult($db,$_SESSION['unit'],$id['ID'],$_POST['cat'],$_POST['main']);
echo "
<script>
alert('inserted');
window.location.href = 'login_file.php';

</script>
";
           // echo $id['ID'];                   

    }
}

  
   
   
}
if(isset($_POST['update'])){
    $id;
    
    if($_SESSION['user']==='Admin'){
        updateStudent($db,$_SESSION['id'],$_POST['sname'],$_POST['adm_number']);
        //select stage id
        $sql = "SELECT ID FROM stage where `year` = ".$_POST['year']." AND semester = ".$_POST['semester'];
        $resultset = $db->query($sql);

        while($row = $resultset->fetch_assoc()){
$id = $row['ID'];
        }
        updateStudentStage($db,$_SESSION['id'],$id);
     //echo $id;

    }else{
        $lecDB = mysqli_connect("localhost","Lecturer","","mas");
        updateStudent($lecDB,$_SESSION['id'],$_POST['sname'],$_POST['adm_number']);
    }
}