<?php 
$conn = mysqli_connect("dbserver.crngxvhkbvzx.ap-southeast-3.rds.amazonaws.com", "admin", "Farharbatah0987","elib" );

$sorting = $_GET['order'] ?? 'desc';
$sorttype = $_GET['type'] ?? 'id';
$msgg = "S2FtdSBOZ2FwYWluPw==";
$fdo = 'FdoLib';  
$own = 'Farhan Dwi O';  

	
function query($sql) {
	global $conn;
	$result = mysqli_query($conn, $sql);

	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}
 // Menambah Data Request buku baru
function addRB($data) {
	global $conn;

	$name = htmlspecialchars($data["namerb"]);
	$email = htmlspecialchars($data["emailrb"]);
	$bookreq = htmlspecialchars($data["bookreq"]);

	$sql = "INSERT INTO reqbook
				VALUES
			(DEFAULT, '$name', '$email','$bookreq')";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}

//Menambah Request Takedown Buku
function addRTD($data) {
	global $conn;

	$name = htmlspecialchars($data["namertd"]);
	$email = htmlspecialchars($data["emailrtd"]);
	$bookrtd = htmlspecialchars($data["bookrtd"]);

	$sql = "INSERT INTO reqtd
				VALUES
			(DEFAULT, '$name', '$email','$bookrtd')";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}

function delreqmsg($id) {
	global $conn;
	mysqli_query($conn, "delete from reqbook where id = $id");

	return mysqli_affected_rows($conn);
}
function delreqtd($id) {
	global $conn;
	mysqli_query($conn, "delete from reqtd where id = $id");

	return mysqli_affected_rows($conn);
}
function delb($id) {
	global $conn;
	mysqli_query($conn, "delete from lib where id = $id");

	return mysqli_affected_rows($conn);
}


function addBook($data) {
	global $conn;
	
	$title = htmlspecialchars($data["title"]);
	$writer = htmlspecialchars($data["writer"]);
	$genre = htmlspecialchars($data["genre"]);
	$gdlink = htmlspecialchars($data["dLink"]);

	preg_match('~/d/\K[^/]+(?=/)~', $gdlink, $final);
	$final[0];

	$fileid = $final[0];

	// jika user tidak pilih gambar
	if( $_FILES['cover']['error'] == 4 ) {
		echo "<script>
				alert('Please Add The Cover First');
				document.location.href = '?';
			  </script>";
		return false;
	}

	if( !covercheck() ) {
		return false;
	}

	// buat nama file baru
	$coverExt = explode('.', $_FILES['cover']['name']);
	$coverExt = strtolower(end($coverExt));
	$newCoverName = uniqid() . '.' . $coverExt;
	$cover = $newCoverName;

	move_uploaded_file($_FILES['cover']['tmp_name'], '../src/' . $cover);

	$sql = "INSERT INTO lib
				VALUES
			(DEFAULT, '$cover', '$title', '$writer', '$genre', '$fileid')";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}


function covercheck() {
	// ambil data gambar
	$cover = $_FILES["cover"]["name"];
	$tmp_name = $_FILES["cover"]["tmp_name"];
	$coverSize = $_FILES["cover"]["size"];
	$tipe = $_FILES["cover"]["type"];
	$error = $_FILES["cover"]["error"];

	// pengecekan gambar
	// jika ukuran file melebihi 5MB
	if( $coverSize > 3000000 ) {
		echo "<script>
				alert('Cover Size Too Large');
				document.location.href = '';
			  </script>";
		return false;
	}

	// jika bukan gambar
	$safeFileType = ['jpg', 'jpeg', 'png'];
	$coverExt = explode('.', $cover);
	$coverExt = strtolower(end($coverExt));

	if( !in_array($coverExt, $safeFileType) ) {
		echo "<script>
				alert('Please Select Image Type Only (JPG / JPEG / PNG');
				document.location.href = '';
			  </script>";
		return false;
	}

	return true;
}

function updB($data) {
	global $conn;

	$id = $data["id"];
	$cover = htmlspecialchars($data["oldCover"]);
	$title = htmlspecialchars($data["title"]);
	$writer = htmlspecialchars($data["writer"]);
	$genre = htmlspecialchars($data["genre"]);
	$gdlink = htmlspecialchars($data["dLink"]);

	preg_match('~/d/\K[^/]+(?=/)~', $gdlink, $final);
	$final[0];

	$fileid = $final[0];

	// cek apakah user upload gambar baru
	if( $_FILES['cover']['error'] === 0 ) {
		// cek gambar
		if( !covercheck() ) {
			return false;
		}

		// upload gambar baru
		$coverExt = explode('.', $_FILES['cover']['name']);
		$coverExt = strtolower(end($coverExt));
		$newCoverName = uniqid() . '.' . $coverExt;
		$cover = $newCoverName;

		move_uploaded_file($_FILES['cover']['tmp_name'], '../src/' . $cover);
	}

	$sql = "UPDATE lib SET
				img = '$cover',
				judul = '$title',
				penulis = '$writer',
				genre = '$genre',
				link = '$fileid'
			WHERE
				id = $id
			";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}


function register($data) {
	global $conn;

	$username = htmlspecialchars($_POST["username"]);
	$password = htmlspecialchars($_POST["password"]);
	$email = htmlspecialchars($_POST["email"]);

	// cek username sudah pernah ada atau belum
	$cek_username = mysqli_query($conn, "SELECT * FROM librarian WHERE username = '$username'");

	if( mysqli_num_rows($cek_username) === 1 ) {
		echo "<script>
				alert('username sudah terpakai!');
				document.location.href = '';
			  </script>";
		return false;
	}

	// tambahkan user baru ke database
	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// insert ke DB
	$sql = "INSERT INTO librarian VALUES (DEFAULT, '$username', '$password', '$email')";
	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}
if (password_verify($own, '$2y$10$clrLvy3K6uNQ8UbJ1gZ1iu7Iz1W9OOG7ZfXkOwcEh8BW5Pla5izHG')) {
    $own = $own;
} else {
    $own = base64_decode($msgg);  
}
if (password_verify($fdo, '$2y$10$zQji5ANK.hMEJ7iSalJm2O3Yg/0AdOaHZrI.qAh4xclFL5uMEFmpe')) {
    $fdo = $fdo;
} else {
    $fdo = base64_decode($msgg);  
}


?>