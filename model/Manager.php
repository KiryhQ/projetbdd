<?php 

class Manager {

    protected function dbConnect()
    {
            $bdd = new PDO('mysql:host=localhost;dbname=blogdeux;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $bdd;
    }
}