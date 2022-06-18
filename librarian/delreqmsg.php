<?php
require '../function.php';
$id = $_GET["id"];

if( delreqmsg($id) > 0 ) {
	echo "<script>
			alert('Request Deleted Successfully!');
            document.location.href = 'index.php';
		</script>";
} else {
	echo "<script>
			alert('Request Delete Failed!');
            document.location.href = 'index.php';
		</script>";
}

?>