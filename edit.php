<?php 
require 'template/header.php';
require 'template/footer.php';
require 'template/sidebar.php';
require 'function.php';

$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$barang = query("SELECT * FROM produk WHERE id = $id")[0];


// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
  
  // cek apakah data berhasil diubah atau tidak
  if( edit($_POST) > 0 ) {
    echo "
      <script>
        alert('data berhasil diubah!');
        document.location.href = 'index.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('data gagal diubah!');
        document.location.href = 'index.php';
      </script>
    ";
  }
}
?>

<h1 align="center">Edit data</h1>
<div class="container">
  <form action="" method="post" enctype="multipart/form-data" >
  <input type="hidden" name="id" value="<?= $barang["id"]; ?>">
  <input type="hidden" name="gambarlama" value="<?= $barang["gambar"]; ?>">
        <div class="form-group">
          <div class="modal-body">
             <div class="form-group">
                  <label class="control-label" >Nama produk </label>
                    <input type="text" name="nama_produk" class="form-control" value="<?= $barang["nama_produk"]; ?>" required="">
        </div> 
        <div class="form-group">
                  <label class="control-label" >Keterangan </label>
                    <input type="text" name="keterangan" class="form-control" value="<?= $barang["keterangan"]; ?>" required="">
        </div>                      
        
        <div class="form-group">
                  <label class="control-label" >Harga </label>
                    <input type="number" name="harga" class="form-control" value="<?= $barang["harga"]; ?>" required="">
        </div>
        <div class="form-group">
                  <label class="control-label" >Jumlah </label>
                    <input type="number" name="jumlah" class="form-control" value="<?= $barang["jumlah"]; ?>" required="">
        </div>
        <div class="form-group">
                  <label> gambar </label><br>
                  <div class="card ml-3 mb-3" style="width:350px" >
                   <img src="img/<?= $barang["gambar"]; ?>" class="card-img-top" width="300" height="150"  alt="...">
                    <div class="card-body">
                  <input type="file" name="gambar" class="form-control" > 
        </div>
        </div>
        </div>
        </div>
                </div>
      <br><br><br><br><br><br><br><br><br><br>
      <div class="modal-footer ml-auto">
        <a href="index.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
        <button type="submit" name="submit" class="btn btn-dark">Ubah</button>
      
      </form>
      </div>
