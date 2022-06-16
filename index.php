<?php
require 'function.php';
if( isset($_GET['cari']) ) {
	$keyword = $_GET['keyword'];
	$sql = "SELECT * FROM lib
				WHERE
			 judul LIKE '%$keyword%' OR
			 id LIKE '%$keyword%' OR
			 penulis LIKE '%$keyword%' OR
			 genre LIKE '%$keyword%'
			";
	$lib = query($sql);
} else {
	$lib = query("select * from lib");
}

if( isset($_POST["addRB"]) ) {
	if( addRB($_POST) > 0 ) {
		echo "<script>
				alert('Your Request has ben sent to our Librarian!, You Will be redirect to main page');
				document.location.href = 'index.php';
			  </script>";
	} else {
		echo "<script>
				alert('OOPS SOMETHING WRONG, We cannot proceed your request :(');
				document.location.href = '#';
			  </script>";
	}
}

if( isset($_POST["addRTDE"]) ) {
  echo "<script>
				document.location.href = 'index.php';
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
  <title>EzLibrary</title>
  <audio id="myAudio" loop preload="auto" control>
      <source src="./img/aud.mp3"  preload="auto">
  </audio>
</head>


<body>
  <div style="background: url('./img/library.jpg')" class="page-holder bg-cover">
  <!-- NavigationBar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-secondary">
    <div class="container">
    <a class="navbar-brand disabled" href="#">
      <img src="./img/libico.png" width="30" height="30" class="d-inline-block align-top"alt="">
      EzLibrary
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse show" id="navbarColor01" >
      <ul class="navbar-nav mr-auto">
      </ul>
      <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" name="keyword" id="keyword" placeholder="Find a Book" autocomplete="off" id="keyword" aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0 ml-3" type="Submit" name="cari" id="cari">Find!</button>
      </form>
        <div><button class="btn btn-danger my-2 my-sm-0 ml-3" data-toggle="modal" data-target="#Llogin">Librarian Login</button></div>
    </div>
  </div>
  </nav>
  <!-- NavigationBar -->


  <!-- Modal Login -->
  <div class="modal fade" id="Llogin" tabindex="-1" role="dialog" aria-labelledby="Llogin"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Llogin">Librarian Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="InpUsername">Username</label>
              <input type="Username" class="form-control" id="InpUsername"
                placeholder="Your Librarian Username">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password:</label>
              <input type="password" class="form-control" id="exampleInputPassword1"
                placeholder="Your Librarian Password">
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Remember Me?</label>
            </div>
            <button type="submit" class="btn btn-secondary">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Login -->


  <!-- Header -->
  <div class="header">
    <div class="container text-center pt-3 bg-success opacity-1 pb-1">
      <h3 class="display-6 hammer text-light pt-3 mt-5 opacity-0">Online library for everyone</h3>
      <p class="text-light opacity-0">Click <a id="sickle" href="#" onClick="togglePlay()"> Here</a> to listen music</p>
    </div>
  </div>
  <!-- Header -->


  <!-- content -->
  <div class="container justify-content-center">
    <div class="row justify-content-center ">

	<?php if( empty($lib) ) : ?>

		<div class="col-md2 text-center mt-2 mb-2">
        <div class="card opacity-1">
        <div class="tenor-gif-embed" data-postid="22163955" data-share-method="host" data-aspect-ratio="1" data-width="100%"><a href="https://tenor.com/view/404-gif-22163955">404 GIF</a>from <a href="https://tenor.com/search/404-gifs">404 GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
          <div class="card-body">
            <h5 class="card-title">Sorry, Book Not Found :(</h5>
            <p class="card-text">Back to Main Page <a href="index.php">here</a> <br>Or<br> Request to our librarian <a href="#" data-toggle="modal" data-target="#requestB">here</a> </p>
          </div>
        </div>
      </div>
  <!-- Modal Request Book -->
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
          <form method="post">
            <div class="form-group">
              <label for="inpName">Name</label>
              <input type="Name" class="form-control" name="namerb" id="namerb"
                placeholder="Your Name">
            </div>
            <div class="form-group">
              <label for="inpEmail">Email:</label>
              <input type="email" class="form-control" name="emailrb" id="emailrb"
                placeholder="Your Email e.g admin@ezlibrary.com">
            </div>
            <div class="form-group">
              <label for="inpRB">Book you want to request</label>
              <input type="Name" class="form-control" name="bookreq" id="bookreq"
                placeholder="I Want Book ......">
            </div>
            <button type="submit" class="btn btn-secondary" name="addRB">Request</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Request Book -->
  <!-- Modal Request TakeDown -->
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
            <div class="form-group">
              <label for="inpName">Name</label>
              <input type="Name" class="form-control" name="namertd" id="namertd"
                placeholder="Your Name">
            </div>
            <div class="form-group">
              <label for="inpEmail">Email:</label>
              <input type="email" class="form-control" name="emailrtd" id="emailrtd"
                placeholder="Your Email e.g admin@ezlibrary.com">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect2">Select A Book</label>
                <select class="form-control" name="bookrtd" id="bookrtd">
                    <option>Buku Tidak Ditemukan</option>
                </select>
            </div>
            <button type="submit" class="btn btn-secondary"name="addRTDE" >Back To Main Page</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- Modal Request Take Down -->

	<?php endif; ?>

        <?php $i = 1; ?>

	      <?php foreach( $lib as $row ) { ?>
          
      <div class="col-md-4 text-center mt-2 mb-2">
        <div class="card opacity-1">
          <img class="card-img-top coverbook text-center" width="100" src="./src/<?= $row["img"]; ?>" alt="BookImg">
          <div class="card-body">
            <h5 class="card-title"><?= $row["judul"]; ?></h5>
            <p class="card-text">
              ID: <b><?= $row["id"]; ?></b><br>
              Writer: <b><?= $row["penulis"]; ?></b><br>
              Genre: <b><?= $row["genre"]; ?></b><br>
            </p>
            <button class="btn btn-secondary mt-1" type="submit" data-toggle="modal" data-target="#modalBaca<?= $row["id"]; ?>">Read</button>
            <a href="https://drive.google.com/uc?export=download&id=<?= $row["link"]; ?>" onclick="return confirm('Ingin Mengunguh E-Book Ini?');"><button class="btn btn-success mt-1" type="submit">Download</button></a>
          </div>
        </div>
      </div>


      <!-- Modal View Baca -->
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
        <!-- Modal View Baca -->

        
      <?php $i++; ?>
			<?php } ?>

    </div>
  </div>

<!-- content -->

  





<!-- Footer -->
<footer class="page-footer">
  <div class="footer text-center py-3 bg-secondary text-light " bottom=0>
  2022 | <a href="#"><img src="./img/libico.png" width="25" height="25" class="d-inline-block align-bottom" alt="ico"></a> EzLibrary <br>
  If you see a book copyright violation, send a takedown request to our librarian <a id="sickle" href="#" data-toggle="modal" data-target="#requestRTD">Here</a>
  </div>
</footer>

<!-- Modal Request TakeDown -->
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
            <div class="form-group">
              <label for="inpName">Name</label>
              <input type="Name" class="form-control" name="namertd" id="namertd"
                placeholder="Your Name">
            </div>
            <div class="form-group">
              <label for="inpEmail">Email:</label>
              <input type="email" class="form-control" name="emailrtd" id="emailrtd"
                placeholder="Your Email e.g admin@ezlibrary.com">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect2">Select A Book</label>
                <select class="form-control" name="bookrtd" id="bookrtd">
                <?php $idb = 1; ?>
                <?php foreach( $lib as $row ) { ?>
                    <option>ID: <?= $row["id"]; ?> // Title: <?= $row["judul"]; ?></option>
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
<!-- Modal Request Take Down -->

</div>
<!-- Footer -->
  <!-- Optional JavaScript -->
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
    
    
</body>