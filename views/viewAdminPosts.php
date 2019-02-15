<?php $title = "Mon Blog";?>

<?php ob_start();?>

<a href="index.php?action=disconnect">Déconnexion</a>
<div id="form_post">

    <p>Bonjour <?= $_SESSION['redacteur']['nom_user']?></p>
    <form action="index.php?action=addArticle&id_user=<?= $_SESSION['redacteur']['id_user']?>" method="post">
        <label for="blog_title">Titre de votre article</label>
        <input type="text" id="title_blog" name="blog_title">

        <label for="blog_post">Contenu de votre article</label>
        <textarea name="blog_post" id="content_blog_post" cols="30" rows="10"></textarea>

        <input type="submit" value="Envoyer">

    </form>
</div>

<div id="bloc_post">
    <div id="title_bloc_post">
    </div>
</div>


<div id="blogs">

    <?php
while ($post = $req->fetch()) {

    ?>


    <div id="titre_article"> <strong> <?=$post['title_post']?> </strong></div> <br>
    <div id="contenu_article"> <?=$post['content_post']?></div> <br>
    <a
        href="index.php?action=getCommentAdmin&id_post=<?=$post['id_post']?>&title_post=<?=$post['title_post']?>">Commentaires</a>
    <div id="info_article">Posté par <strong><?=$post['nom_user']?></strong> le : <?=$post['date_post']?></div>
    <a href="index.php?action=deletePost&id_post=<?=$post['id_post']?>">Supprimer le post</a>
    <a href="index.php?action=modifyPost&id_post=<?=$post['id_post']?>">Modifier le post</a>
    <br>



    <?php
}


$req->closeCursor();
?>

    <?php $content=ob_get_clean() ?>
    <?php require './views/template.php' ?>