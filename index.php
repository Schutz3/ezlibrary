<?php
session_start();
require 'function.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['hash']) ) {
	$id = $_COOKIE['id'];
	$hash = $_COOKIE['hash'];

	// cek username berdasarkan id
	$result = mysqli_query($conn, "SELECT * FROM librarian WHERE user_id = $id");
	$row = mysqli_fetch_assoc($result);

	if( $hash === hash('sha256', $row['username'], false) ) {
		// set session
		$_SESSION['username'] = $row['username'];
		// masuk ke pg index
		header('librarian/index.php');
		exit;
	}


}


// cek session
if( isset($_SESSION['username']) ) {
	header("Location: librarian/index.php");
	exit;
}

// jika tombol login ditekan
if( isset($_POST['login']) ) {

	// cek login
	// cek usernamenya dulu
	global $conn;
	$username = $_POST['username'];
	$password = $_POST['password'];
	$cek_username = mysqli_query($conn, "SELECT * FROM librarian WHERE username = '$username'");

	if( mysqli_num_rows($cek_username) === 1 ) {
		$row = mysqli_fetch_assoc($cek_username);
		// cek password
		if( password_verify($password, $row['password']) ) {
			// jika berhasil login
			$_SESSION['username'] = $_POST['username'];

			//jika remember di ceklis
			if( isset($_POST['remember']) ) {
				// buat cookie
					setcookie('id', $row['user'], time() + 60 * 60 * 24);
				$hash = hash('sha256', $row['username'], false);
				setcookie('hash', $hash, time() + 60 * 60 * 24);
			}

			header('Location: librarian/index.php');
			exit;
		}
	}
	
	$error = true;

}

// if( isset($_GET['search']) ) {
// 	$search = $_GET['search'];
// 	$sql = "SELECT * FROM lib
// 				WHERE
// 			 judul LIKE '%$search%' OR
// 			 id LIKE '%$search%' OR
// 			 penulis LIKE '%$search%' OR
// 			 genre LIKE '%$search%'
// 			";
// 	$lib = query($sql);
// } else {
// 	$lib = query("select * from lib ORDER BY ".$sorttype." ".$sorting);
// }

if( isset($_POST["addRB"]) ) {
	if( addRB($_POST) === 1 ) {
		echo "<script>
				alert('Your Request has ben sent to our Librarian!, You Will be redirect to main page');
				document.location.href = 'index.php?';
			  </script>";
	} else {
		echo "<script>
				alert('OOPS SOMETHING WRONG, We cannot proceed your request :(');
				document.location.href = '?';
			  </script>";
	}


}

if( isset($_POST["addRTD"]) ) {
	if( addRTD($_POST) > 0 ) {
		echo "
        <script>
				alert('Your Takedown Request has ben sent to our Librarian!, You Will be redirect to main page');
				document.location.href = 'index.php?';
			  </script>";
	} else {
		echo "
        <script>
				alert('OOPS SOMETHING WRONG, We cannot proceed your request :/');
				document.location.href = '#';
			  </script>";
	}
}

if( isset($_POST["returnHome"]) ) {
  echo "<script>
				document.location.href = 'index.php?';
			  </script>";
}

?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="icon" href="./img/libico.png" type="image/x-icon">
  <link rel="stylesheet" href="./css/custom-style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <title><?php echo $fdo; ?></title>
  <audio id="myAudio" loop preload="auto" control>
      <source src="./img/aud.mp3"  preload="auto">
  </audio>
</head>


<body>
  <div style="background: url('./img/library.jpg')" class="page-holder bg-cover">
  <!-- START NavigationBar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-secondary">
    <div class="container">
    <a class="navbar-brand disabled" href="./">
      <img src="./img/libico.png" width="30" height="30" class="d-inline-block align-top"alt="">
      <?php echo $fdo; ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse show" id="navbarColor01" >
      <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <!--<a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">-->
        <!--  Sort By-->
        <!--</a>-->
        
        <!--<ul class="dropdown-menu " aria-labelledby="navbarScrollingDropdown">-->
        <!--<li><a class="dropdown-item" href="?order=desc">Newest</a></li>-->
        <!--  <li><a class="dropdown-item" href="?order=asc">Oldest</a></li>-->
        <!--  <li><a class="dropdown-item" href="?type=judul&order=asc">Aa-Zz</a></li>-->
        <!--  <li><a class="dropdown-item" href="?type=judul&order=desc">Zz-Aa</a></li>-->
        <!--</ul>-->
      </li>
      </ul>
      <form class="form-inline" method="get">
        <input class="form-control mr-sm-2" type="search" name="search" id="search" placeholder="Find a Book" autocomplete="off" id="search" aria-label="Search" required>
        <!--<button class="btn btn-success btn-sm ml-3 mb-1 mt-1" type="Submit" name="search" id="search"><i class="bi bi-search"></i></button>-->
        <input type="submit" class="btn btn-success btn-sm ml-3 mb-1 mt-1" value="Find">
      </form>
        <div><button class="btn btn-danger btn-sm ml-3 mb-1 mt-1" data-toggle="modal" data-target="#Llogin"><i class="bi bi-person-badge"></i> Login</button></div>
    </div>
  </div>
  </nav>
  <!-- END NavigationBar -->


  <!-- START Modal Login -->
  <div class="modal fade" id="Llogin" tabindex="-1" role="dialog" aria-labelledby="Llogin"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Llogin">Librarian / Staff Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <div class="form-group">
              <label for="username">Librarian Username</label>
              <input type="username" class="form-control" id="username" name="username"
                placeholder="Your Librarian Username" required autocomplete="off">
            </div>
            <div class="form-group">
              <label for="password">Librarian Password:</label>
              <input type="password" class="form-control" id="password" name="password"
                placeholder="Your Librarian Password" required autocomplete="off">
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" name="remember" id="remember">
              <label class="form-check-label" for="remember">Remember Me?</label>
          <?php if( isset($error) ) : ?>
			    <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-secondary" name="login">Login <i class="bi bi-box-arrow-right"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- END Modal Login -->


  <!-- START Header -->
  <div class="header">
    <div class="container text-center pt-3 bg-success opacity-1 pb-1">
      <h3 class="display-6 hammer text-light pt-3 mt-5 opacity-0">Online library for everyone</h3>
      <p class="text-light opacity-0">Welcome! You can read a book here or <a id="sickle" href="#" onClick="togglePlay()"><i class="bi bi-play"></i></a> Music</p>
      <?php if( isset($error) ) : ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-triangle-fill"></i><br>
              <strong>WRONG CREDENTIAL!</strong><br> Crosscheck Your Librarian Username Or Password <br> If Forgot Contact The Administrator
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?> 
    </div>
  </div>
  <!-- END Header -->


<!-- START content -->
  <div class="container justify-content-center">
    <div class="row justify-content-center ">
            
        <?php $i = 1; ?>
        <div id="sort"></div>
	      <?php
                            $batas = 6;
                            $pg = @$_GET['pg'];
                            if(empty($pg)){
                                $posisi = 0;
                                $pg = 1;
                            }
                            else{
                                $posisi = ($pg-1) * $batas;
                            }
                            if(isset($_GET['search'])){
                                $search = $_GET['search'];
                                $sql="SELECT * FROM lib
                    				WHERE
                    			 judul LIKE '%$search%' OR
                    			 id LIKE '%$search%' OR
                    			 penulis LIKE '%$search%' OR
                    			 genre LIKE '%$search%'
                    			 order by id Desc limit $posisi, $batas";
                            }else{
                                $sql="select * from lib ORDER BY id Desc limit $posisi, $batas";
                            }

                            $lib=mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($lib)){
                                ?>

      <div class="col-md-4 text-center mt-2 mb-2">
        <div class="card opacity-1">
          <img class="card-img-top coverbook" width="100" src="./src/<?= $row["img"]; ?>" alt="Book<?= $i; ?>WID:<?= $row["id"]; ?>">  
          <div class="card-body">
            <h5 class="card-title"><?= $row["judul"]; ?></h5>
            <p class="card-text">
            <i class="bi bi-book-fill"></i> ID: <b><?= $row["id"]; ?></b><br>
              Writer: <b><?= $row["penulis"]; ?></b><br>
              Genre: <b><?= $row["genre"]; ?></b><br>
            </p>
            <button class="btn btn-secondary mt-1" type="submit" data-toggle="modal" data-target="#modalBaca<?= $row["id"]; ?>"><i class="bi bi-book-fill"></i> Read</button>
            <a href="https://drive.google.com/uc?export=download&id=<?= $row["link"]; ?>" onclick="return confirm('Do You Want To Download This E-Book?');"><button class="btn btn-success mt-1" type="submit"><i class="bi bi-file-earmark-arrow-down-fill"></i>Get</button></a>
          </div>
        </div>
      </div>

    <!-- START Modal View Baca -->
      <div class="modal fade" id="modalBaca<?= $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
              aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content text-center justify-content-center">
                  <div class="modal-header ">
                    <h6 class="modal-title text-center justify-content-center" id="exampleModalLongTitle"><?= $row["judul"]; ?></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-center justify-content-center">
                    <div class="bacabuku">
                    <iframe id="myFrame" class="bacabuku" src="https://drive.google.com/file/d/<?= $row["link"]; ?>/preview" allow="autoplay" frameborder="0"></iframe>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      <!-- END Modal View Baca -->

        
      <?php $i++; ?>
			<?php } ?>
			<!-- START IF DATA / SEARCH EMPTY -->

	<?php if( $i <= 1 ) : ?>

		<div class="col-md2 text-center mt-2 mb-2">
        <div class="card opacity-1">
        <div class="tenor-gif-embed" data-postid="22163955" data-share-method="host" data-aspect-ratio="1" data-width="100%"><a href="https://tenor.com/view/404-gif-22163955">404 GIF</a>from <a href="https://tenor.com/search/404-gifs">404 GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
          <div class="card-body">
            <h5 class="card-title">Sorry, Book Not Found :(</h5>
            <p class="card-text">Back to Main Page <a href="index.php?">here</a> <br>Or<br> Request to our librarian <a href="#" data-toggle="modal" data-target="#requestB">here</a> </p>
          </div>
        </div>
      </div>
  <!-- START Modal Request Book -->
  <div class="modal fade" id="requestB" tabindex="-1" role="dialog" aria-labelledby="requestB"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="requestB">Request Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        <p class="card-text"><b>Please provide valid email so we can notify you when your book is published in our site</b></p>
          <form class="needs-validation" method="post">
            <div class="form-group">
              <label for="inpName">Name</label>
              <input type="Name" class="form-control" name="namerb" id="namerb" 
                placeholder="Your Name" required autocomplete="off">
            </div>
            <div class="form-group">
              <label for="inpEmail">Email:</label>
              <input type="email" class="form-control" name="emailrb" id="emailrb"
                placeholder="Your Email e.g admin@<?php echo $fdo; ?>.com" required autocomplete="off">
            </div>
            <div class="form-group">
              <label for="inpRB">Book you want to request</label>
              <input type="Name" class="form-control" name="bookreq" id="bookreq"
                placeholder="Title or ISBN Number" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-secondary" name="addRB">Request</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- END Modal Request Book -->
  <!-- START Modal Request TakeDown -->
<div class="modal fade" id="requestRTD" tabindex="-1" role="dialog" aria-labelledby="requestRTD"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="requestRTD">Request Book Take Down</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post">
          <fieldset disabled>
            <div class="form-group">
              <label for="inpName" >Name</label>
              <input type="Name" class="form-control" name="namertd" id="disabledInput"
                placeholder="Book Not Found">
            </div>
            </fieldset>
            <fieldset disabled>
            <div class="form-group">
              <label for="inpEmail">Email:</label>
              <input id="disabledInput" type="email" class="form-control" name="emailrtd"
                placeholder="Return To Main Page First">
            </div>
            </fieldset>
            <fieldset disabled>
            <div class="form-group">
              <label for="exampleFormControlSelect2">Select A Book</label>
                <select class="form-control" name="bookrtde" id="bookrtde">
                    <option>404</option>
                </select>
            </div>
          </fieldset>
          <div class="container justify-content-center text-center">
            <button type="submit" class="btn btn-danger text-center" name="returnHome" >Back To Main Page</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- END Modal Request Take Down -->

	<?php endif; ?>
<!-- END IF DATA / SEARCH EMPTY -->
			
			


                    <?php
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $query2 = "SELECT * FROM lib
				WHERE
			 judul LIKE '%$search%' OR
			 id LIKE '%$search%' OR
			 penulis LIKE '%$search%' OR
			 genre LIKE '%$search%'
			 order by id Desc";
        }else{
            $query2 = "select * from lib ORDER BY id Desc";
        }
        $result2 = mysqli_query($conn, $query2);
        $jmldata = mysqli_num_rows($result2);
        $jmlpg = ceil($jmldata/$batas);
        ?>



    </div>
                            <br>
                        <div class="row justify-content-center">
                           <ul class="pagination">
                            <?php
                            for($i=1;$i<=$jmlpg;$i++){
                                if ($i !=$pg){
                                    if(isset($_GET['search'])){
                                        $search = $_GET['search'];
                                        echo "<li class='page-item'><a class='page-link' href='?pg=$i&search=$search'>$i</a></li>";
                                    }else{
                                        echo "<li class='page-item'><a class='page-link' href='?pg=$i'>$i</a></li>";
                                    }

                                }else{
                                    echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                                }
                            }
                            ?>
                        </ul> 
                        </div>
                        
<?php
mysqli_close($conn);
                    ?>   
  </div>

<!--END content -->

  





<!-- START Footer -->
<footer class="page-footer">
  <div class="footer text-center py-3 bg-secondary text-light " bottom=0>
  2022 <?php echo $own; ?> | <a href="#"><img src="./img/libico.png" width="25" height="25" class="d-inline-block align-bottom" alt="ico"></a> <?php echo $fdo; ?><br>
  If you see a book copyright/content violation, send a takedown request to our librarian <a id="sickle" href="#" data-toggle="modal" data-target="#requestRTD">Here</a>
  </div>
</footer>

<!-- START Modal Request TakeDown -->
<div class="modal fade" id="requestRTD" tabindex="-1" role="dialog" aria-labelledby="requestRTD"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="requestRTD">Request Book Take Down</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <p class="card-text"><b>Please provide valid email so we can contact you</b></p>

          <form method="post">
            <div class="form-group">
              <label for="inpName">Name</label>
              <input type="Name" class="form-control" name="namertd" id="namertd"
                placeholder="Your Name" required autocomplete="off">
            </div>
            <div class="form-group">
              <label for="inpEmail">Email:</label>
              <input type="email" class="form-control" name="emailrtd" id="emailrtd"
                placeholder="Your Email e.g admin@<?php echo $fdo; ?>.com" required autocomplete="off">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect2">Select A Book</label>
                <select class="form-control" name="bookrtd" id="bookrtd" required>
                <option value="" disabled selected hidden>Select Book You Want To Report</option>
                <?php $idb = 1; ?>
                <?php foreach( $lib as $row ) { ?>
                    <option><?= $row["id"]; ?> || <?= $row["judul"]; ?></option>
                <?php $idb++; ?>
			          <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-secondary" name="addRTD">Request Take Down</button>
          </form>


        </div>
      </div>
    </div>
  </div>
<!-- END Modal Request Take Down -->
</div>
<!-- END Footer -->
  <!-- START SCRIPT -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
  <!-- END -->
    
    
</body>