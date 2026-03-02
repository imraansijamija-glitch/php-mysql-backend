<?php
require_once "config.php";

$editUser = null;

if (isset($_GET["edit"])) {
  $editId = (int)$_GET["edit"];
  $stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
  $stmt->execute([$editId]);
  $editUser = $stmt->fetch();
}

$users = $pdo->query("SELECT * FROM users ORDER BY id DESC")->fetchAll();
?>

<!doctype html>
<html lang="bs">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP MySQL CRUD</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<div class="container py-4">

  <h3 class="mb-4 text-center">User Management System</h3>

  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title text-center">
        <?= $editUser ? "Uredi korisnika" : "Dodaj korisnika" ?>
      </h5>

      <form method="post" action="<?= $editUser ? "update.php" : "create.php" ?>" class="row g-3">

        <?php if ($editUser): ?>
          <input type="hidden" name="id" value="<?= (int)$editUser["id"] ?>">
        <?php endif; ?>

        <div class="col-md-4">
          <input class="form-control" name="ime" placeholder="Ime"
            value="<?= htmlspecialchars($editUser["ime"] ?? "") ?>" required>
        </div>

        <div class="col-md-4">
          <input class="form-control" name="prezime" placeholder="Prezime"
            value="<?= htmlspecialchars($editUser["prezime"] ?? "") ?>" required>
        </div>

        <div class="col-md-4">
          <input class="form-control" type="email" name="email" placeholder="Email"
            value="<?= htmlspecialchars($editUser["email"] ?? "") ?>" required>
        </div>

        <div class="col-12">
          <button class="btn btn-primary w-100" type="submit">
            <?= $editUser ? "Sačuvaj izmjene" : "Dodaj korisnika" ?>
          </button>
        </div>

        <?php if ($editUser): ?>
          <div class="col-12">
            <a href="index.php" class="btn btn-secondary w-100">Otkaži</a>
          </div>
        <?php endif; ?>

      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-body">

      <h5 class="card-title text-center mb-3">Lista korisnika</h5>

      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Ime</th>
              <th>Prezime</th>
              <th>Email</th>
              <th>Datum</th>
              <th>Akcije</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($users as $u): ?>
              <tr>
                <td><?= (int)$u["id"] ?></td>
                <td><?= htmlspecialchars($u["ime"]) ?></td>
                <td><?= htmlspecialchars($u["prezime"]) ?></td>
                <td><?= htmlspecialchars($u["email"]) ?></td>
                <td><?= htmlspecialchars($u["created_at"]) ?></td>
                <td class="d-flex justify-content-center gap-2">

                  <a href="index.php?edit=<?= (int)$u["id"] ?>" class="btn btn-warning btn-sm">
                    Edit
                  </a>

                  <form method="post" action="delete.php"
                        onsubmit="return confirm('Obrisati korisnika?')">
                    <input type="hidden" name="id" value="<?= (int)$u["id"] ?>">
                    <button class="btn btn-danger btn-sm">
                      Delete
                    </button>
                  </form>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
      </div>

    </div>
  </div>

</div>

<script src="assets/script.js"></script>

</body>
</html>