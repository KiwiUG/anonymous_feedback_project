<?php require_once 'db_connect.php'; session_start(); ?>
<?php include("header.html")?>
<title>Welcome</title>
</head>
<body class=".bg-secondary">
<nav class="navbar navbar-dark bg-dark">
    <div class="container-md">
        <a class="navbar-brand" href="welcome.php">Home</a>
        <a class="nav-link link-light" href="login.php">Log in</a>
    </div>
</nav>
<div class="container mt-4">
        <form action="" method="post">
            <div class="d-flex justify-content-center align-items-center">
                <input type="number"  placeholder="Enter the unique id provided" name="user_id" class="form-control"  required>
                <button type="submit" class="btn btn-dark">Send</button>
            </div>
        </form>
</div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $temp_user_id=trim($_POST['user_id']);
    $sql1 = "SELECT * FROM users WHERE user_id = ?";
    $result = mysqli_query($conn, $sql1);
    $count = mysqli_num_rows($result);
    if($count==1){
                header("location: prompt_input.php");
        }else{
                echo"Your unique id was incorrect. Please enter carefully.";
            };
};
    mysqli_close($conn);
?>