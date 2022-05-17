<?php require_once 'db_connect.php' ?>
<!doctype html>
<html lang="en">
<head>
    <title>Home</title>
</head>
<body>
<div class="container mt-4">
    <div id="input">
        <form action="" method="post">
            Insert the unique id:<input type="number" name="user_id" required>
            Enter Your text here:<input type="text" name="prompt" required>
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
                $sql = "INSERT INTO prompt(user_id,prompt) VALUES (?,?)";
                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "is", $user_id,$prompt);
                    $user_id=$temp_user_id;
                    $prompt = $_POST['prompt'];

                    if (mysqli_stmt_execute($stmt)) {
                        header("location: success.php");
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Something went wrong... cannot redirect!";
                        mysqli_stmt_close($stmt);
                    }
                };}else{
                echo"Your unique id was incorrect. Please enter carefully.";
            }};
    mysqli_close($conn);



?>