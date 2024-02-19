<?php 
$server = "localhost"; 
$user = "id20126121_admin"; 
$password = "O5r9ssZ80UJ>]L|3"; 
$nama_database = "id20126121_admin_ta"; 
$conn = mysqli_connect($server, $user, $password, $nama_database);

if(!$conn){ 
	die("Koneksi dengan database gagal : ".mysql_connect_error().
		"-".mysql_connect_error());
}
function perintah($menu){
    global $conn;
    $result = mysqli_query($conn, $menu);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function upload(){
    $namaFile   = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error      = $_FILES['gambar']['error'];
    $tmpName    = $_FILES['gambar']['tmp_name'];
    //cek apakah ada gambar atau tidak
    if ($error === 4) {
        echo "<script> alert('Tidak Ada Gambar'); </script>";
        return false;
    }
    //Cek apakah yang di upload gambar atau bukan
    $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script> alert('yang di upload bukan gambar'); </script>";
        return false;
    }
    //jika ukuran terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script> alert('Ukuran Gambar Terlalu Besar'); </script>";
        return false;
    }
    //Lolos semua pengecekan
    $namaFileBaru  = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../uploads/'. $namaFileBaru);
    return $namaFileBaru;
}
function tambahmenu($menu1){
    global $conn;
    $id_menu = htmlspecialchars($menu1['id_menu']);
    $nama_menu = htmlspecialchars($menu1['nama_menu']);
    $harga = htmlspecialchars($menu1['harga']);
    $deskripsi = htmlspecialchars($menu1['deskripsi']);
    $gambar = htmlspecialchars($menu1['gambar']);
    $status = htmlspecialchars($menu1['status']);
    $kategori = htmlspecialchars($menu1['kategori']);
            
        $gambar = upload();
        if (!$gambar) {
            return false;
        }
    mysqli_query($conn,
        "INSERT INTO menu VALUES 
        ('$id_menu', '$nama_menu', '$harga', '$deskripsi', '$gambar', '$status', '$kategori')");
    
        return mysqli_affected_rows($conn);
    }
function hapusmenu($id_menu){
        global $conn;
        mysqli_query($conn, "DELETE from menu WHERE id_menu = $id_menu");
    
        return mysqli_affected_rows($conn);
    }
function editmenu($editmenu){
    global $conn;
    $id_menu = htmlspecialchars($editmenu['id_menu']);
    $nama_menu = htmlspecialchars($editmenu['nama_menu']);
    $harga = htmlspecialchars($editmenu['harga']);
    $deskripsi = htmlspecialchars($editmenu['deskripsi']);
    $gambar = htmlspecialchars($editmenu['gambar']);
    $status = htmlspecialchars($editmenu['status']);
    $kategori = htmlspecialchars($editmenu['kategori']);
        
    $gambar = upload();
        if (!$gambar) {
            return false;
        }
    mysqli_query($conn,
    "UPDATE menu 
        SET 
            id_menu = '$id_menu',
            nama_menu = '$nama_menu',
            harga = '$harga',
            deskripsi = '$deskripsi',
            gambar = '$gambar',
            status = '$status',
            kategori = '$kategori'
            WHERE id_menu = $id_menu
    ");
    return mysqli_affected_rows($conn);
    }
    function tampil($menu1){
        global $conn;
        $result = mysqli_query($conn, $menu1);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    function tambahpesanan($pesanan){
        global $conn;
        $kd_pesanan = htmlspecialchars($pesanan['kd_pesanan']);
        $total_bayar = htmlspecialchars($pesanan['total_bayar']);

        mysqli_query($conn,
            "INSERT INTO pesanan VALUES 
            ($kd_pesanan', now(), '$total_bayar')");
        
            return mysqli_affected_rows($conn);
    }
    function editkategori($kategori){
        global $conn;
        $id_kategori = $kategori['id_kategori'];
        $kd_kategori = htmlspecialchars($kategori['kd_kategori']);
        $nama_kategori = htmlspecialchars($kategori['nama_kategori']);
        $status = htmlspecialchars($kategori['status']);

        mysqli_query($conn,
        "UPDATE kategori 
        SET 
            kd_kategori = '$kd_kategori',
            nama_kategori = '$nama_kategori',
            status = '$status'
            WHERE id_kategori = $id_kategori
    ");
    return mysqli_affected_rows($conn);
    }
    function hapuskategori($id_kategori){
        global $conn;
        mysqli_query($conn, "DELETE from kategori WHERE id_kategori = $id_kategori");
    
        return mysqli_affected_rows($conn);
    }
?>