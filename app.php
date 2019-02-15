<?php
require 'controler/controller.php';

class App
{
    private $controller;

    public function __construct()
    {

        $this->controller = new Controler();
    }

    public function run()
    {

        try {

            if (isset($_GET['action'])) {

                if ($_GET['action'] == 'listPosts') {

                    $this->controller->listPosts();

                } elseif ($_GET['action'] == 'post') {

                    if (isset($_GET['id_post']) && $_GET['id_post'] > 0) {

                        $this->controller->post();
                    } else {

                        echo 'Erreur : aucun identifiant de billet envoyé';

                    }

                } elseif ($_GET['action'] == "addComments") {

                    $this->controller->redirectComments($_GET['id_user'], $_POST['commentary']);

                } elseif ($_GET['action'] == "addArticle") {

                    $this->controller->redirectArticle($_GET['id_user']);
                } elseif ($_GET['action'] == "GoToSubscribe") {

                    require 'views/subscribeView.php';
                } elseif ($_GET['action'] == "subscribe") {

                    $name = $_POST['username_subscribe_beabook'];
                    $pwd = password_hash($_POST['password_subscribe_beabook'], PASSWORD_DEFAULT);
                    $email = $_POST['email_subscribe_beabook'];
                    $birth = $_POST['birth_subscribe_beabook'];
                    $role = intval($_POST['role']);

                    $this->controller->addNewUser($name, $pwd, $email, $birth, $role);
                } elseif ($_GET['action'] == "login") {
                    $username = $_POST['username_beabook'];
                    $password = $_POST['password_beabook'];
                    $this->controller->attemptToLogin($username, $password);

                } elseif ($_GET['action'] == "deletePost") {
                    $this->controller->deletePost($_GET['id_post']);
                } elseif ($_GET['action'] == "disconnect") {
                    $this->controller->disconnect();
                } elseif ($_GET['action'] == "signal") {
                    $this->controller->signalComment($_GET['id_comment']);
                } elseif ($_GET['action'] == "modifyPost") {
                    require 'views/modifyPostView.php';
                } elseif ($_GET['action'] == "modifyingPostForm") {
                    $title = $_POST['blog_title'];
                    $content = $_POST['blog_post'];
                    $this->controller->modifyPost($title, $content, $_GET['id_post']);
                } elseif ($_GET['action'] == "returnAdmin") {
                    $this->controller->returnAdminView();
                } elseif ($_GET['action'] == "returnUser") {
                    $this->controller->returnUserView();
                } elseif ($_GET['action'] == "getCommentAdmin") {
                    $this->controller->postAdmin();
                } elseif ($_GET['action'] == "deleteComment") {
                    $this->controller->deleteCommentAdmin($_GET['id_comment']);
                }

            } else {

                // $this->controller->listPosts();
                $this->controller->GoToLogin();

            }} catch (Exception $e) {

            die("Erreur : " . $e->GetMessage());

        }
    }
}
