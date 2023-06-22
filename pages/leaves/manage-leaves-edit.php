<?php
if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}


$leave = Leave::getLeaveByID( $_GET['id'] );
require "parts/header.php";

?>
    <link rel="stylesheet" href="css/leaves.css">

    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Leaves</h1>
      </div>
      <div class="card mb-2 p-4">
      <?php require "parts/error.php"; ?>
        <form
        method="POST"
        action="/leaves/edit"
        enctype="multipart/form-data">
          <div class="mb-3">
            <label for="leaves-name" class="form-label">Name</label>
            <input
              type="text"
              class="form-control"
              id="leaves-name"
              name="name"
              value="<?= $leave['name']; ?>"
            />
          </div>
          <div class="mb-3">
            <div class="row">
            <div class="col-5">
              <label for="leaves-date" class="form-label">Start:</label>
              <input type="text" class="form-control" id="leaves-date" name="date_start" value="<?= $leave['date_start']; ?>"/>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
              <h1>To</h1>
            </div>
            <div class="col-5">
              <label for="leaves-date" class="form-label">End:</label>
              <input type="text" class="form-control" id="leaves-date" name="date_end" value="<?= $leave['date_end']; ?>"/>
            </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="leaves-reason" class="form-label">Reason</label>
            <select class="form-control" id="reason" name="reason">
              <option value="sick" <?= $leave['reason'] === 'sick' ? 'selected' : ''; ?>>Sick Leaves</option>
              <option value="personal" <?= $leave['reason'] === 'personal' ? 'selected' : ''; ?>>Personal Leaves</option>
              <option value="bereavement" <?= $leave['reason'] === 'bereavement' ? 'selected' : ''; ?>>Bereavement Leaves</option>
              <option value="others" <?= $leave['reason'] === 'others' ? 'selected' : ''; ?>>Others</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="leaves-reasons" class="form-label" >Reasons</label>
            <textarea
              class="form-control"
              id="leaves-reasons"
              rows="10"
              name="reasons"
            ><?= $leave['reasons']; ?></textarea>
          </div>
          <div class="mb-3">
            <label for="leave-image" class="form-label">Image</label>
            <input type="file" name="image" id="leave-image" />
            <?php if ( $leave['image'] ) : ?>
              <input type="hidden" name="original_image" value="<?= $leave['image']; ?>" />
              <p><img src="uploads/<?= $leave['image']; ?>" width="150px" /></p>
            <?php endif; ?>
          </div>

          <div class="text-end">
          <input type="hidden" name="id" value="<?= $leave['id']; ?>" />
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-leaves" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>
<?php

require "parts/footer.php";

?>