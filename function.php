<?php 
$conec=mysqli_connect("localhost","root","","arkademy");
// koneksi kedatabse

function query($query) {
	global $conec;
	$result = mysqli_query($conec,$query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
 }

function uploadbaru() {

  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  // cek apakah tidak ada gambar yang diupload
  if( $error === 4 ) {
    echo "<script>
        alert('pilih gambar terlebih dahulu!');
        </script>";
    return false;
  }

  // cek apakah yang diupload adalah gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
    echo "<script>
        alert('yang anda upload bukan gambar!');
        </script>";
    return false;
  }

  // cek jika ukurannya terlalu besar
  if( $ukuranFile > 1000000 ) {
    echo "<script>
        alert('ukuran gambar terlalu besar!');
        </script>";
    return false;
  }

  // lolos pengecekan, gambar siap diupload
  // generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;

  move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

  return $namaFileBaru;
}


function edit($data) {
  global $conec;

  $id = $data["id"];
  $nama_produk = htmlspecialchars($data["nama_produk"]);
  $keterangan = htmlspecialchars($data["keterangan"]);
  $harga = htmlspecialchars($data["harga"]);
  $jumlah = htmlspecialchars($data["jumlah"]);
  $gambarlama = htmlspecialchars($data["gambarlama"]);

 // cek apakah user pilih gambar baru atau tidak
	if( $_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambarlama;
	} else {
		$gambar = uploadbaru();
	}

  $query = "UPDATE produk SET
        nama_produk = '$nama_produk',
        keterangan = '$keterangan',
        harga = '$harga',
        jumlah = '$jumlah',
        gambar = '$gambar'
        WHERE id = $id
      ";
  // var_dump($query); die;
  mysqli_query($conec, $query);

  return mysqli_affected_rows($conec); 
}

function hapus($id) {
  global $conec;
  mysqli_query($conec, "DELETE FROM produk WHERE id = $id");
  return mysqli_affected_rows($conec);
}

// fungsi cari
function cari($keyword) {
  $query = "SELECT * FROM produk
        WHERE
        nama_produk LIKE '%$keyword%' OR
        keterangan LIKE '%$keyword%'
      ";
  return query($query);
}
