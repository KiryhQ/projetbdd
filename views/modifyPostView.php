<?php $title = "Mon Blog";?>

<?php ob_start();?>

<a href="index.php?action=disconnect">Déconnexion</a>
<div id="form_post">

<p>Bonjour <?= $_SESSION['admin']['nom_user']?></p>
    <form action="index.php?action=modifyingPostForm&id_post=<?= $_GET['id_post']?>" method="post">
        <label for="blog_title">Titre de votre article à modifier</label>
        <input type="text" id="title_blog" name="blog_title">

        <label for="blog_post">Contenu de votre article à modifier</label>
        <textarea name="blog_post" id="content_blog_post" cols="30" rows="10"></textarea>

        <input type="submit" value="Envoyer">

    </form>
</div>


<?php $content=ob_get_clean() ?>
<?php require './views/template.php' ?>