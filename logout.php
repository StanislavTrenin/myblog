<?php
session_start();
unset($_SESSION["nome"]);
if(session_destroy()) {
    header("Location: index.php");
}
?>