<?php
require '../function.php';
$id = $_GET["id"];

if( delreqtd($id) > 0 ) {
	echo "<script>
			alert('Takedown Request Deleted Successfully!');
            document.location.href = 'index.php';
		</script>";
} else {
	echo "<script>
			alert('Takedown Request Delete Failed!');
            document.location.href = 'index.php';
		</script>";
}

?>