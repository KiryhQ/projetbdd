<?php
require_once './model/Manager.php';
class PostManager extends Manager
{

    public function getPosts()
    {

        $db = $this->dbConnect();

        $req = $db->query('SELECT * FROM post INNER JOIN write_post ON write_post.id_post=post.id_post
                                            INNER JOIN user on user.id_user=write_post.id_user');

        return $req;
        // ON user.id_user=post.id_post ORDER BY id_post
    }

    public function getPost($id_post)
    {

        $db = $this->dbConnect();

        $post = $db->prepare('SELECT * FROM post INNER JOIN write_post ON write_post.id_post=post.id_post
        INNER JOIN user on user.id_user=write_post.id_user WHERE post.id_post=?');
        $post->execute(array($id_post));

        return $post;
    }

    public function createArticle($param1, $param2, $param3)
    {

        $db = $this->dbConnect();

        $req = $db->prepare('INSERT INTO post(title_post, content_post, date_post) VALUES (:titre, :contenu, NOW())');
        $req->execute(array('titre' => $param2, 'contenu' => $param3));
        $postId = $db->lastInsertId();

        $req = $db->prepare('INSERT INTO write_post(id_post, id_user) VALUES(:id1, :id2)');
        $req->execute(array("id1" => $postId, "id2" => $param1));
    }

    public function deletePostFromDb($param)
    {
        $db = $this->dbConnect();
        $del = $db->prepare('DELETE from write_post WHERE id_post=(:id)');
        $del->execute(array(
            "id" => $param,
        ));
        $req = $db->prepare('DELETE from post WHERE id_post =(:id)');
        $req->execute(array(
            "id" => $param,
        ));
        return $req;
    }
    public function getPostModified($param1, $param2, $param3)
    {

        $db = $this->dbConnect();
        $update = $db->prepare('UPDATE post SET title_post=(:title), content_post=(:content) WHERE id_post = (:idpost)');
        $update->execute(array(
            "title" => $param1,
            "content" => $param2,
            "idpost" => $param3,
        ));
    }

}
