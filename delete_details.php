<?php
require_once "db_connect.php";
$sql = "DELETE FROM persons WHERE id =?";
if ($stmt = mysqli_prepare($conn,$sql)){
    mysqli_stmt_bind_param($stmt,"i",$param_id);
    $param_id = $_GET["id"];
    if(mysqli_stmt_execute($stmt)){

    }
}
    ?>
