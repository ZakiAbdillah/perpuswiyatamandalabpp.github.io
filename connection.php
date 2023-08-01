<?php 

$host_name = 'localhost';
$user_name = 'root';
$password = '';
$db_name = 'perpustakaanku';

$conn = mysqli_connect($host_name, $user_name, $password, $db_name);

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result) ) {
		$rows[]=$row;
	}

	return $rows;
}

function cariBuku($keyword){
	$query = "SELECT * FROM buku WHERE
	judul_buku LIKE '%$keyword%' OR
	kategori LIKE '%$keyword%' OR
	penulis LIKE '%$keyword%' OR
	penerbit LIKE '%$keyword%' OR
	tahun_terbit LIKE '%$keyword%'
	";
	return query($query);
}

function upload(){

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	$ekstensiGambarValid = ['jpg','jpeg','png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if ($ukuranFile > 10000000000) {
		echo "<script>
		alert('Kapasitas Poster terlalu besar!');
		</script>" ;
		return false;
	}

	$karakter = '_abcdefghijkl_ABCDEFGHIJKLMN_mnopqrstuvwxyz_OPQRSTUVWXYZ_0123456789_';
	$shuffle_one  = substr(str_shuffle($karakter), 0, 50);
	$shuffle_two  = substr(str_shuffle(sha1($namaFile)), 0, 45);
	$kode=$shuffle_one.'_'.$shuffle_two;

	$namaFileBaru = $kode;
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'image/'. $namaFileBaru);

	return $namaFileBaru;

}
?>