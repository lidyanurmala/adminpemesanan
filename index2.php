<?php
session_start();
require 'function.php';
$topmenu = perintah("SELECT menu.nama_menu, pesanan_item.menu_id, SUM(pesanan_item.qty) as jumlah
FROM pesanan_item INNER JOIN menu ON menu.id_menu = pesanan_item.menu_id GROUP BY menu_id ORDER BY jumlah DESC LIMIT 0, 5;");
$toppenjualan = perintah("SELECT kd_pesanan,tgl_transaksi, total_bayar FROM pesanan ORDER BY total_bayar DESC LIMIT 0, 5;");
$dataGrafikPenjualan = perintah("SELECT tgl_transaksi, COUNT(tgl_transaksi) AS jumlah FROM pesanan GROUP BY DATE(tgl_transaksi)ORDER BY tgl_transaksi DESC LIMIT 7;");
for($i = 0; $i < count($dataGrafikPenjualan); $i++){
  $dataHariPenjualan[] = date("l", strtotime($dataGrafikPenjualan[$i]['tgl_transaksi'])). ", ". date("d", strtotime($dataGrafikPenjualan[$i]['tgl_transaksi'])). "-". date("M", strtotime($dataGrafikPenjualan[$i]['tgl_transaksi'])). "-". date("Y", strtotime($dataGrafikPenjualan[$i]['tgl_transaksi']));
  $dataJumlahPenjualan[] = $dataGrafikPenjualan[$i]['jumlah'];
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <div class="col-md-2 mt-2 pr-5 pt-4  bg-dark ">
    <ul class="nav flex-column ml-3 mb-5">
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
    <div class="col-md-10 p-5 pt-2">
        <h5 class="mt-4"><i class="fa-solid fa-gauge-high mr-2"></i>Dashboard</h5><hr>
        <div class="container">
        <h3 class="mt-auto pt-4 display-6 mb-5" style="font-size: 20px"><strong>Profil Pangestu Catering & Caffe</strong></h3>
    <div class="row justify-content-center">
      <div class="col-md-6 mt-5">
<img src="images/logook.png" style="width: 50%;">
</div>
<div class="col-md-6 mt-auto">
<table class="table table-bordered table-hover">
<tr>
<td style="text-align: center;">Pangestu Catering & Caffe</td>
</tr>
<tr>
<td>PIRT :  </td>
</tr>
<tr>
<td>Alamat : Desa Kepoh Kecamatan Wedarijaksa Kab Pati</td>
</tr>
<tr>
<td> Pemilik : Wahyu Pangestuti</td>
</tr>
</table>
</div>

<div class="row container">
    <div class="col-md-6 mt-4">
    <table border="2" class="table col-12 table-bordered display border mt-6 table-hover table-sm ">
          <tbody class="text-center" id="tbody">
          <p><b>Grafik Penjualan: </b></p>
        <hr>
        <canvas class="w-100" id="penjualan" height="350"></canvas>
          </tbody>
      </table>     
    </div>
</div>
<div class="row container">
    <div class="col-md-6 mt-4">
    <table border="2" class="table col-12 table-bordered display border mt-6 table-hover table-sm ">
          <tbody class="text-center" id="tbody">
          <p><b>5 Menu Best Seller: </b></p>
          <a href="kategori/cetakmenu.php" class="btn btn-warning btn-sm mb-2"><i class="fa fa-print mr-2"></i>Cetak Menu Best Seller</a>
          <!-- Looping Table -->
          <?php $i = 1 ?>
          <?php foreach ( $topmenu as $row ) : ?>
          <tr>
          <td><?php echo $i ?></td>
            <td><?php echo $row["menu_id"] ?></td>
            <td><?php echo $row["nama_menu"] ?></td>
            <td><?php echo $row["jumlah"] ?></td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
        <hr>
          </tbody>
      </table>     
    </div>
    <div class="col-md-6 mt-4">
        <table border="2" class="table col-12 table-bordered display border mt-6 table-hover table-sm ">
          <tbody class="text-center" id="tbody">
              <p><b>5 Total Penjualan Terbaik Tahun 2023: </b></p>
              <a href="kategori/cetakpenjualan.php" class="btn btn-success btn-sm mb-2"><i class="fa fa-print mr-2"></i>Cetak Penjualan Best Seller</a>
              <!-- Looping Table -->
              <?php $i = 1 ?>
              <?php foreach ( $toppenjualan as $row ) : ?>
              <tr>
              <td><?php echo $i ?></td>
                <td><?php echo $row["kd_pesanan"] ?></td>
                <td><?php echo $row["tgl_transaksi"] ?></td>
                <td><?php echo $row["total_bayar"] ?></td>
            </tr>
            <?php $i++ ?>
            <?php endforeach; ?>
            <hr>
          </tbody>
      </table>     
    </div>
</div>


</div>
</div>
</div>   
    <div class="fixed-bottom card-footer text-center" style="width: 100rem">
    <span>Copyright &copy; 2022 LNE||Pangestu Catering</span>
</div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/js1.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    const ctx1 = document.getElementById('penjualan').getContext('2d');
    const ChartPengunjung = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($dataHariPenjualan) ?>,
            datasets: [{
                label: 'Penjualan',
                data: <?php echo json_encode($dataJumlahPenjualan) ?>,
                backgroundColor: 'rgba(222, 184, 135)'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                ticks: {
                    beginAtZero: true
                }
                }]
            },
            legend: {
                display: false
            }
        }
    });

</script>
</body>
</html>