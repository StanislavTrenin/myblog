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

    $post_id = $_GET['post_id'];

    $sql = "SELECT * FROM blog_posts WHERE post_id = ?";
    $posts = $pdo->prepare($sql);
    $posts->execute([$post_id]);
    $row = $posts->fetch();


    if(!empty($row)) {
        $author = $row['author_id'];
        $me = $_SESSION['user_id'];
        $title = $row['title'];
        if ($_SESSION['user_id'] == $row['author_id']) {


            print "<div align = \"center\">
    <div style = \"width:600px; border: solid 1px #333333; \" align = \"left\">
        <div style = \"background-color:#333333; color:#FFFFFF; padding:3px;\"><b>Create new post</b></div>

        <div style = \"margin:60px\">

            <form action = \"\" method = \"post\">
                <label>Title  :</label><input type = \"text\" name = \"title\" class = \"box\" value = '".$title."'required/><br /><br />
                <p><textarea rows=\"10\" cols=\"60\" name=\"text\" required>".$row['text']."</textarea></p><br /><br />
                <input type = \"submit\" name = \"edit\" value = \" Edit post \"/><br />
            </form>

            <div style = \"font-size:11px; color:#cc0000; margin-top:10px\"><?php echo $error; ?></div>

        </div>

    </div>

</div>

        ";

            if (isset($_POST['edit'])) {
                $mytitle = $_POST['title'];
                $mytext = $_POST['text'];
                $myid = $_SESSION['user_id'];
                $myname = $_SESSION['user_login'];
                $mydate = date('Y-m-d G:i:s');

                //echo "$mytitle $mytext $myid $myname $mydate";

                $sql = "UPDATE blog_posts SET date = ?, title = ?, text = ? WHERE post_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$mydate, $mytitle, $mytext, $post_id]);
                header("location: posts.php");
            }
        } else {
            print "<br/><h1>Oops! You are not a post owner. Does anybody changed URL?</h1>";
        }
    } else {
        print "<br/><h1>Oops! This page doesn't exist. Does anybody changed URL?</h1>";
    }
}



?>

<h2><a href = "posts.php">Back to other posts</a></h2>

</body>
</html>