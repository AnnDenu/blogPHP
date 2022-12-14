<?php
require_once "DB.php";

return (new db())->deletePost($_GET['id_post']);