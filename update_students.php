<?php

session_start();
$_SESSION['id'] = [];

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
    <form action="edit.php" method="post">

    <?php
    if (isset($_POST['update_student'])) {
        require_once "config.php";
        require_once "database.php";
       
        $db = connect(DB_SERVER, USER, PASSWORD, DB_NAME);
    
        //SELEC ALL STUDENTS 
    
        $sql = "SELECT * FROM student_details";
        $resultset = $db->query($sql);
     while ($row = $resultset->fetch_assoc()) {

       
        foreach ($resultset as $result) {
            
                  
            echo "
            Name <br><br>
            <input type='text' name='student[]'  value='"  .$result['Sname']. "' readonly> <br><br>
            Adm Number <br><br>
            <input type='text' name='student[]' value='" . $result['adm_number']. "' readonly> <br><br>
          

            
            
            ";
            //select id
           // $id = $result['id'];
            //select the year and semester
            
           
            echo "<a href='edit.php?editid=".$result['id']."'>Edit</a>" ."<br>"."<br>";
            echo "<hr>";

            
        }
    }
    
    ?>
   
    <?php }
    
    if(isset($_POST['new_result'])){
        echo "Enter unit u wish to insert Results for".'<br>'.'<br>';
        echo "<input type = 'text' name ='unit'>".'<br>'.'<br>';
        echo "<button type = 'submit' name = 'insert_result'  value = 'OK'>OK</buttom>";
            
    }
    if(isset($_POST['new_student'])){
        echo "
        <script>
        window.location.href = 'register.html';
        </script>
        
        
        ";
    }
    if(isset($_POST['backup'])){
        require_once "config.php";
        require_once "database.php";
       
        $db = connect(DB_SERVER, USER, PASSWORD, DB_NAME);

        if($_SESSION['user']!= "Admin"){
            echo"
            <script>
            alert('Only admin can backup the database');
            window.location.href = 'login_file.php';
            </script
            
            ";
        }else{
            backup($db,'student_details');
           echo" <script>
            window.location.href = 'login_file.php';
            </script>
            ";

        }
      
    }
 



?>

    </form>
   
    
</body>
</html>