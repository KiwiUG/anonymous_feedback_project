<?php require_once 'db_connect.php';
session_start(); ?>
<?php include("header.html")?>
<title>Welcome</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="welcome.php">Home</a>
</nav>
<div class="container mt-4">
    <div id="input">
        <form action="" method="post">
            Insert the unique id:<input type="number" name="user_id" required>
        <button type="submit">Send</button>
        </form>
    </div>
</div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $temp_user_id=trim($_POST['user_id']);
    $sql1 = "SELECT user_id FROM users WHERE user_id = ?";
    $result = mysqli_query($conn, $sql1);
    $count = mysqli_num_rows($result);
    if($count==1){
                header("location: prompt_input.php");
    }else{
                echo"Your unique id was incorrect. Please enter carefully.";
            }};
    mysqli_close($conn);
?>