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

<div align = "center">
    <div style = "width:600px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Create new post</b></div>

        <div style = "margin:60px">

            <form action = "" method = "post">
                <label>Title  :</label><input type = "text" name = "title" class = "box"/><br /><br />
                <p><textarea rows="10" cols="60" name="text"></textarea></p><br /><br />
                <input type = "submit" name = "create" value = " Create post "/><br />
            </form>

            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

        </div>

    </div>

</div>

<h2><a href = "posts.php">Back to other posts</a></h2>

</body>
</html>
