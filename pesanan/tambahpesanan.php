<?php
require '../function.php';
if ( isset($_POST["tambahpesanan"]) ) {
  if (tambahpesanan($_POST) > 0) {
    echo"<script>
        alert('Data Pesanan baru berhasil ditambahkan!');
        location.href = '../pesanan.php';
        </script>";
        
  } else {
    echo mysqli_error($conn);
  }
}
?>
<!DOCTYPE html>
<html>
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <title>Admin-Pangestu Catering</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #DEB887;">
  <a class="navbar-brand" href="#">Pangestu Caffe</a>
  <div class="dropdown my-2 my-lg-0 ml-auto">
  <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Admin
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>
  </div>
</div>
</nav>
<div class="row no-gutters mt-5">
    <div class="col-md-2 mt-2 pr-3 pt-4 bg-dark">
    <ul class="nav flex-column ml-3 mb-5">
  <li class="nav-item">
    <a class="nav-link text-white" href="../index.php"><i class="fa-solid fa-gauge-high mr-2"></i>Dashboard</a><hr>
  </li>
  <li class="nav-item">
    <a class="nav-link active text-white" href="../menu.php"><i class="fa-solid fa-cubes mr-2"></i>Menu Kategori</a><hr>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="../pesanan.php"><i class="fa-solid fa-cart-shopping mr-2"></i>Pesananan</a><hr>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="../laporan.php"><i class="fa-solid fa-file mr-2"></i>Laporan</a><hr>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="../help.php"><i class="fa-sharp fa-solid fa-circle-info mr-2"></i>Pusat Bantuan</a><hr>
  </li>
</ul>
    </div>
    <div class="col-md-10 p-5 pt-2">
    <div class="row">
      </div>
    <!-- Start Akun -->
    <div class="row">
    <form action="" method="post" enctype="multipart/form-data">
          <div class="card mt-1 mb-2 mt-4" id="card">
            <div class="text-center">
                <h2 class="mt-2 mb-2 display-6" style="font-size:190%; line-height: 2rem;">Tambah Pesanan </h2>
            </div>
            <div class="row mt-4 mb-4 justify-content-center ms-1 me-1">
            <div class="col-md-10">
            <div class="mb-3">
            <div class="mb-3">
              <label for="kd_pesanan">Kode Pesanan</label>
                <input type="text" class="form-control mt-2" name="kd_pesanan" id="kd_pesanan" required placeholder="Kode Pesanan">
            </div>
            <div class="mb-3">
              <label for="harga">Total Bayar</label>
                <input type="text" class="form-control mt-2" name="total_bayar" id="total_bayar" required placeholder="Total Bayar">
            </div>
            </div>
                <div class="row justify-content-center mt-3">
                <div class="col-4 mb-2">
                    <a class="btn" id="btn_signup" href="../pesanan.php">Kembali</a>
                </div>
                <div class="col-4 mb-2">
                    <button type="submit" name="tambahpesanan" class="btn btn-primary" id="pesanan">Simpan</button>  
                </div>                            
                </div>
        </form>
    </div>
    <div class="card-footer text-center fixed-bottom" style="width: 100rem; background-color: #DEB887;">
    <span>Copyright &copy; 2022 LNE||Pangestu Catering</span>
    </div>
</div>
    
  <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>