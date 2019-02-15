<?php $title = "Béa-Book"?>


<?php ob_start();?>
<main id="login_view_bg">
<h1 id="title_login">Bienvenu sur BeaBooks</h1>
<div id="login_beabook">
<form action="index.php?action=subscribe" method="post">
<input type="text" class="subscribe_beabook" name="username_subscribe_beabook" placeholder="Nom d'utilisateur">
<input type="password"  class="subscribe_beabook" name="password_subscribe_beabook" placeholder="Mot de passe">
<input type="password"  class="subscribe_beabook" name="password_subscribe_beabook" placeholder="Confirmer votre mot de passe">
<input type="email" class="subscribe_beabook" name="email_subscribe_beabook" placeholder="Email">
<input type="date" class="subscribe_beabook" name="birth_subscribe_beabook">
<p id="p_subscribe">Êtes vous :</p>
<label for="role" class="label_subscribe">Redacteur</label>
<input type="radio" name="role" value="0">
<label for="role" class="label_subscribe">Lecteur</label>
<input type="radio" name="role" value="1">
<input type="submit"  id="subscribe" value="Inscrivez-vous">
</form>

<a href="index.php">Retour à l'accueil</a></a>
</div>


</main>

<?php $content=ob_get_clean();?>

<?php require './views/template.php';?>


