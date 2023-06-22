<?php
if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

$result = Result::getResultfromMission( $_GET['id'] );

require "parts/header.php";

?>
  <link rel="stylesheet" href="css/results.css">
  <div id="head">
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Result</h1>
      </div>
      <div class="card mb-2 p-3">
      <?php require "parts/error.php"; ?>
        <?php require "parts/success.php"; ?>
          <form
          method="POST"
          action="results/add"
          enctype="multipart/form-data"
          >
          <div class="row">
            <div class="text-center head">
            <?php if ( $result['image'] ) : ?>
            <input type="hidden" class="form-control" name="image"  />
              <img src="uploads/<?= $result['image']; ?>"  class="img-fluid"/>
            <?php endif ?>  
            </div>
            <div class="mb-3">
            <label for="result-title" class="form-label">Title</label>
            <input type="hidden" class="form-control" name="title"/>
            <input
              type="text"
              class="form-control"
              id="result-title"
              name="title"
              
              value="<?= $result['title']; ?>"
            />
          </div>
        
          <div class="row">
            <div class="col-5">
              <label for="result-date" class="form-label">Start:</label>
            <input type="hidden" class="form-control" name="date_start"/>
              <input type="date" class="form-control" id="result-date" name="date_start"  value="<?= $result['date_start']; ?>"/>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
              <h1>To</h1>
            </div>
            <div class="col-5">
              <label for="result-date" class="form-label">End:</label>
            <input type="hidden" class="form-control" name="date_end"/>
              <input type="date" class="form-control" id="result-date" name="date_end"  value="<?= $result['date_end']; ?>"/>
            </div>
            </div>
          </div>
            
          <div class="mb-3">
            <div class="row">
            <div class="col-6">
              <label for="result-date" class="form-label">Price($):</label>
            <input type="hidden" class="form-control" name="cost"/>
              <input type="text" class="form-control" id="result-text" name="cost"  value="<?= $result['cost']; ?>"/>
            </div>
            <div class="col-6">
              <label for="result-date" class="form-label">Contact number:</label>
            <input type="hidden" class="form-control" name="contact"/>
              <input type="text" class="form-control" id="result-contact" name="contact"  value="<?= $result['contact']; ?>"/>
            </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="result-content" class="form-label">text</label>
            <textarea
              class="form-control"
              id="result-text"
              rows="10"
              name="text" 
              
            ><?= $result['text']; ?></textarea>
          </div>
            
          <h1 class="h1">Result</h1>
          <div class="mb-3">
          <div class="col-5">
              <label for="result-date" class="form-label">Done By:</label>
              <input type="text" class="form-control" id="result" placeholder="@gmail.com" name="done_by" />
            </div>
          </div>
            <div class="mb-3">
              <label for="result" class="form-label">Result:</label>
              <textarea class="form-control" id="result-text" rows="10" name="results"></textarea>
            </div>
            <div class="mt-5">
              <label for="results_image" class="form-label">Image</label>
              <input type="file" name="results_image" id="results_image" />
            </div>

            <div class="text-end">
              <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
          </div>
        </div>
      </div>
    </div>
    
  </form>
    
    <div class="text-center">
      <a href="/manage-results" class="btn btn-link btn-sm"
      ><i class="bi bi-arrow-left"></i> Back</a
      >
    </div>
    <?php
  require "parts/footer.php";

  