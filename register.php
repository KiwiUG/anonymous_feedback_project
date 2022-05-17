<?php
require_once "db_connect.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                    echo $username_err;
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 8) {
        $password_err = "Password cannot be less than 8 characters";
    } else {
        $password = trim($_POST['password']);
    }

// Check for confirm password field
    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $password_err = "Passwords should match";
    }
//user id
    $temp_user_id=rand(10000,99999);
    $sql1 = "SELECT id FROM users WHERE user_id = ?";
    $stmt1 = mysqli_prepare($conn, $sql1);
    if ($stmt1) {
    mysqli_stmt_bind_param($stmt1, "i", $param_user_id);
    $param_user_id = $temp_user_id;
    }else{
        echo "Something went wrong.Please try again.";
    };
    if(empty($sql1)){
        $user_id=$temp_user_id;
    }else{
        $user_id=rand(10000,99999);
    }
    mysqli_stmt_close($stmt1);

// If there were no errors, go ahead and insert into the database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (username, password,user_id) VALUES (?, ?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssi", $param_username, $param_password,$param_user_id);

            // Set these parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_user_id = $user_id;

            // Try to execute the query
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}else{
    $user_id=rand(10000,99999);
}

?>

<?php include"header.html"?>
</head>
<body>
<h1>Php Login System</h1>


<div class="container mt-4">
    <hr>
    <form action="register.php" method="post">

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="Username cannot be changed after" required autofocus><br><br>

        <label for="password">Password:</label>
        <input type="password"  name="password" id="password" placeholder="Password" required autofocus><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password"  name="confirm_password" id="confirm_password" placeholder="Confirm Password" required autofocus><br><br>

        <button type="submit" >Sign in</button><br>

        <a href="login.php">Already have an account?</a>
    </form>
</div>
</body>
</html>


















