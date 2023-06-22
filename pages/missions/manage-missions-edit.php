<?php

if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

$mission = Mission::getMissionByID( $_GET['id'] );


  require "parts/header.php";

?>
    <link rel="stylesheet" href="css/mission.css">

    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Job</h1>
      </div>
      <div class="card mb-2 p-4">
      <?php require "parts/error.php"; ?>
        <form
        method="POST"
        action="/missions/edit"
        enctype="multipart/form-data">
          <div class="mb-3">
            <label for="mission-title" class="form-label">Title</label>
            <input
              type="text"
              class="form-control"
              id="mission-title"
              name="title"
              value="<?= $mission['title']; ?>"
            />
          </div>
          <div class="mb-3">
            <div class="row">
            <div class="col-5">
              <label for="mission-date" class="form-label">Start:</label>
              <input type="date" class="form-control" id="mission-date" name="date_start" value="<?= $mission['date_start']; ?>"/>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
              <h1>To</h1>
            </div>
            <div class="col-5">
              <label for="mission-date" class="form-label">End:</label>
              <input type="date" class="form-control" id="mission-date" name="date_end" value="<?= $mission['date_end']; ?>"/>
            </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
            <div class="col-5">
              <label for="mission-date" class="form-label">Price($):</label>
              <input type="text" class="form-control" id="mission-text" name="cost" value="<?= $mission['cost']; ?>"/>
            </div>
            <div class="col-2">
            </div>
            <div class="col-5">
              <label for="mission-date" class="form-label">Contact number:</label>
              <input type="text" class="form-control" id="mission-contact" name="contact" value="<?= $mission['contact']; ?>"/>
            </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="mission-text" class="form-label">text</label>
            <textarea class="form-control" id="mission-text" rows="10" name="text"><?= $mission['text']; ?></textarea>
          </div>
          <div class="mb-3">
            <label for="mission-image" class="form-label">Image</label>
            <input type="file" name="image" id="mission-image" />
            <?php if ( $mission['image'] ) : ?>
              <input type="hidden" name="original_image" value="<?= $mission['image']; ?>" />
              <p><img src="uploads/<?= $mission['image']; ?>" width="150px" /></p>
            <?php endif; ?>
          </div>

          <div class="mb-5">
            <label for="mission-content" class="form-label">Status</label>
            <select class="form-control" id="mission-status" name="status">
              <option value="pending" <?= $mission['status'] === 'pending' ? 'selected' : ''; ?>>Pending for Review</option>
              <?php if(Auth::isAdmin() || Auth::isEditor() ) : ?>
              <option value="publish" <?= $mission['status'] === 'publish' ? 'selected' : ''; ?>>Publish</option>
              <?php endif ?>
              <div class="mb-3">
            </select>
          </div>
            Last modified by: 
              <?php 
                echo $mission["name"];

              ?> 
              on ( <?= $mission["done_at"]; ?> )
          </div>
          <div class="text-end mt-5">
          <input type="hidden" name="id" value="<?= $mission['id']; ?>" />
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-missions" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>

<?php

require "parts/footer.php";

?>