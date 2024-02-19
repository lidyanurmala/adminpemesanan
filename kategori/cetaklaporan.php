<?php
session_start();
require '../function.php';
$pesanan = perintah("SELECT * FROM pesanan");
?>

<html>
<head>
	<title>Cetak PDF</title>
	<style>
		table {
			border-collapse:collapse;
			table-layout:fixed;width: 500px;
    
		}
		table td {
			word-wrap:break-word;
			width: 20%;
            text-align:center
		}
	</style>
</head>
<body>
	<h2 style="margin-left: 17%;">Laporan Penjualan Pangestu Catering & Caffe</h2>
	<?php
	if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter
		$filter = $_GET['filter']; // Ambil data filder yang dipilih user

		if($filter == '1'){ // Jika filter nya 1 (per tanggal)
			$tgl = date('d-m-y', strtotime($_GET['tanggal']));

			echo '<b style="padding: 5%; ">Data Transaksi Tanggal '.$tgl.'</b><br /><br />';

			$query = "SELECT * FROM pesanan WHERE DATE(tgl_transaksi)='".$_GET['tanggal']."'"; // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
		}else if($filter == '2'){ // Jika filter nya 2 (per bulan)
			$nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			echo '<b style="padding: 20%;">Data Transaksi Bulan '.$nama_bulan[$_GET['bulan']]. ' '. $_GET['tahun'] .'</b><br /><br />';

			$query = "SELECT * FROM pesanan WHERE MONTH(tgl_transaksi) = ".$_GET['bulan']." AND YEAR(tgl_transaksi) = ".$_GET['tahun']; // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
		}else{ // Jika filter nya 3 (per tahun)
			echo '<b style="padding: 20%;">Data Transaksi Tahun '.$_GET['tahun'].'</b>';

			$query = "SELECT * FROM pesanan WHERE YEAR(tgl_transaksi)='".$_GET['tahun']."'"; // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
		}
	}else{ // Jika user tidak memilih filter
		echo '<b style="padding: 20%;">Semua Data Transaksi</b>';

		$query = "SELECT * FROM pesanan ORDER BY tgl_transaksi"; // Tampilkan semua data transaksi diurutkan berdasarkan tanggal
	}
	?>
	<table border= 1; style="margin-left: 15%">
          <thead class="text-white">
              <tr class="text-center">   
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
		window.print();
	</script>
</body>
</html>
<?php

