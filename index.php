<?php
session_start(); // Faire le plus tôt possible (Dans le routeur en général). Ainsi la session est présente sur tout le site.
require 'app.php';

$app = new App();

$app->run();
