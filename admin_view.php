<?php require_once "db_connect.php";

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
}


$sql = "SELECT prompt,sent_at FROM prompt WHERE user_id=".$_SESSION['user_id'];
$result=mysqli_query($conn,$sql)

?>
<?php include("header.html")?>
    <title>View</title></head>
    <body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-md">
            <a class="navbar-brand" href="welcome.php">Home</a>
            <a class="nav-link link-light" href="logout.php" >Log out</a>
        </div>
    </nav>
        <?php
        if(isset($result)){
            if (mysqli_num_rows($result)==0){
                echo"No Data Found!!";
            }
        }
        ?>
        <?php foreach ($result as $row){ ?>
<!--    <div class="card text-bg-dark mb-3">-->
<!--        <div class="card-header">--><?php //echo $row['sent_at']?><!--</div>-->
<!--        <div class="card-body">-->
<!--            <p class="card-text">--><?php //echo $row['prompt']?><!--</p>-->
<!--        </div>-->
        <br><div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p><?php echo $row['prompt']?></p>
                    <footer class="blockquote-footer"><?php echo $row['sent_at']?></footer>
                </blockquote>
            </div>
        </div>
        <?php } ?>
    </body>
    </html>