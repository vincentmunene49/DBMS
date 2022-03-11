<?php
session_start();
if (isset($_POST['user'])) {
  
    $_SESSION['user'] = $_POST['user'];

    if ($_SESSION['user'] === "Admin") {
        require_once "config.php";
        require_once "database.php";

        if($_POST['pass'] ===""){
          echo "<script>
            alert('Password cannot be empty for admin');
            window.location.href = 'login_file.php';
            </script>
          
          ";

        }elseif($_POST['pass']!== PASSWORD){
          echo "<script>
            alert('Password is wrong');
            window.location.href = 'login_file.php';
            </script>
          
          ";

        }else{
         
          $db = connect(DB_SERVER, USER, PASSWORD, DB_NAME);
        
        }



    } else {
     
        $conn = mysqli_connect("localhost", "Lecturer", "", "mas");

    }
    echo "Logged In as"." ".$_SESSION['user'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.1.3-dist/css/bootstrap.min.css" />
    <title>Lecturer and Admin</title>
</head>

<body>
    <form action="update_students.php" method="post">


<div class="container">
<div>
        <br>
        <button type="submit" name="new_student" class="btn btn-primary">Insert Student</button>

      </div>

      <div>
        <br>
        <button type="submit" name="update_student" class="btn btn-primary">Update Students</button>

      </div>
      <div>
        <br>
        <button type="submit" name="new_result" class="btn btn-primary">Insert Results</button>

      </div>
     
      <div>
        <br>
        <button type="submit" name="backup" class="btn btn-primary">Backup</button>

      </div>
     

</div>




</form>

</body>

</html>
<?php
