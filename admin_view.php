<?php
require_once "db_connect.php";

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
}


$sql = "SELECT user_id FROM users WHERE username=?";
$username=$_SESSION['username'];
$result=mysqli_query($conn,$sql);
print_r($result);
print_r($sql);
?>
<!--    <html>-->
<!--    <head><title>View</title></head>-->
<!--    <body>-->
<!--    <table border="1">-->
<!--        <tr>-->
<!--            <th width="100px">Prompt</th>-->
<!--            <th>Time</th>-->
<!--        </tr>-->
<!--        --><?php
//        if(isset($result)){
//            if (mysqli_num_rows($result)==0){
//                echo"<tr>";
//                echo"<td colspan='7'>No Data Found!!!</td>";
//                echo"</tr>";
//            }
//        }
//        ?>
<!--        --><?php //foreach ($result as $row){ ?>
<!--            <tr>-->
<!--                <td>--><?php //echo$row['prompt']?><!--</td>-->
<!--                <td>--><?php //echo $row['sent_at']?><!--</td>-->
<!--            </tr>-->
<!---->
<!--        --><?php //} ?>
<!--    </table>-->
<!--    </body>-->
<!--    </html>-->