<?php 

require '../function.php';

$id_menu = $_GET["id_menu"];

if ( hapusmenu($id_menu) > 0 ) {
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