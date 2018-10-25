<html>

<head>
    <title>MyBlog</title>

    <style type = "text/css">
        body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
        }
        label {
            font-weight:bold;
            width:100px;
            font-size:14px;
        }
        .box {
            border:#666666 solid 1px;
        }
    </style>

</head>

<body bgcolor = "#FFFFFF">

<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    header("location: index.php");
}
?>

<h1>Welcome <?php echo $_SESSION['user_login']; ?></h1>

<form action = "createpost.php" method = "post">
    <input type = "submit" name = "submit" value = " Create new post "/>
</form>

<?php
    echo"Here will be awesome posts!!!";
?>



<h2><a href = "logout.php">Sign Out</a></h2>

</body>
</html>
