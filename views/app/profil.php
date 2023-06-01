<?php include(VIEWS . '_partials/header.php'); ?>

<?php
// echo '<pre>';
// var_dump($orders) ;
// echo "</pre>";

// echo '<pre>';
// var_dump($buys) ;
// echo "</pre>";
?>
<div class="container">
    <h1 class="text-center text-white bg-primary mt-3 py-3 rounded">Profil</h1>

    <h1 class="text-center">Votre profil</h1>



    <div class="container my-3">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Pseudo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $user['l_name']; ?></td>
                    <td><?= $user['f_name']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['pseudo']; ?></td>
                </tr>
            </tbody>
        </table>

        <div>
            <form method="post" style="margin-bottom: 10px;">
                <input type=" text" placeholder="Nouveau pseudo" name="pseudo" id="newPassword">
                <input type="submit" value="Changer le pseudo">
            </form>

            <form method="post" style="margin-bottom: 10px;">
                <div class="form-group">
                    <label for="password">Ancien mot de passe</label>
                    <input type="password" name="password" id="password">
                    <small class="text-danger"><?= $error['password'] ?? ""; ?></small>
                </div>

                <label for="password">Nouveau mot de passe</label>
                <input type="text" name="newPassword" id="newPassword">
                <input type="submit" value="Changer le mot de passe">
            </form>

            <button class="bg-danger py-2 rounded" id="deleteButton">
                Delete account
            </button>
        </div>
    </div>

</div>
<?php if($orders): ?>
<div class="container">
    <h2 class="text-center">Mes commandes</h2>
    <?php foreach($orders as $order): ?>
        <div class="container  mt-4 border border-primary">
        <div class="row">
            <h3 class="text-center col-4"><?=$order["purchase_date"] ?></h3>
            <h3 class="text-center col-4">Total : <?=$order["total"] ?>€</h3>
            <h3 class="text-center col-4"><?=$order["status"] ?></h3>
        </div>
        <?php foreach($buys as $buy): ?> 
            <?php if($buy['id_purchase'] == $order['id_purchase']):?> 
                <div class="row">
            <h5 class="text-center col-4"><img src="<?=UPLOAD . $buy["image"] ?>" alt="" width='50'></h5>
            <h5 class="text-center col-4">quantité : <?=$buy["quantity"] ?></h5>
            <h5 class="text-center col-4"><?= $buy["quantity"] * $buy["price"] ?>€</h5>
        </div>
        <?php endif;endforeach; ?></div>
    <?php endforeach; ?>
</div>
<?php else: ?>
    <h2 class="text-center">aucune commande</h2>
<?php endif; ?>
<script>
    const deleteButton = document.getElementById('deleteButton');

    deleteButton.onclick = () => {
        fetch("<?= BASE . 'profil/delete' ?>");
        window.location.href = "<?= BASE . 'logout' ?>";
    }
</script>

<?php include(VIEWS . '_partials/footer.php'); ?>