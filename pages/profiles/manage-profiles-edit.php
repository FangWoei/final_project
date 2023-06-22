<?php
if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

$profile = Profile::getProfileByID( $_GET['id'] );
require "parts/header.php";

?>
  <link rel="stylesheet" href="css/profiles.css">
  
  <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Profiles</h1>
      </div>
      <div class="card mb-2 p-4">
      <?php require "parts/error.php"; ?>
        <form
        method="POST"
        action="/profiles/edit"
        enctype="multipart/form-data">           
          <div class="mb-3">
            <div class="row">
            <div class="col-5">
              <label for="profile-age" class="form-label">Age:</label>
              <input type="text" class="form-control" id="profile-age" name="age" value="<?= $profile['age']; ?>"/>
            </div>
            <div class="col-2">
            </div>
            <div class="col-5">
              <label for="profile-from" class="form-label">From:</label>
              <input type="text" class="form-control" id="profile-from" name="from_where" value="<?= $profile['from_where']; ?>"/>
            </div>
            </div>
          </div>
          
          <div class="mb-3">
            <div class="row">
            <div class="col-5">
              <label for="profile-study" class="form-label">Study at:</label>
              <input type="text" class="form-control" id="study_at" name="study_at" value="<?= $profile['study_at']; ?>"/>
            </div>
            <div class="col-2">
            </div>
            <div class="col-5">
              <label for="profile-hobi" class="form-label">Hobi:</label>
              <input type="text" class="form-control" id="hobi" name="hobi" value="<?= $profile['hobi']; ?>"/>
            </div>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="mission-text" class="form-label">Introduce</label>
            <textarea class="form-control" id="introduce" rows="10" name="introduce"><?= $profile['introduce']; ?></textarea>
          </div>

          <div class="mb-3">
            <label for="profile-image" class="form-label">Image</label>
            <input type="file" name="background_image" id="background_image" />
            <?php if ( $profile['background_image'] ) : ?>
              <input type="hidden" name="profile_image" value="<?= $profile['background_image']; ?>" />
              <p><img src="uploads/<?= $profile['background_image']; ?>" width="150px" /></p>
            <?php endif; ?>
          </div>
          <div class="text-end">
          <input type="hidden" name="id" value="<?= $profile['id']; ?>" />
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-profiles" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>
<?php
  require "parts/footer.php";
