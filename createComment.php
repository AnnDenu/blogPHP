<?php
require_once "DB.php";
if(isset($_GET['id_user']) AND isset($_GET['id_post']) AND isset($_GET['text'])) {
    $a = (new db())->createComment($_GET['id_user'], $_GET['id_post'], $_GET['text']);
    header("Location: post.php?id_post=".$_GET['id_post']);
}