<?php
//sleep(1);
require 'functions.php';
$keyword = $_GET['keyword'];
$sql = "SELECT * FROM lib WHERE
        judul LIKE '%$keyword%' OR
        id LIKE '%$keyword%' OR
        penulis LIKE '%$keyword%' OR
        genre LIKE '%$keyword%'
        ";
$lib = query($sql);
?>
<div class="container justify-content-center">
    <div class="row justify-content-center ">
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
            <a href="https://drive.google.com/uc?export=download&id=<?= $row["link"]; ?>"><button class="btn btn-success mt-1" type="submit">Download</button></a>
          </div>
        </div>
      </div>
      
      <!-- Modal View Baca -->
          <div class="modal fade" id="modalBaca<?= $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $row["judul"]; ?>"
              aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content text-center justify-content-center">
                  <div class="modal-header">
                    <p class="modal-title text-center justify-content-center" id="exampleModalLongTitle"><?= $row["judul"]; ?></p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-center justify-content-center">
                  <div class="bacabuku text-center justify-content-center">
                  <iframe id="myFrame" class="bacabuku" src="https://drive.google.com/file/d/<?= $row["link"]; ?>/preview" height="800" width="400 allow="autoplay" frameborder="0"></iframe>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    <!-- Modal View Baca -->S
      <?php $i++; ?>
			<?php } ?>

    </div>
</div>


