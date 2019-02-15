<?php
require_once('./model/Manager.php');

class userManager extends Manager{


    public function addUser($param1,$param2,$param3,$param4,$param5){

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO user(nom_user, password_user,email_user,birth_user,role_user) VALUES (:nom,:pwd,:mail,:birth,:role_user)');
        $req->execute(array(
            'nom' => $param1,
            'pwd' => $param2,
            'mail' => $param3,
            'birth' => $param4,
            'role_user' => $param5
        ));
    
        return $req;

    }

    public function checkingUser($param1){

        $db= $this->dbConnect();
        $req= $db->prepare('SELECT * from user WHERE nom_user=(:nom)');
        $req->execute(array(
            "nom" => $param1
        ));


        return $req;
    }


}