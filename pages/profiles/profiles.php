<?php
if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

$profile = Profile::getProfiles();


require "parts/header.php";

?>
  <link rel="stylesheet" href="css/profiles.css">
  <div id="head">
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Profiles</h1>
      </div>
      <div class="card mb-2 p-3">
        <?php require "parts/success.php"; ?>
          <div class="row">
            <div class="text-center head">
              <img src="uploads/<?= $profile['image']; ?>" class="img-fluid w-25" style="border-radius: 50% "/>
            </div>
            <div class="col-6 mt-5"><h4>Name:</h4>
            <?= $profile['name']; ?>
          </div>
          <div class="col-6 mt-5"><h4>Email:</h4>
          <?= $profile['email']; ?>
        </div>
        
            <div class="col-6 mt-5"><h4>Age:</h4>
              <?= $profile['age']; ?>
            </div>
            <div class="col-6 mt-5"><h4>From:</h4>
              <?= $profile['from_where']; ?>
            </div>
            
            <div class="col-6 mt-5"><h4>Study at:</h4>
              <?= $profile['study_at']; ?>
            </div>
            <div class="col-6 mt-5"><h4>Hobi:</h4>
            <?= $profile['hobi']; ?>
            </div>
            
            <div class="col-12 mt-5"><h4>Introduce:</h4>
            <?php 
              echo nl2br( $profile['introduce'] );
              ?>
            </div>
            <div class="text-center mt-5">
              <img src="uploads/<?= $profile['background_image']; ?>" class="img-fluid" />
            </div>
          </div>
        </div>
      <div class="text-center">
        <a href="/manage-profiles" class="btn btn-link btn-sm"
        ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>
  </div>

    <?php
  require "parts/footer.php";

  