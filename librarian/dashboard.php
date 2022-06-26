<?php
session_start();
require '../function.php';
if( !isset($_SESSION['username']) ) {
	header("Location: ../index.php");
	exit;
}

$sorting = $_GET['order'] ?? 'desc';
$sorttype = $_GET['type'] ?? 'id';
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
	$lib = query("select * from lib ORDER BY ".$sorttype." ".$sorting);
}
if( isset($_POST["addBook"]) ) {
	if( addBook($_POST) > 0 ) {
		echo "<script>
				alert('New Book Successfully added');
				document.location.href = 'index.php';
			  </script>";
	} else {
		echo "<script>
				alert('New Book Failed to add');
				document.location.href = 'index.php';
			  </script>";
	}
}
if( isset($_POST["update"]) ) {
	if( updB($_POST) > 0 ) {
		echo "<script>
				alert('Book Details Successfully Changed');
				document.location.href = 'index.php';
			  </script>";
	} else {
		echo "<script>
				alert('Book Details Failed to Change');
				document.location.href = 'index.php';
			  </script>";
	}
}

  $reqb = query("select * from reqbook");
  $reqt = query("select * from reqtd");


?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="icon" href="../img/libico.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/custom-style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <title>EzLibrary</title>
  <audio id="myAudio" loop preload="auto" control>
      <source src="../img/aud.mp3"  preload="auto">
  </audio>
</head>


<body>
  <div style="background: url('../img/library.jpg')" class="page-holder bg-cover">
    <!-- START Read Request -->
    <div class="modal fade" id="readReq" tabindex="-1" role="dialog" aria-labelledby="readReq"
              aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content text-center justify-content-center">
                  <div class="modal-header ">
                    <h6 class="modal-title text-center justify-content-center" id="exampleModalLongTitle">Book Request Msg</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-center justify-content-center" >
                  <div style="overflow: auto;">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Requesting Book</th>
                            <th scope="col">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php if( empty($reqb) ) : ?>
		                          <tr>
			                        <td colspan="5" style="align: center;">No More Request</td>
		                          </tr>
	                    <?php endif; ?>
                      <?php $i = 1; ?>
	                    <?php foreach( $reqb as $row ) { ?>
                          <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $row["name"]; ?></td>
                            <td><?= $row["email"]; ?></td>
                            <td><?= $row["bookreq"]; ?></td>
                            <td><a class="btn btn-danger btn-sm" href="delreqmsg.php?id=<?php echo $row["id"]; ?>" role="button"><i class="bi bi-trash3-fill"></i></a></td>
                          </tr>
                        <?php $i++; ?>
	                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>
            </div>
  <!-- END Read Request -->
  <!-- START Takedown Request -->
  <div class="modal fade" id="readRT" tabindex="-1" role="dialog" aria-labelledby="readRT"
              aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content text-center justify-content-center">
                  <div class="modal-header ">
                    <h6 class="modal-title text-center justify-content-center" id="exampleModalLongTitle">Book Takedown Request</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-center justify-content-center" >
                  <div style="overflow: auto;">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Requesting Takedown of book:</th>
                            <th scope="col">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php if( empty($reqt) ) : ?>
		                          <tr>
			                        <td colspan="5" style="align: center;">No Takedown Request</td>
		                          </tr>
	                    <?php endif; ?>
                      <?php $t = 1; ?>
	                    <?php foreach( $reqt as $row ) { ?>
                          <tr>
                            <th scope="row"><?= $t; ?></th>
                            <td><?= $row["name"]; ?></td>
                            <td><?= $row["email"]; ?></td>
                            <td><?= $row["booktdreq"]; ?></td>
                            <td><a class="btn btn-danger btn-sm" href="delreqtd.php?id=<?php echo $row["id"]; ?>" role="button"><i class="bi bi-trash3-fill"></i></a></td>
                          </tr>
                        <?php $t++; ?>
	                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>
            </div>
  <!-- END Takedown Request -->
  <!-- START NavigationBar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-secondary">
    <div class="container">
    <a class="navbar-brand disabled" href="./">
      <img src="../img/libico.png" width="30" height="30" class="d-inline-block align-top"alt=""></a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse show" id="navbarColor01" >
      <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown ml-1">
        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          Sort By
        </a>
        
        <ul class="dropdown-menu " aria-labelledby="navbarScrollingDropdown">
        <li><a class="dropdown-item" href="?order=desc">Newest</a></li>
          <li><a class="dropdown-item" href="?order=asc">Oldest</a></li>
          <li><a class="dropdown-item" href="?type=judul&order=asc">Aa-Zz</a></li>
          <li><a class="dropdown-item" href="?type=judul&order=desc">Zz-Aa</a></li>
        </ul>
      </li>
      <button type="button" class="btn btn-outline-primary btn-sm text-light   ml-3 mb-1 mt-1" data-toggle="modal" data-target="#addBook"><i class="bi bi-plus-square"></i> Book</button>
      <button type="button" class="btn btn-outline-success btn-sm text-light   ml-3 mb-1 mt-1" data-toggle="modal" data-target="#readReq"><i class="bi bi-inboxes-fill"></i> Request (<?= $i - 1; ?>)</button>
      <button type="button" class="btn btn-outline-warning btn-sm text-light ml-3 mb-1 mt-1" data-toggle="modal" data-target="#readRT"><i class="bi bi-exclamation-triangle-fill"></i> Report (<?= $t - 1; ?>)</button>
      </ul>
      <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" name="keyword" id="keyword" placeholder="Find a Book" autocomplete="off" id="keyword" aria-label="Search" required>
        <button class="btn btn-success btn-sm ml-3 mb-1 mt-1" type="Submit" name="cari" id="cari"><i class="bi bi-search"></i></button>
      </form>
        <div><a class="btn btn-danger btn-sm ml-3 mb-1 mt-1" href="logout.php" role="button" onclick="return confirm('Are You Sure Want To Logout?');"><i class="bi bi-arrow-left-square"></i> Logout</a></div>
    </div>
  </div>
  </nav>
  
  <!-- END NavigationBar -->

  <!-- START Add Book -->
  <div class="modal fade" id="addBook" tabindex="-1" role="dialog" aria-labelledby="addBook"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addBook">Add / Publish New Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title">Title of the Book or Journal</label>
              <input type="text" class="form-control" id="title" name="title"
                placeholder="Title of the Book or Journal" required autocomplete="off">
            </div>
            <div class="form-group">
              <label for="writer">Writer of the Book</label>
              <input type="text" class="form-control" id="writer" name="writer"
                placeholder="Writer of the Book" required autocomplete="off">
            </div>
            <div class="form-group">
              <label for="genre">Genre of the Book</label>
              <input type="text" class="form-control" id="genre" name="genre"
                placeholder="Genre of the Book" required autocomplete="off">
            </div>
            <div class="form-group">
              <label for="dLink">PDF File Link (Google Drive) <i class="bi bi-filetype-pdf"></i>  <i class="bi bi-filetype-ppt"></i> <i class="bi bi-filetype-pptx"></i></label>
              <input type="text" class="form-control" id="dLink" name="dLink"
                placeholder="PDF File Link (Google Drive)" required autocomplete="off">
            </div>
            <div class="form-group">
            <label for="cover" class="form-label">Cover of the book <i class="bi bi-filetype-png"></i> <i class="bi bi-filetype-jpg"></i> </label>
            <input class="form-control" type="file" id="cover" name="cover" placeholder>
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="bi bi-x-square"></i></button>
            <button type="submit" class="btn btn-success" name="addBook"><i class="bi bi-plus-square"></i> Book</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- END Add Book -->



  <!-- START Header -->
  <div class="header">
    <div class="container text-center pt-3 bg-success opacity-1 pb-1">
      <h3 class="display-6 hammer text-light pt-3 mt-5 opacity-0">Welcome Librarian !</h3>
      <p class="text-light opacity-0">While you do your job, You can <a id="sickle" href="#" onClick="togglePlay()"><i class="bi bi-play"></i></a> Music</p>
    </div>
  </div>
  <!-- END Header -->


<!-- START content -->
  <div class="container justify-content-center">
    <div class="row justify-content-center ">


<!-- START IF DATA / SEARCH EMPTY -->

	<?php if( empty($lib) ) : ?>

		<div class="col-md2 text-center mt-2 mb-2">
        <div class="card opacity-1">
        <div class="tenor-gif-embed" data-postid="22163955" data-share-method="host" data-aspect-ratio="1" data-width="100%"><a href="https://tenor.com/view/404-gif-22163955">404 GIF</a>from <a href="https://tenor.com/search/404-gifs">404 GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
          <div class="card-body">
            <h5 class="card-title">Book Not Found :(</h5>
            <p class="card-text">Back to Main Page <a href="dashboard.php?"><i class="bi bi-arrow-left-square"></i></a></p>
          </div>
        </div>
      </div>
  <!-- START Modal Request Book -->

	<?php endif; ?>
<!-- END IF DATA / SEARCH EMPTY -->
        <?php $e = 1; ?>
        <div id="sort"></div>
	      <?php foreach( $lib as $row ) { ?>

      <div class="col-md-4 text-center mt-2 mb-2">
        <div class="card opacity-1">
          <img class="card-img-top coverbook" width="100" src="../src/<?= $row["img"]; ?>" alt="Book<?= $i; ?>WID:<?= $row["id"]; ?>">  
          <div class="card-body">
            <h5 class="card-title"><?= $row["judul"]; ?></h5>
            <p class="card-text">
              Book ID: <b><?= $row["id"]; ?></b><br>
              Writer: <b><?= $row["penulis"]; ?></b><br>
              Genre: <b><?= $row["genre"]; ?></b><br>
            </p>
            <button class="btn btn-secondary mt-1" type="submit" data-toggle="modal" data-target="#modalBaca<?= $row["id"]; ?>"><i class="bi bi-book-fill"></i> Read</button>
            <a href="https://drive.google.com/uc?export=download&id=<?= $row["link"]; ?>" onclick="return confirm('Ingin Mengunguh E-Book Ini?');"><button class="btn btn-success mt-1" type="submit"><i class="bi bi-file-earmark-arrow-down-fill"></i> Get</button></a><br>
            <button class="btn btn-primary mt-1" type="submit" data-toggle="modal" data-target="#updBook<?= $row["id"]; ?>"><i class="bi bi-pencil-square"></i> Edit</button>
            <a href="delb.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('ARE YOU SURE WANT TO DELETE THIS BOOK FROM LIST?');"><button class="btn btn-danger mt-1" type="submit"><i class="bi bi-trash3-fill"></i></button></a>
          </div>
        </div>
      </div>
  <!-- Update  Book -->
  <div class="modal fade" id="updBook<?= $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="addBook"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title display-6" id="addBook">Update Book <div class="text-danger"><?= $row["judul"]; ?></div></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
		        <input type="hidden" name="oldCover" value="<?= $row["img"]; ?>">
              <label for="title">Title of the Book or Journal</label>
              <input type="text" class="form-control" id="title" name="title"
                placeholder="Title of the Book or Journal" required autocomplete="off" value="<?= $row["judul"]; ?>">
            </div>
            <div class="form-group">
              <label for="writer">Writer of the Book</label>
              <input type="text" class="form-control" id="writer" name="writer"
                placeholder="Writer of the Book" required autocomplete="off" value="<?= $row["penulis"]; ?>">
            </div>
            <div class="form-group">
              <label for="genre">Genre of the Book</label>
              <input type="text" class="form-control" id="genre" name="genre"
                placeholder="Genre of the Book" required autocomplete="off" value="<?= $row["genre"]; ?>">
            </div>
            <div class="form-group">
              <label for="dLink">PDF File Link (Google Drive)</label>
              <input type="text" class="form-control" id="dLink" name="dLink"
                placeholder="New Link Required" required autocomplete="off" value="https://drive.google.com/file/d/<?= $row["link"]; ?>/view?usp=sharing">
            </div>
            <div class="form-group">
            <label for="cover" class="form-label">Cover of the book</label>
            <input class="form-control" type="file" id="cover" name="cover">
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="bi bi-x-square"></i></i></button>
            <button type="submit" class="btn btn-success" name="update"><i class="bi bi-pencil-square"></i> Edit Book</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Update  Book -->

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

        
      <?php $e++; ?>
			<?php } ?>

    </div>
  </div>

<!--END content -->

  





<!-- START Footer -->
<footer class="page-footer">
  <div class="footer text-center py-3 bg-secondary text-light " bottom=0>
  2022 | <a href="#"><img src="../img/libico.png" width="25" height="25" class="d-inline-block align-bottom" alt="ico"></a> EzLibrary
  </div>
</footer>
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
    <script src="../js/script.js"></script>
  <!-- END -->
    
    
</body>