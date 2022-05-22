<?php include("header.html")?>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-md">
        <a class="navbar-brand" href="welcome.php">Home</a>
        <a class="nav-link" href="login.php" >Log in</a>
    </div>
</nav>
<h1>Thank You. Your Reply was successfully sent</h1>
<a href="welcome.php">Want to send again?</a>
<?php session_destroy()?>
</body>
</html>
