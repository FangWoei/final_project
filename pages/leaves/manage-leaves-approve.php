<?php

$leave = Leave::getLeaveByID();
require "parts/header.php";

?>
    <link rel="stylesheet" href="css/leaves.css">
    <div class="container mx-auto my-5" style="max-width: 500px;">
        <h1 class="h1 mb-4 text-center"><?= $leave['name']; ?></h1>
        <div class="mb-5">
            <div class="row">
            <div class="col-5 mt-5">
              <h4>Start:</h4>
              <?= $leave['date_start']; ?>
            </div>
            <div class="col-2 mt-5 d-flex justify-content-center align-items-center">
              <h1>To</h1>
            </div>
            <div class="col-5 mt-5">
            <h4>End:</h4>
              <?= $leave['date_end']; ?>             
            </div>
            </div>
          </div>
          <h4 class="mt-5">Reason</h4>
              <?= $leave['reason']; ?>
        <?php  
          echo nl2br( $leave['reasons'] );
        ?>
        <div class="mt-5">
          <form
          method="POST"
          action="leaves/approve">
          <label for="leaves-approve" class="form-label">Answer</label>
          <select class="form-control" id="answer" name="answer">
              <option value="">Select an option</option>
              <option value="approve" <?= $leave['answer'] === 'approve' ? 'selected' : ''; ?>>Approve</option>
              <option value="reject" <?= $leave['answer'] === 'reject' ? 'selected' : ''; ?>>Reject</option>
            </select>
            <div class="text-end mt-5">
          <input type="hidden" name="id" value="<?= $leave['id']; ?>" />
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
        </div>
        <div class="text-center mt-3">
            <a href="/manage-leaves" class="btn btn-link btn-sm"
            ><i class="bi bi-arrow-left"></i> Back</a
            >
        </div>
    </div>

<?php
  require "parts/footer.php";