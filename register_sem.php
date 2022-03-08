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
    <title>register_units</title>
    <link
      rel="stylesheet"
      href="./bootstrap-5.1.3-dist/css/bootstrap.min.css"
    />
   
    <link rel="stylesheet" href="./fontawesome-free-6.0.0-web/css/all.css" />
   
 </head>
 <body>
   <form action="index.php" method="post">
     <?php
   $sql = "SELECT `year`,semester FROM stage";
$resultSet = $db->query($sql);
while ($row = $resultSet->fetch_assoc()) {
    echo  "<input type = 'radio' name= 'radio' value = '".$row['year'].$row['semester']."'/> YEAR ".$row ['year']." SEMESTER ". $row ['semester'].'<br>';
    
}
'<br>';
?>
   
      <button type='submit' class='btn btn-primary' name = "registered_sem">Register sem</button>

   </form>
   
 </body>
 </html>



