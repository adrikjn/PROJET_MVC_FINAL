<?php include(VIEWS . '_partials/header.php'); ?>

<h1 class="text-center">Modifier Categorie</h1>


<form action="" method="post" class="w-50 mx-auto border borger-primary rounded mt-5 p-5">
<div class="container">


    <div class="form-group ">
            <label for="name" class="form-label mt-4">Catégorie</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $category['name']??""; ?>" placeholder="Inserer une catégorie">
            <small class="text-danger"><?= $error['name'] ?? ""; ?></small>
    </div>
        
</div>
<button type="submit" class="btn btn-primary mt-5 col-12">Modifier</button>

</form>


<?php include(VIEWS . '_partials/footer.php'); ?>