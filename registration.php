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
include("config.php");
session_start();

if(isset($_POST['submit'])) {

    $myusername = $_POST['username'];
    $mymail = $_POST['mail'];
    $mypassword = $_POST['password'];
    $myconfirm = $_POST['confirm'];
    $myfname = $_POST['first_name'];
    $mysname = $_POST['second_name'];

    $sql = "SELECT count(*) FROM blog_users WHERE login = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$myusername]);
    $count = $stmt->fetchColumn();

    if($count == 0) {

        $sql = "SELECT count(*) FROM blog_users WHERE mail = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$mymail]);
        $count = $stmt->fetchColumn();

        if($count == 0) {

            $sql = "INSERT INTO blog_users (mail, login, password, first_name, second_name, confirm) VALUES (?, ?, ?, ?, ?, ? )";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$mymail, $myusername, $mypassword, $myfname, $mysname, 0]);

            $sql = "SELECT user_id FROM blog_users WHERE login = ? and password = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$myusername, $mypassword]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $myid = $row['user_id'];

            $_SESSION['user_login'] = $myusername;
            $_SESSION['user_id'] = $myid;
            header("location: posts.php");

        } else {
            $error = "This mail already in use!!!";
        }

    } else {
        $error = "This login name already in use!!!";
    }



}
?>

<div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Registration</b></div>

        <div style = "margin:30px">

            <form action = "" method = "post">
                <label>Login name  :</label><input type = "text" name = "username" class = "box" required/><br /><br />
                <label>Mail address  :</label><input type = "text" name = "mail" class = "box" required/><br/><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" required/><br/><br />
                <label>Confirm  :</label><input type = "password" name = "confirm" class = "box" required/><br/><br />
                <label>First name  :</label><input type = "text" name = "first_name" class = "box" required/><br/><br />
                <label>Second name  :</label><input type = "text" name = "second_name" class = "box" required/><br/><br />
                <input type = "submit" name = "submit" value = " Submit "/>
            </form>

            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

        </div>

    </div>

</div>
<h2><a href = "index.php">Go back</a></h2>

</body>
</html>