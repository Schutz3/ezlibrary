<?php
require '../function.php';
$id = $_GET["id"];

if( delb($id) > 0 ) {
	echo "<script>
			alert('BOOK REMOVED SUCCESSFULLY!');
            document.location.href = 'index.php';
		</script>";
} else {
	echo "<script>
			alert('BOOK REMOVE OPERATION FAILED!');
            document.location.href = 'index.php';
		</script>";
}

?>