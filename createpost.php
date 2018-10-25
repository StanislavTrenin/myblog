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

if(!isset($_SESSION['user_id'])) {
    header("location: index.php");
} else {
    if(isset($_POST['create'])) {
        $mytitle = $_POST['title'];
        $mytext = $_POST['text'];
        $myid = $_SESSION['user_id'];
        $myname = $_SESSION['user_login'];
        $mydate = date('Y-m-d G:i:s');

        echo "$mytitle $mytext $myid $myname $mydaete";

        $sql = "INSERT INTO blog_posts (author_id, title, date, text) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$myid, $mytitle, $mydate, $mytext]);
        header("location: posts.php");
    }
}



?>

<div align = "center">
    <div style = "width:600px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Create new post</b></div>

        <div style = "margin:60px">

            <form action = "" method = "post">
                <label>Title  :</label><input type = "text" name = "title" class = "box" required/><br /><br />
                <p><textarea rows="10" cols="60" name="text" required></textarea></p><br /><br />
                <input type = "submit" name = "create" value = " Create post "/><br />
            </form>

            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

        </div>

    </div>

</div>

<h2><a href = "posts.php">Back to other posts</a></h2>

</body>
</html>
