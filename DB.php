<?php

class db
{

    private $db;

    /**
     * Подключение к БД
     */
    public function __construct()
    {
        $this->db = new PDO('mysql:host=10.100.3.80;dbname=20269_blog', '20269', 'xiiiiq');
    }

    //Запрос на вывод всех авторов

    public function getUsers(): array
    {
        return ($this->db->query('SELECT * FROM users'))->fetchAll();
    }
    //Запрос на вывод всех постов

    public function getPosts(): array
    {
        return ($this->db->query('SELECT * FROM post INNER JOIN users ON post.id_user=users.id'))->fetchAll();
    }

    //Запрос на вывод всех комментариев

    public function getComments(): array
    {
        return ($this->db->query('SELECT * FROM comment JOIN users ON comment.id_user=users.id'))->fetchAll();
    }

    //Запрос на вывод авторов по id

    public function getAutor($user)
    {
        return ($this->db->query('SELECT * FROM users WHERE id = '.$user))->fetchAll(PDO::FETCH_CLASS);;
    }

    //Запрос на вывод постов по id пользователя

    public function getPost($user)
    {
        return ($this->db->query('SELECT * FROM post JOIN users ON post.id_user=users.id WHERE id_user = '.$user))->fetchAll(PDO::FETCH_CLASS);;
    }

    //Запрос на количество постов по id пользователя

    public function getPostCol($users)
    {
        return ($this->db->query('SELECT COUNT(*) as count FROM post WHERE id_user = '.$users))->fetchColumn();
    }

    //Запрос на вывод постов по id поста

    public function getPostON($post)
    {
        return ($this->db->query('SELECT * FROM post JOIN users ON post.id_user=users.id WHERE id_post = '.$post))->fetchAll(PDO::FETCH_CLASS);
    }

    //Запрос на вывод комментариев по id пользователя

    public function getComment($user)
    {
        return ($this->db->query('SELECT * FROM comment WHERE id_user = '.$user))->fetchAll(PDO::FETCH_CLASS);
    }

    //Запрос на количество комментариев по id пользователя

    public function getCommentCol($users)
    {
        return ($this->db->query('SELECT COUNT(*) as count FROM comment WHERE id_user = '.$users))->fetchColumn();
    }

    //Запрос на вывод комментариев по id пользователя

    public function getCommentON($post)
    {
        return ($this->db->query('SELECT * FROM comment JOIN users ON comment.id_user=users.id WHERE id_post = '.$post))->fetchAll(PDO::FETCH_CLASS);
    }

    //Добавление поста

    //Добавление комментария

    // Удаление комментария

    public function deleteComment(int $id_comment): bool
    {
        return ($this->db->prepare("DELETE FROM comment WHERE id_comment = ?"))->execute([$id_comment]);
    }

    // Удаление комментария

    public function deletePost(int $id_post): bool
    {
        return ($this->db->prepare("DELETE FROM post WHERE id_post = ?"))->execute([$id_post]);
    }

    public function createPost(string $name, string $id_user, string $description, string $picture): bool
    {
        $result = $this->db->prepare("INSERT INTO post (name, id_user, description, picture) VALUES (:name, :id_user, :description, :picture)");
        return $result->execute([
            ':name' => $name,
            ':id_user' => $id_user,
            ':description' => $description,
            ':picture' => $picture
        ]);
    }

    public function createComment(string $id_user, string $id_post, string $text): bool
    {
        $result = $this->db->prepare("INSERT INTO comment (id_user, id_post, text) VALUES (:id_user, :id_post, :text)");
        return $result->execute([
            ':id_user' => $id_user,
            ':id_post' => $id_post,
            ':text' => $text
        ]);
    }

}
?>