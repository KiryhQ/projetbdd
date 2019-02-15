<?php $title = "Béa-Book"?>


<?php ob_start();?>
<main id="login_view_bg">
<h1 id="title_login">Bienvenu sur BeaBooks</h1>
<div id="login_beabook">
<form action="index.php?action=login" method="post">
<input type="text" class="login_beabook" name="username_beabook" placeholder="Nom d'utilisateur">
<input type="password"  class="login_beabook" name="password_beabook" placeholder="Mot de passe">
<input type="submit"  id="connect_login" value="Se connecter">
</form>

<a href="index.php?action=GoToSubscribe">S'inscrire</a></a>
</div>


</main>

<?php $content=ob_get_clean();?>

<?php require './views/template.php';?>


