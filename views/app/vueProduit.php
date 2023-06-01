
<?php include(VIEWS . '_partials/header.php'); ?>

<div class="container">
    <h1 class="text-center text-white bg-primary mt-3 py-3 rounded"><?= $produit['name']; ?></h1>
    <div class="card text-white bg-primary mb-3">
    <div class="card-header text-center" style="height:80vh;"><img src="<?= UPLOAD . $produit['image']; ?>" alt="" class="rounded-top" style="object-fit:cover;width:100%;height:100%;"></div>
    <div class="card-body">
        <h4 class="card-title">Categorie : <?= $produit["id_category"]; ?></h4>
        <h4 class="card-title">Description : </h4>
        <p class="card-text"><?= $produit['description']; ?></p>
        <h5 class="text-end">Prix : <?= $produit['price']; ?>€</h5>
    </div>
    </div>
    <div class="container2 bg-light mb-3 border-0 rounded m-5">
    <form action="<?= BASE . 'comment/add?id=' . $produit['id_product']; ?>" method="post">
    <div class="form-group">
      <label for="exampleTextarea" class="form-label mt-4"><h3>Un commentaire sur le produit ?</h3> </label>
      <textarea class="form-control" id="exampleTextarea" name="comment" rows="3"></textarea>
    </div>
      <div class="form-group">
     <h4 class="titre" style="text-align : center">Donnez une note de 1 à 5 sur le produit</h4>
     <select class="form-control" name="rating" id="rating">
        <?php for($i=1; $i<6; $i++): ?>
            <option value="<?=$i?>"><?=$i?></option>
        <?php endfor; ?>
     </select>
    </div>

  <button type="submit" class="btn btn-light col-4">Submit</button>
    </form>
    </div>
    
    <?php foreach ($comments as $comment): ?>
        <div class="card-body p-5">
        <h4 class="card-title"><?= $comment['pseudo']; ?></h4>
        <p class="card-text"><?=$comment['comment']; ?></p>
        <p><?= $comment['rating']; ?></p>
        <p><?= $comment['created_at']; ?></p>
        <hr>
        </div>
    <?php endforeach; ?>

     </div>
</div> 
</div>
<?php include(VIEWS . '_partials/footer.php'); ?>