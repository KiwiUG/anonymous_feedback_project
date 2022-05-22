<?php require_once 'db_connect.php' ?>
<?php include("header.html")?>
        <title>Home</title>
    </head>
    <body>
    <div class="container mt-4">
        <div id="input">
            <form action="" method="post">
                Insert your prompt:<input type="text" name="prompt" required>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
    </body>
    </html>
<?php
$sql = "INSERT INTO prompt(user_id,prompt) VALUES (?,?)";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "is", $user_id,$prompt);
    $user_id=$_SESSION['user_id'];
    $prompt = $_POST['prompt'];

    if (mysqli_stmt_execute($stmt)) {
        header("location: success.php");

    } else {
        echo "Something went wrong... cannot redirect!";
        header("location: welcome.php");
    }
    mysqli_stmt_close($stmt);
    session_destroy();
};