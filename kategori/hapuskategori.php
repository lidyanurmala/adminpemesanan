<?php 

require '../function.php';

$id_kategori = $_GET["id_kategori"];

if ( hapuskategori($id_kategori) > 0 ) {
    echo"<script>
          alert('Data berhasil dihapus!');
          </script>";
          header("Location: ../menu.php");
}else {
    echo"<script>
          alert('Data Gagal dihapus!');
          </script>";
          header("Location: ../menu.php");
}
?>