
<?php $title = "BeaBooks";?>

<?php ob_start()?>

<a href="index.php?action=disconnect">Déconnexion</a>
<div id="bloc_post">
    <div id="title_bloc_post">
    </div>
</div>


<div id="blogs">

    <?php
while ($donnees = $req->fetch()) {

    ?>


    <div id="titre_article"> <strong> <?=$donnees['title_post']?> </strong></div> <br>
    <div id="contenu_article"> <?=$donnees['content_post']?></div> <br>
    <a
        href="index.php?action=post&id_post=<?=$donnees['id_post']?>&title_post=<?=$donnees['title_post']?>">Commentaires</a>
    <div id="info_article">Posté par <strong><?=$donnees['nom_user']?></strong> le : <?=$donnees['date_post']?></div>
    <br>



  <?php
}

$req->closeCursor();?>



<?php $content = ob_get_clean();?>

<?php require './views/template.php'?>
