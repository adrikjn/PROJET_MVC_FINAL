<?php include(VIEWS . '_partials/header.php'); ?>

<h1 class="text-center text-primary my-4">Votre commande</h1>

<div class="container">
    <div class="row">
        <div class="col-4">
        <p><?= $_SESSION['user']['f_name']; ?><?= $_SESSION['user']['l_name']; ?></p>
            <p><?= $_SESSION['user']['phone']; ?></p>
            <?= $_SESSION['user']['delivery_address']; ?>
        </div>
        <div class="col-4">
            <p><?= $_SESSION['user']['f_name']; ?><?= $_SESSION['user']['l_name']; ?></p>
            <p><?= $_SESSION['user']['phone']; ?></p>
            <p><?= $_SESSION['user']['billing_address']; ?></p>
        </div>
        <div class="col-2 text-end">
            <a href="<?= BASE . 'commande/formulaire'; ?>" class="btn btn-info text-end">Modifier</a>
        </div>
    </div>
    <div class="col-12 my-3"><hr></div>
</div>
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-2"></div>
    </div>
</div>
<div class="col-2 text-end">
            <a href="<?= BASE . 'commande/pay'; ?>" class="btn btn-info text-end">Payer</a>
        </div>


<?php include(VIEWS . '_partials/footer.php'); ?>