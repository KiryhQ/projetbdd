

<?php $title = $_GET['title_post']?>

<?php ob_start();?>
<div id="blogs">
<?php

while ($postPicked = $post->fetch()) {

    ?>


    <div id="titre_article"> <strong> <?=$postPicked['title_post']?> </strong></div> <br>
    <div id="contenu_article"> <?=$postPicked['content_post']?></div> <br>
    <div id="info_article">Posté par <strong><?=$postPicked['nom_user']?></strong> le :
        <?=$postPicked['date_post']?></div>
    <form action="index.php?action=addComments&id_post=<?=$postPicked['id_post']?>&title_post=<?=$postPicked['title_post']?>&id_user=<?=$_SESSION['lecteur'][0]?>" method="post">
        <label for="commentary">Votre commentaire</label>
        <textarea name="commentary" id="comment_section" cols="30" rows="1"></textarea>
        <input type="submit" name="submit_comment" value="envoyer"></form>
        <a href="index.php?action=returnUser">Retour à l'accueil</a>


    <?php
}
;

$post->closeCursor();
?>
</div>
<div id="comment_section">
<div><strong> Commentaires :</strong> </div>
    <?php

while ($comment = $comments->fetch()) {

    ?>

    <div> De <strong><?=$comment['nom_user']?></strong> à <?=$comment['date_commentary']?> : <?=$comment['content_commentary']?></div><br>
    <a href="index.php?action=signal&id_comment=<?=$comment['id_commentary']?>&id_post=<?=$comment['id_post']?>&title_post=<?=$comment['title_post']?>">Signaler</a>

    <?php
}

$comments->closeCursor();
?>
</div>
<?php

?>




<?php $content = ob_get_clean()?>

<?php require './views/template.php';?>