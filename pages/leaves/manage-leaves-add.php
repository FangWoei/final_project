<?php

if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

  require "parts/header.php";

?>
    <link rel="stylesheet" href="css/leaves.css">

    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Add New Leaves</h1>
      </div>
      <div class="card mb-2 p-4">
      <?php require "parts/error.php"; ?>
      <form
          method="POST"
          action="/leaves/add"
          enctype="multipart/form-data"
          >
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" />
          </div>
          <div class="mb-3">
            <div class="row">
            <div class="col-5">
              <label for="leaves-date" class="form-label">Start:</label>
              <input type="date" class="form-control" id="leaves-date" name="date_start"/>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
              <h1>To</h1>
            </div>
            <div class="col-5">
              <label for="leaves-date" class="form-label">End:</label>
              <input type="date" class="form-control" id="leaves-date" name="date_end"/>
            </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="leaves-reason" class="form-label">Reason</label>
            <select class="form-control" id="reason" name="reason">
            <option value="">Select an option</option>
            <option value="Sick Leaves">Sick Leaves</option>
            <option value="Personal Leaves">Personal Leaves</option>
            <option value="Bereavement Leaves">Bereavement Leaves</option>
            <option value="others">Others</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="leaves-reasons" class="form-label">Reasons</label>
            <textarea
              class="form-control"
              id="leaves-reasons"
              rows="10"
              name="reasons"
            ></textarea>
          </div>
          <div class="mt-5">
            <label for="leave-image" class="form-label">Image</label>
            <input type="file" name="image" id="leave-image" />
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-primary">Add</button>
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