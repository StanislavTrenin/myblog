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


?>

<h1>Welcome <?php echo $_SESSION['user_login']; ?></h1>


<form action = "createpost.php" method = "post">
    <input type = "submit" name = "submit" value = " Create new post "/>
</form>

<?php


    $sql = "SELECT count(*) FROM blog_posts";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    $perpage = 2;
    $first = 0;
    $last = round($count / $perpage) - 1;

    if( isset($_GET['page']) ) {
        $page = $_GET['page'];

    } else {
        $page = 0;
        $offset = 0;
    }
    $prev = $page - 1;
    $next = $page + 1;

    if(($page >= $first) && ($page <= $last)) {

        $start = $page * $perpage;
        $finish = $start + $perpage;

        $sql = "SELECT * FROM blog_posts ORDER BY date DESC";
        $posts = $pdo->query($sql);

        $index = 0;
        foreach ($posts as $row) {

            if(($index >= $start) && ($index < $finish)) {
                $sql2 = "SELECT first_name FROM blog_users WHERE user_id =  ?";
                $stmt = $pdo->prepare($sql2);
                $stmt->execute([$row['author_id']]);
                $rez = $stmt->fetch(PDO::FETCH_ASSOC);
                $string = substr($row['text'], 0, 50);


                print "<br/><h2>" . $row['title'] . "</h2>";
                print $string . "<br/><br/>";
                print "Author: " . $rez['first_name'] . " Posted on: " . $row['date'];
                print "<h4><a href = \"readposts.php?post_id=" . $row['post_id'] . "\">Read more</a></h4>";
                if ($_SESSION['user_id'] == $row['author_id']) {
                    print "<h4><a href = \"editposts.php?post_id=" . $row['post_id'] . "\">Edit posts</a></h4>";

                }
            }

            $index++;

        }

        if ($page != $first) {
            print "<a href = \"posts.php?page=" . $first . "\">First</a> |";
            print "<a href = \"posts.php?page=" . $prev . "\">Previous</a> |";
        }

        if ($page != $last) {
            print "<a href = \"posts.php?page=" . $next . "\">Next</a> |";
            print "<a href = \"posts.php?page=" . $last . "\">Last</a> |";
        }
    } else {
        print "<br/><h1>Oops! This page doesn't exist. Does anybody changed URL?</h1>";
    }
?>



<h2><a href = "logout.php">Sign Out</a></h2>

</body>
</html>
