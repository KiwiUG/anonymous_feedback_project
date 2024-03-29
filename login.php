<?php
//This script will handle login
require_once "db_connect.php";

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username and password";
        echo $err;
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


    if(empty($err)){
        $sql = "SELECT username, password,user_id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

        // Try to execute this statement
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt, $username, $hashed_password, $user_id);
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password, $hashed_password))
                    {
                        // this means the password is correct. Allow user to login
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["user_id"] = $user_id;
                        $_SESSION["loggedin"] = true;

                        //Redirect user to welcome page
                        header("location: admin_view.php");

                    }
                }

            }

        }
    }


}


?>
<?php include("header.html")?>
    <title>Login</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-md">
        <a class="navbar-brand" href="welcome.php">Home</a>
    </div>
</nav>
<div class="container mt-4">
    <form action="login.php" method="post" class="form -control">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

        <label for="username" class="sr-only">Username:</label>
        <input type="text" name="username" class="form-control" placeholder="Enter your valid username" required autofocus><br><br>

        <label for="Password" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter your password" required><br><br>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>

        <button class="btn btn-lg btn-primary btn-dark" type="submit">Sign in</button><br>
    </form>

    <a href="register.php">A New User?</a>

</div>
</body>
</html>



