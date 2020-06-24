<?php include "template/header.php" ?>
<?php include "template/footer.php" ?>
<?php include "template/sidebar.php" ?>
<?php include "function.php" ?>
<?php include "tambah.php" ?>


<?php 
$brg = query("SELECT * FROM produk");

// cari
if( isset($_POST["cari"]) ) {
  $brg = cari($_POST["keyword"]);
}

 ?>


<!-- Button trigger modal -->
<div class="container">
<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
  <i>Tambah Data</i>
</button>
</div>

<!-- Modal -->
<br>
<div class="container-dua">
<?php foreach ($brg as $barang ) : ?>
<div class="card ml-3 mb-3" >
  <img src="img/<?= $barang["gambar"]; ?>" class="card-img-top"  alt="...">
  <div class="card-body">

    <h6 class="card-title">Produk : <?= $barang["nama_produk"]; ?></h6>
    <p class="card-text">Deskripsi : <?= $barang["keterangan"]; ?></p>
    <p class="card-text">Harga : <?= number_format($barang["harga"]); ?></p>
    <p class="card-text">Stok : <?= $barang["jumlah"]; ?></p>
    <a href="edit.php?id=<?= $barang["id"]; ?>" class="btn btn-warning" >Edit</a>
    <a href="hapus.php?id=<?= $barang["id"]; ?>" onclick="return confirm('yakin?');"  class="btn btn-danger">Hapus</a>
  </div>
</div>
<?php endforeach; ?>
</div>

<!-- <section style="min-height: 720px; background-color: white; margin-top: -115px;">
  
</section>
 -->