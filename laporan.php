<?php
session_start();
require 'function.php';
$pesanan = perintah("SELECT * FROM pesanan");
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
    <link rel="stylesheet" href="plugin/jquery-ui/jquery-ui.min.css" /> <!-- Load file css jquery-ui -->
    <script src="js/jquery.min.js"></script> <!-- Load file jquery -->
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <style type="text/css">
        .d-none {
            display: none;
        }
        </style>
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
    <div class="col-md-2 mt-2 pr-3 pt-4 bg-dark " >
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
        <h5 class="mt-4"><i class="fa-solid fa-file mr-2"></i>Laporan</h5><hr>
        <form method="get" action="">
        <label>Cetak Laporan</label><br>
        <select name="filter" id="filter" onchange="enableBrand(this)">
            <option value="0">Pilih Berdasarkan</option>
            <option value="1">Pilih Berdasarkan Tanggal</option>
            <option value="2">Pilih Berdasarkan Bulan</option>
            <option value="3">Pilih Berdasarkan Per Tahun</option>
        </select>
        <br /><br />

        <div id="form-tanggal" class="d-none">
            <label>Tanggal</label><br>
            <input type="date" name="tanggal" class="input-tanggal" />
            <br /><br />
        </div>

        <div id="form-bulan" class="d-none">
            <label>Bulan</label><br>
            <select name="bulan">
                <option value="">Pilih</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <br /><br />
        </div>
        <div id="form-tahun" class="d-none">
            <label>Tahun</label><br>
            <select name="tahun">
                <option value="">Pilih</option>
                <?php
                $query = "SELECT YEAR(tgl_transaksi) AS tahun FROM pesanan GROUP BY YEAR(tgl_transaksi)"; // Tampilkan tahun sesuai di tabel transaksi
                $sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query

                while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                    echo '<option value="'.$data['tahun'].'">'.$data['tahun'].'</option>';
                }
                ?>
            </select>
            <br /><br />
        </div>

        <button type="submit" class="bg-warning">Tampilkan</button>
        <a href="laporan.php" ><i class="fa fa-refresh ml-2" aria-hidden="true"></i></a>
    </form>

        <div class="table-responsive mt-4 mb-4 ml-2">
        <?php
    if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
        $filter = $_GET['filter']; // Ambil data filder yang dipilih user

        if($filter == '1'){ // Jika filter nya 1 (per tanggal)
            $tgl_transaksi = date('d-m-y', strtotime($_GET['tanggal']));

            echo '<b>Data Transaksi Tanggal '.$tgl_transaksi.'</b><br /><br />';
            echo '<a href="kategori/cetaklaporan.php?filter=1&tanggal='.$_GET['tanggal'].'">Cetak PDF</a><br /><br />';

            $query = "SELECT * FROM pesanan WHERE DATE(tgl_transaksi)='".$_GET['tanggal']."'"; // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
        }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
            $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

            echo '<b>Data Transaksi Bulan '.$nama_bulan[$_GET['bulan']].' '.$_GET['tahun'].'</b><br /><br />';
            echo '<a href="kategori/cetaklaporan.php?filter=2&bulan='.$_GET['bulan'].'&tahun='.$_GET['tahun'].'">Cetak PDF</a><br /><br />';

            $query = "SELECT * FROM pesanan WHERE MONTH(tgl_transaksi) = ".$_GET['bulan']." AND YEAR(tgl_transaksi) = ".$_GET['tahun'];// Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
        }else{ // Jika filter nya 3 (per tahun)
            echo '<b>Data Transaksi Tahun '.$_GET['tahun'].'</b><br /><br />';
            echo '<a href="kategori/cetaklaporan.php?filter=3&tahun='.$_GET['tahun'].'">Cetak PDF</a><br /><br />';

            $query = "SELECT * FROM pesanan WHERE YEAR(tgl_transaksi)='".$_GET['tahun']."'"; // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
        }
    }
    else{ // Jika user tidak mengklik tombol tampilkan
        echo '<b>Semua Data Transaksi</b><br /><br />';
        echo '<a href="kategori/cetaklaporan.php"><i class="fa fa-print mr-2"></i>Cetak PDF</a><br /><br />';

        $query = "SELECT * FROM pesanan ORDER BY tgl_transaksi DESC LIMIT 0, 5"; // Tampilkan semua data transaksi diurutkan berdasarkan tanggal
    }
    ?>
      <table id="buku" class="table col-12 table-bordered display border mt-6 table-hover table-sm ">
          <thead class="text-white">
              <tr class="bg-secondary text-center"> 
                <th>Kode Pesanan</th>       
                <th>Total Bayar</th>
                <th>Tanggal Transaksi</th> 
              </tr>
          </thead>
          <tbody class="table-light text-center" id="tbody">
          <!-- Looping Table -->
          <?php
    $sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
    $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

    if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
            $tgl_transaksi = date('d-m-Y', strtotime($data['tgl_transaksi'])); // Ubah format tanggal jadi dd-mm-yyyy
            echo "<tr>";
            echo "<td>".$data['kd_pesanan']."</td>";
            echo "<td>".$data['total_bayar']."</td>";
            echo "<td>".$tgl_transaksi."</td>";
            echo "</tr>";
        }
    }else{ // Jika data tidak ada
        echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
    }
    ?>
        <hr>
          </tbody>
      </table>  
      <script>
    $(document).ready(function(){ // Ketika halaman selesai di load
        $('.input-tanggal').datepicker({
            dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
        });

        $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
                $('#form-tanggal').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){ // Jika filter nya 2 (per bulan)
                $('#form-tanggal').hide(); // Sembunyikan form tanggal
                $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
            }else{ // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-tahun').show(); // Tampilkan form tahun
            }

            $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })
    </script>
          </div>
      </div>
    <hr>
    <!-- Start Akun -->
    <div class="row">
    </div>
    </div>
    <div class="fixed-bottom card-footer text-center" style="width: 100rem">
    <span>Copyright &copy; 2022 LNE||Pangestu Catering</span>
</div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="plugin/jquery-ui/bootstrap-datepicker.js"></script> <!-- Load file plugin js jquery-ui -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/js1.js"></script>
        <script>
          $(document).ready(function(){
          $('#buku').DataTable();});
        </script>
    <script type="text/javascript">
        function enableBrand(answer) {
            if(answer.value == 1){
                document.getElementById('form-tanggal').classList.remove('d-none');
                document.getElementById('form-bulan').classList.add('d-none');
                document.getElementById('form-tahun').classList.add('d-none');
            } else if(answer.value == 2){
                document.getElementById('form-bulan').classList.remove('d-none');
                document.getElementById('form-tahun').classList.remove('d-none');
                document.getElementById('form-tanggal').classList.add('d-none');
            } else{
                document.getElementById('form-tahun').classList.remove('d-none');
                document.getElementById('form-bulan').classList.add('d-none');
                document.getElementById('form-tanggal').classList.add('d-none');
            }
        }
    </script>
</body>
</html>

