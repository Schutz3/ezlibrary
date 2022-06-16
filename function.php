<?php 
$conn = mysqli_connect("localhost", "root", "","lib" );

	
function query($sql) {
	global $conn;
	$result = mysqli_query($conn, $sql);

	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}

function addRB($data) {
	global $conn;

	$name = htmlspecialchars($data["namerb"]);
	$email = htmlspecialchars($data["emailrb"]);
	$bookreq = htmlspecialchars($data["bookreq"]);

	$sql = "INSERT INTO reqbook
				VALUES
			('', '$name', '$email','$bookreq')";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}

function addRTD($data) {
	global $conn;

	$name = htmlspecialchars($data["namerb"]);
	$email = htmlspecialchars($data["emailrb"]);
	$bookreq = htmlspecialchars($data["bookreq"]);

	$sql = "INSERT INTO reqbook
				VALUES
			('', '$name', '$email','$bookreq')";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}



?>