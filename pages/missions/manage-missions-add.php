<?php

if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

  require "parts/header.php";

?>
    <link rel="stylesheet" href="css/mission.css">

    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Add New Job</h1>
      </div>
      <div class="card mb-2 p-4">
      <?php require "parts/error.php"; ?>
      <form
          method="POST"
          action="missions/add"
          enctype="multipart/form-data"
          >
          <div class="mb-3">
            <label for="mission-title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="mission-title" name="title"/>
          </div>
          <div class="mb-3">
            <div class="row">
            <div class="col-5">
              <label for="mission-date" class="form-label">Start:</label>
              <input type="date" class="form-control" id="mission-date" name="date_start"/>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
              <h1>To</h1>
            </div>
            <div class="col-5">
              <label for="mission-date" class="form-label">End:</label>
              <input type="date" class="form-control" id="mission-date" name="date_end"/>
            </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
            <div class="col-5">
              <label for="mission-date" class="form-label">Price($):</label>
              <input type="text" class="form-control" id="mission-text" name="cost"/>
            </div>
            <div class="col-2">
            </div>
            <div class="col-5">
              <label for="mission-date" class="form-label">Contact number:</label>
              <input type="text" class="form-control" id="mission-contact" name="contact"/>
            </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="mission-text" class="form-label">text:</label>
            <textarea
              class="form-control"
              id="mission-text"
              rows="10"
              placeholder="If have any requirements, please write at here also. thanks!"
              name="text"
            ></textarea>
          </div>
          <div class="mt-5">
            <label for="post-image" class="form-label">Image</label>
            <input type="file" name="image" id="post-image" />
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Add</button>
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