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

if(isset($_POST['create'])) {
    header("location: registration.php");
} else {
    if(isset($_POST['submit'])) {
        $myusername = $_POST['username'];
        $mypassword = $_POST['password'];

        $sql = "SELECT user_id FROM blog_users WHERE login = ? and password = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$myusername, $mypassword]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $myid = $row['user_id'];
        //echo"$myusername $mypassword $myid ";

        $sql = "SELECT count(*) FROM blog_users WHERE login = ? and password = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$myusername, $mypassword]);
        $count = $stmt->fetchColumn();
        //echo" count = $count";

        if($count == 1)
        {
            $_SESSION['user_login'] = $myusername;
            $_SESSION['user_id'] = $myid;
            header("location: posts.php");

        } else {
            $error = "Your Login Name or Password is invalid!!!";
        }

    }
}
?>

<div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

        <div style = "margin:30px">

            <form action = "" method = "post">
                <label>Login name  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                <input type = "submit" name = "submit" value = " Submit "/>
                <input type = "submit" name = "create" value = " Create account "/><br />
            </form>

            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

        </div>

    </div>

</div>

</body>
</html>