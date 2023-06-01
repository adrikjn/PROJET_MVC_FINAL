<?php include(VIEWS . '_partials/header.php'); ?>


<h1 class="text-center">Gestion des utilisateurs</h1>

<div class="container my-3">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Pseudo</th>
                <th>Role</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
<?php foreach($users as $user): ?>


    <div class="modal fade" role="dialogue" tabindex="-1"  aria-hidden= "true" id="modalSupprimer<?= $user['id_user']; ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Supprimer l'utilisateur</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <p>Etes-vous sur de vouloir supprimer cet utilisateur ???</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger" href="<?= BASE . 'user/supprimer?id=' . $user['id_user']; ?>">Supprimer</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ne pas supprimer</button>
      </div>
    </div>
  </div>
</div>





            <tr>
                <td><?= $user['id_user']; ?></td>
                <td><?= $user['l_name']; ?></td>
                <td><?= $user['f_name']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['pseudo']; ?></td>
                <td><?= $user['role']; ?></td>
                <td>
                    
                    <a href="<?= BASE . 'user/role?id=' . $user['id_user'] . "&role=" . $user['role']; ?>" class="btn-primary btn mx-3">modifier role</a>

                    <a data-bs-toggle="modal" data-bs-target="#modalSupprimer<?= $user['id_user']; ?>" href="" class="text-danger"><i class="bi bi-trash3"></i></a>

                </td>
            </tr>

<?php endforeach; ?> 
        </tbody>
    </table>
</div>



<?php include(VIEWS . '_partials/footer.php'); ?>