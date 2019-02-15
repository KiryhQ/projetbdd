<?php
require_once './model/Manager.php';
class CommentManager extends Manager
{

    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare("SELECT commentary.id_user, user.nom_user,  title_post, post.id_post, comment_signal, id_commentary, content_commentary, date_commentary FROM commentary INNER JOIN user on user.id_user=commentary.id_user
        INNER JOIN post on post.id_post=commentary.id_post WHERE post.id_post=? ");

        $comments->execute(array($postId));

        return $comments;
    }

    public function createComments($userParam, $commentParam)
    {

        if (isset($_POST['commentary'])) {

            $db = $this->dbConnect();

            $createComments = $db->prepare("INSERT INTO commentary(content_commentary, date_commentary, id_user, id_post) VALUES (:content, NOW(), :user, :post)");
            $createComments->execute(array("content" => $commentParam, "user" => $userParam, "post" => $_GET['id_post']));
        } else {
            echo 'Veuilliez ajouter un commentaire';
        }
    }
    public function signal($param)
    {

        $db = $this->dbConnect();

        $req = $db->prepare('UPDATE commentary SET comment_signal=comment_signal+1 WHERE id_commentary=(:id)');
        $req->execute(array(
            "id" => $param,
        ));
    }
    public function deleteComment($param)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('DELETE FROM commentary WHERE id_commentary=(:id)');
        $req->execute(array(
            "id" => $param,
        ));
    }
}
