<?php include(VIEWS . '_partials/header.php'); ?>


<h1 class="text-center">Gestion des categories</h1>

<div class="container my-3">
    <table class="table table-dark table-striped text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($categories as $category): ?>

            <tr>
                <td><?= $category['id_category']; ?></td>
                <td><?= $category['name']; ?></td>
                <td>
                    
                    <a href="<?= BASE . 'produit/modifiercategory?id=' . $category['id_category'] ; ?>" class="text-primary mx-3"><i class="bi bi-pencil-square"></i></a>
                    
                    <a href="<?= BASE . 'produit/deletecategory?id=' . $category['id_category'] ; ?>" class="text-danger"><i class="bi bi-trash3"></i></a>
                    
                    
                </td>
            </tr>

        <?php endforeach; ?> 
        </tbody>
    </table>
</div>



















<?php include(VIEWS . '_partials/footer.php'); ?>