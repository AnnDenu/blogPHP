<?php
include "config.php";
include "DB.php";
if($_SERVER["REQUEST_METHOD"] === "GET" AND isset($_GET["id"])){
    $user = $_GET['id'];
    $data = (new db())->getAutor($user);
    if (count($data) > 0) {

        $post = (new db())->getPost($user);
        $comment = (new db())->getComment($user);
        ?>
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <meta name="description" content="" />
            <meta name="keywords" content="" />
            <title>Блог</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        </head>
        <body>
        <div>
            <div>
                <header class="header">
                    <div class="container-fluid">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                                <li class="nav-item"><a class="nav-link" href="index.php">Посты</a></li>
                                <li class="nav-item"><a class="nav-link" href="comments.php">Комментарии</a></li>
                                <li class="nav-item"><a class="nav-link active" href="autors.php">Авторы</a></li>
                                <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true) { ?>
                                    <a class="nav-item"> <a class="nav-link"></a> <?=$_SESSION['log_user']?> </a></li>
                                    <li class="nav-item"><a class="nav-link" href="logout.php">Выход</a></li>
                                <?php } else{?>
                                    <li class="nav-item"><a class="nav-link" href="login.php">Вход</a></li>
                                    <li class="nav-item"><a class="nav-link" href="register.php">Регистрация</a></li>
                                <?php }?>
                            </ul>
                        </nav>
                    </div>
                </header>
            </div>
            <div id="page">
                <div id="content">
                    <div class="box">
                        <h1>Авторы</h1>
                        <div class="container">
                                    <div class="card bg-light g-2">
                                        <div class="card-body">
                                            <?php foreach ($data as $data):?>
                                            <h5 class="card-title"> Автор: <?=$data->last_name?></h5>
                                            <p class="card-text"> Биография: <?=$data->bio?>
                                            </p>
                                            <h3>Посты</h3>
                                            <?php foreach($post as $post):?>
                                                <div class="card bg-secondary g-2">
                                                    <div class="card-body">
                                                        <h5 class="card-title"> <?=$post->name?></h5>
                                                        <p class="card-text"><?=$post->description?><br>

                                                            Дата публикации: <?=$post->datatime?>
                                                        </p>
                                                        <a href="post.php?id_post=<?=$post->id_post?>" class="btn btn-primary">Читать дальше</a>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                                <h3>Комментарии</h3>
                                                <?php foreach($comment as $comment):?>
                                                    <div class="card bg-secondary g-2">
                                                        <div class="card-body">

                                                            <p class="card-text"><?=$comment->text?><br>
                                                            
                                                                Дата публикации: <?=$comment->datatime?>
                                                            </p>
                                                            <a href="post.php?id_post=<?=$comment->id_post?>" class="btn btn-primary">Читать дальше</a>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </body>
        </html>

<?php    }
}
?>