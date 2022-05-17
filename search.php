<?php
require_once "db_connect.php";

if (isset($_POST["search_keyword"]) && isset($_POST["search_field"])) {
    $search_keyword = $_POST["search_keyword"];
    $search_field = $_POST["search_field"];
    if ($search_field == "first_name") {
        $sql = "SELECT * FROM persons where first_name LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    } else if ($search_field = "last_name") {
        $sql = "SELECT * FROM persons where last_name LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    } else if ($search_field = "email") {
        $sql = "SELECT * FROM persons where email LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    }
}?>
<html>
    <head><title>Retrieve</title></head>
    <body>
    <a href="create.php">Create</a>

    <table border="1">
        <tr>
            <th>id</th>
            <th>Image</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($result as $row){ ?>
            <tr>
                <td><?php echo$row['id']?></td>
                <td><img src="upload/<?php echo $row['image']?>" height= "2%" width="5%"></td>
                <td><?php echo $row['first_name']?></td>
                <td><?php echo $row['last_name']?></td>
                <td><?php echo $row['email']?></td>
                <td><a href="update_details.php?id=<?php echo $row["id"]?>">Edit</a></td>
                <td><a href="delete_details.php? id=<?php echo $row["id"]?>">Delete</a> </td>
            </tr>

        <?php } ?>
    </table>
    </body>
    </html>