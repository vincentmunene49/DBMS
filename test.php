<?php
require_once "config.php";
require_once "database.php";

$db = connect(DB_SERVER,USER,PASSWORD,DB_NAME);

$result = selectUser($db);
var_dump($result);