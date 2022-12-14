<?php
    include('config.php');
    if (isset($_POST['register'])) {
        $login = $_POST['login'];
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $patronymic = $_POST['patronymic'];
        $password = $_POST['password'];
        $bio = $_POST['bio'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $connection->prepare("SELECT * FROM users WHERE login=:login");
        $query->bindParam("login", $login, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            echo '<p class="error">Этот логин уже зарегистрирован!</p>';
        }
        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO users(login, last_name, first_name, patronymic, password, bio) VALUES (:login, :last_name, :first_name, :patronymic, :password_hash,:bio)");
            $query->bindParam("login", $login, PDO::PARAM_STR);
            $query->bindParam("last_name", $last_name, PDO::PARAM_STR);
            $query->bindParam("first_name", $first_name, PDO::PARAM_STR);
            $query->bindParam("patronymic", $patronymic, PDO::PARAM_STR);
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $query->bindParam("bio", $bio, PDO::PARAM_STR);
            $result = $query->execute();
            if ($result) {
               header('login.php');
            } else {
                echo '<p class="error">Неверные данные!</p>';
            }
        }
    }
?>

<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post" action="" name="signup-form">
<div class="form-element">
<label>Login</label>
<input type="text" name="login" pattern="[a-zA-Z0-9]+" required />
</div>
<div class="form-element">
<label>Last Name</label>
<input type="text" name="last_name" required />
</div>
    <div class="form-element">
        <label>First Name</label>
        <input type="text" name="first_name" required />
    </div>
    <div class="form-element">
        <label>Patronymic</label>
        <input type="text" name="patronymic" required />
    </div>
<div class="form-element">
<label>Password</label>
<input type="password" name="password" required />
</div>
    <div class="form-element">
        <label>BIO</label>
        <input type="text" name="bio" required />
    </div>
<button type="submit" name="register" value="register">Register</button>
</form>

</body>
</html>