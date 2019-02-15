
<?php $title = "Mon Blog";?>

<?php ob_start();?>
<div id="form_post">
    <form action="index.php?action=addArticle" method="post">

        <label for="blog_user" id="user_part2">Nom d'utilisateur</label>
        <input type="text" id="user_part" name="blog_user">

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
;

$req->closeCursor();
?>


    <?php $content = ob_get_clean();?>

    <?php require './views/template.php';?>