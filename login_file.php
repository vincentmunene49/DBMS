<?php



require_once "config.php";
require_once "database.php";

$db = connect(DB_SERVER, USER, PASSWORD, DB_NAME);

$result = selectUser($db);

//var_dump($result);


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login_file</title>
  <link rel="stylesheet" href="./bootstrap-5.1.3-dist/css/bootstrap.min.css" />
</head>

<body>
  <form action="test.php" method="post">
    <div class="container">
      <div class="row">
        <h2 class="fs-b text-center">Login as</h2>
        <div class="input-group mb-3">
          <select class="form-select" name="user" id="inputGroupSelect03" aria-label="Example select with button addon">
            <option selected>Choose...</option>
            <?php


            foreach ($result as $key => $val) {


              if ($key === 0 || $key === 1) {
                echo '<option value="' . $val['USER'] . '">' . $val['USER'] . '</option>';
              } else {
                break;
              }
            }


            ?>

          </select>
        </div>
        <br><br>
        <div class="input-group">
          <input type="password" name="pass" placeholder="Password not required for Lecturer" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
        </div>

      </div>
      <div>
        <br>
        <button type="submit" name="login" class="btn btn-primary">Login</button>

      </div>

    </div>
 

  </form>

</body>

</html>