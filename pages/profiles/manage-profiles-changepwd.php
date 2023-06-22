<?php
if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

$profile = Profile::getProfileByUser( $_GET['id'] );
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
        action="/profiles/changepwd"
        enctype="multipart/form-data">
          <div class="mb-3">
            <div class="row">
            <div class="mb-3">
            <label for="profile-image" class="form-label">Image</label>
            <input type="file" name="image" id="profile-image" />
            <?php if ( $profile['image'] ) : ?>
              <input type="hidden" name="original_image" value="<?= $profile['image']; ?>" />
              <p><img src="uploads/<?= $profile['image']; ?>" width="150px" /></p>
            <?php endif; ?>
          </div>
            <div class="col-6">
              <label for="profile-name" class="form-label">Name:</label>
              <input type="text" class="form-control" id="profile-name" name="name" value="<?= $profile['name']; ?>"/>
            </div>
            <div class="col-6">
              <label for="profile-email" class="form-label">Email:</label>
              <input type="text" class="form-control" id="profile-email" name="email" value="<?= $profile['email']; ?>"/>
            </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" />
              </div>
              <div class="col">
                <label for="confirm-password" class="form-label"
                  >Confirm Password</label
                >
                <input
                  type="password"
                  class="form-control"
                  id="confirm-password"
                  name="confirm_password"
                />
              </div>
            </div>
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
