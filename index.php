<?php
require_once '../config/config.php';
if (isset($_SESSION["login"]) && isset($_SESSION["driver"])) {
  header("Location: ../driver/index.php");
}
if (!isset($_SESSION["login"]) && !isset($_SESSION["user"])) {
  header("Location: ../index.php");
} else {
  $id = $_SESSION["user"];
  $result = query("SELECT * FROM users WHERE id_user = $id")[0];
  if ($result['roles'] !== 'USER') {
    header("Location: ../index.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Intan Paramisti</title>

  <link rel="icon" href="../assets/images/logo/2 (2).png">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link href="../assets/style/main.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/vendor/DataTables/datatables.min.css" />
</head>

<body>
  <?php
  if (isset($_GET["page"])) {
    $page = $_GET["page"];
  }
  ?>
  <div class="page-dashboard">
    <div class="d-flex" id="wrapper" data-aos="fade-right">
      <div class="border-right" id="sidebar-wrapper">
        <div class="sidebar-heading text-center">
          <img src="../assets/images/logo/2 (2).png" alt="" class="my-4 w-50" />
        </div>
        <div class="list-group list-group-flush">
          <a href="?page=dashboard" class="list-group-item list-group-item-action<?= $page == 'dashboard' ? ' active' : ''; ?> <?= $page == '' ? ' active' : ''; ?>">
            Dashboard
          </a>
          <a href="?page=finance" class="list-group-item list-group-item-action<?= $page == 'finance' ? ' active' : ''; ?> <?= $page == 'finance-details' ? ' active' : ''; ?> <?= $page == 'transfer' ? ' active' : ''; ?>">
            Finance
          </a>
          <a href="?page=nabung" class="list-group-item list-group-item-action<?= $page == 'nabung' ? ' active' : ''; ?> <?= $page == 'nabung-details' ? ' active' : ''; ?> <?= $page == 'nabung' ? ' active' : ''; ?>">
            Save Money
          </a>
          <a href="?page=profil" class="list-group-item list-group-item-action<?= $page == 'profil' ? ' active' : ''; ?> <?= $page == 'profil-details' ? ' active' : ''; ?> <?= $page == 'profil' ? ' active' : ''; ?>">
            Profil Kita
          </a>
          <br>
          <a href="?page=logout" class="list-group-item list-group-item-action<?= $page == 'logout' ? ' active' : ''; ?>  <?= $page == 'logout' ? ' active' : ''; ?>">
            Keluar
          </a>
        </div>
      </div>

      <div id="page-content-wrapper">
        <?php

        if (isset($page)) {
          if ($page == 'dashboard') {
            include 'dashboard-user.php';
          } elseif ($page == 'bayar') {
            include 'nabung/dashboard-user-bayar.php';
          } elseif ($page == 'no-rek') {
            include 'nabung/dashboard-user-no-rek.php';
          } elseif ($page == 'finance') {
            include 'finance/dashboard-user-finance.php';
          } elseif ($page == 'nabung-create') {
            include 'nabung/dashboard-user-nabung-create.php';
          } elseif ($page == 'nabung-details') {
            include 'nabung/dashboard-user-nabung-details.php';
          } elseif ($page == 'nabung-delete') {
            include 'nabung/dashboard-user-nabung-delete.php';
          } elseif ($page == 'profil') {
            include 'profil/dashboard-user-profil.php';
          } elseif ($page == 'nabung') {
            include 'nabung/dashboard-user-nabung.php';
          } elseif ($page == 'logout') {
            include '../logout.php';
          } else {
            echo "Halaman Tidak Ditemukan";
          }
        } else {
          include 'dashboard-user.php';
        }
        ?>
      </div>
    </div>
  </div>

  <div class="modal fade" id="terkirim" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin sudah terkirim ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <input type="hidden" name="id_transaction" value="<?= $transaction["id_transaction"]; ?>">
                <div class="form-group">
                  <label for="penerima">Nama Penerima</label>
                  <input type="text" name="penerima" id="penerima" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="terkirim" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </tr>

  <script src="../assets/vendor/jquery/jquery.slim.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
  <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace("editor");
  </script>
  <script type="text/javascript" src="../assets/vendor/DataTables/datatables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#table').DataTable();
    });
  </script>
</body>

</html>
