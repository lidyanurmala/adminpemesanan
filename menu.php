<?php
session_start();
require 'function.php';
$menu = perintah("SELECT * FROM menu");

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <!-- Data Tables -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <title>Admin-Pangestu Caffe</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #DEB887;">
  <a class="navbar-brand" href="#">Pangestu Caffe</a>
  <div class="dropdown my-2 my-lg-0 ml-auto">
  <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Admin
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>
  </div>
</div>
</nav>
<div class="row no-gutters mt-5">
    <div class="col-md-2 mt-2 pr-3 pt-4 bg-dark ">
    <ul class="nav flex-column ml-3 mb-5 ">
  <li class="nav-item">
    <a class="nav-link active text-white" href="index.php"><i class="fa-solid fa-gauge-high mr-2"></i>Dashboard</a><hr>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="menu.php"><i class="fa-solid fa-cubes mr-2"></i>Menu Kategori</a><hr>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="pesanan.php"><i class="fa-solid fa-cart-shopping mr-2"></i>Pesananan</a><hr>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="laporan.php"><i class="fa-solid fa-file mr-2"></i>Laporan</a><hr>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="help.php"><i class="fa-sharp fa-solid fa-circle-info mr-2"></i>Pusat Bantuan</a><hr>
  </li>
</ul>
    </div>
    <div class="col-md-10 p-5 pt-2  ">
    <div class="row">
     <h5 style="color: black;"><i class="fa-solid fa-cubes mr-2"></i>Menu</h5>
      <div class="table-responsive mt-4 mb-4 ml-2">
          <a href="menu/tambahmenu.php" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus me-2"></i>Tambah</a>
      <table id="buku1" class="table col-12 table-bordered display border mt-6 table-hover table-sm ">
          <thead class="text-white">
              <tr class="bg-secondary text-center"> 
                <th>No</th>   
                <th>Kode Menu</th>       
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Status</th> 
                <th>Kategori</th> 
                <th>Aksi</th>   
              </tr>
          </thead>
          <tbody class="table-light text-center" id="tbody">
          <!-- Looping Table -->
          <?php $i = 1 ?>
          <?php foreach ( $menu as $row ) : ?>
          <tr>
          
            <td><?php echo $i ?></td>
            <td><?php echo $row["id_menu"] ?></td>
            <td><?php echo $row["nama_menu"] ?></td>
            <td><?php echo $row["harga"] ?></td>
            <td><?php echo $row["deskripsi"] ?></td>
            <td><?php echo $row["gambar"] ?></td>
            <td><?php echo $row["status"] ?></td>
            <td><?php echo $row["kategori"] ?></td>
            <td>
                <a class="btn btn-sm btn-danger" href="menu/hapusmenu.php?id_menu=<?=$row["id_menu"];?>"><i class="fa fa-trash"></i></a>
                <a class="btn btn-sm btn-warning" href="menu/editmenu.php?id_menu=<?=$row["id_menu"];?>"><i class="fa fa-pencil"></i></a>
            </td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
        <hr>
          </tbody>
          <script>
          $(document).ready(function(){
          $('#buku1').DataTable();});
          </script>
      </table>   
          </div>
      </div>
    <hr>
   
    
    <div class="fixed-bottom card-footer text-center" style="width: 100rem">
    <span>Copyright &copy; 2022 LNE||Pangestu Catering</span>
</div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
          -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/js1.js"></script>
</body>
</html>