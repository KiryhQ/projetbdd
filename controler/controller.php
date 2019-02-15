<?php
require_once './model/PostManager.php';
require_once './model/CommentManager.php';
require_once './model/userManager.php';
class Controler
{

    private $commentManager;
    private $postManager;

    public function __construct()
    {

        $this->commentManager = new CommentManager();

        $this->postManager = new PostManager();

        $this->userManager = new userManager();

    }
    public function listPosts()
    {

        $req = $this->postManager->getPosts();
        require './views/affichageIndex.php';

    }
    public function post()
    {

        $post = $this->postManager->getPost($_GET['id_post'], $_GET['title_post']);
        $comments = $this->commentManager->getComments($_GET['id_post']);

        require './views/commentaire.php';

    }
    public function postAdmin()
    {

        $post = $this->postManager->getPost($_GET['id_post'], $_GET['title_post']);
        $comments = $this->commentManager->getComments($_GET['id_post']);

        require './views/commentAdmin.php';

    }
    public function redirectComments($userParam, $commentParam)
    {

        $comment = htmlspecialchars($commentParam);

        $this->commentManager->createComments($userParam, $comment);

        header("Location: index.php?action=post&id_post=" . $_GET['id_post'] . "&title_post=" . $_GET['title_post']);
    }

    public function redirectArticle($param1)
    {

        $user = $param1;
        $title = htmlspecialchars($_POST["blog_title"]);
        $content_post = htmlspecialchars($_POST["blog_post"]);

        $this->postManager->createArticle($user, $title, $content_post);
        $req = $this->postManager->getPosts();
        require 'views/viewAdminPosts.php';
    }

    public function GoToLogin()
    {

        require './views/loginView.php';
    }

    public function addNewUser($param1, $param2, $param3, $param4, $param5)
    {

        $this->userManager->addUser($param1, $param2, $param3, $param4, $param5);

        require './views/loginView.php';
    }

    public function attemptToLogin($param1, $param2)
    {

        $req = $this->userManager->checkingUser($param1);

        $donnees = $req->fetch();

        if ((password_verify($param2, $donnees['password_user'])) && ($param1 == $donnees['nom_user'])) {
            if ($donnees['role_user'] == 0) {
                $_SESSION['redacteur'] = $donnees;
                $req = $this->postManager->getPosts();
                require 'views/viewAdminPosts.php';

            } else {

                $_SESSION['lecteur'] = $donnees;
                $req = $this->postManager->getPosts();
                require 'views/viewUserPosts.php';

            }
        } else {
            header('Location: index.php');
        }

    }

    public function deletePost($param)
    {
        $this->postManager->deletePostFromDb($param);
        $req = $this->postManager->getPosts();
        require 'views/viewAdminPosts.php';
    }
    public function disconnect()
    {
        if (isset($_SESSION['redacteur'])) {
            unset($_SESSION['redacteur']);
            require 'views/loginView.php';
        } elseif (isset($_SESSION['lecteur'])) {
            unset($_SESSION['lecteur']);
            require 'views/loginView.php';
        } else {
            echo 'error';
            print_r($_SESSION['redacteur']);
        }
    }

    public function signalComment($param)
    {
        $this->commentManager->signal($param);
        header("Location: index.php?action=post&id_post=" . $_GET['id_post'] . "&title_post=" . $_GET['title_post']);
    }

    public function modifyPost($param1, $param2, $param3)
    {
        $this->postManager->getPostModified($param1, $param2, $param3);

        header("Location: index.php?action=returnAdmin");
    }
    public function returnAdminView()
    {
        $req = $this->postManager->getPosts();
        require 'views/viewAdminPosts.php';
    }
    public function returnUserView()
    {
        $req = $this->postManager->getPosts();
        require 'views/viewUserPosts.php';
    }public function deleteCommentAdmin($param)
    {
        $this->commentManager->deleteComment($param);

        $post = $this->postManager->getPost($_GET['id_post'], $_GET['title_post']);
        $comments = $this->commentManager->getComments($_GET['id_post']);

        require './views/commentAdmin.php';

    }
}
