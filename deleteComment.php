<?php
require_once "DB.php";

return (new db())->deleteComment($_GET['id_comment']);
?>