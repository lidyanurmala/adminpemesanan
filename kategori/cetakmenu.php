<?php
session_start();
require '../function.php';
$topmenu = perintah("SELECT menu.nama_menu, pesanan_item.menu_id, SUM(pesanan_item.qty) as jumlah
FROM pesanan_item INNER JOIN menu ON menu.id_menu = pesanan_item.menu_id GROUP BY menu_id ORDER BY jumlah DESC");
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
    <div class="col-md-10 p-5 pt-2">
        <h3 class="mt-2 text-center">Pangestu Catering & Caffe</h3><hr>
        <div class="container">
    <div class="row justify-content-center">
<div class="row container">
    <div class="col-md-6 mt-4">
    <table border="2" class="table" style="margin-left: 10%;">
          <tbody class="text-center" id="tbody">
          <h4><b>Menu Best Seller: </b></h4>
          <thead>
              <tr class="text-center"> 
                <th>No</th>   
                <th>Kode Menu</th>       
                <th>Nama Menu</th>
                <th>Jumlah Pesanan</th>    
              </tr>
          </thead>
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
</div>

</div>
</div>
</div>   
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/js1.js"></script>
    <script>
        window.print();
    </script>
</body>
</html>