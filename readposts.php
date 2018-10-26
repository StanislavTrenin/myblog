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
}

$post_id = $_GET['post_id'];

$sql = "SELECT * FROM blog_posts WHERE post_id = ?";
$posts = $pdo->prepare($sql);
$posts->execute([$post_id]);
$row = $posts->fetch();


if(!empty($row)) {
    $sql2 = "SELECT first_name FROM blog_users WHERE user_id =  ?";
    $stmt = $pdo->prepare($sql2);
    $stmt->execute([$row['author_id']]);
    $rez = $stmt->fetch(PDO::FETCH_ASSOC);


    print "<br/><h2>" . $row['title'] . "</h2>";
    print $row['text'] . "<br/><br/>";
    print "Author: " . $rez['first_name'] . " Posted on: " . $row['date'];
} else {
    print "<br/><h1>Oops! This page doesn't exist. Does anybody changed URL?</h1>";
}
?>



<h2><a href = "posts.php">Back to other posts</a></h2>

</body>
</html>