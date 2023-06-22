<?php
if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

$result = Result::getResultByID( $_GET['id'] );

require "parts/header.php";

?>
  <link rel="stylesheet" href="css/results.css">
  <div id="head">
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Result Edit</h1>
      </div>
      <div class="card mb-2 p-3">
      <?php require "parts/error.php"; ?>
        <?php require "parts/success.php"; ?>
          <form
          method="POST"
          action="results/edit"
          enctype="multipart/form-data"
          >
          <div class="row">
            <?php if ( $result['image'] ) : ?>
            <div class="text-center">
                <img src="uploads/<?= $result['image']; ?>" class="img-fluid" />
            </div>
            
            <?php endif; ?>
            <div class="col-12 mb-5">
                <h4>Title:</h4>
                <?= $result['title']; ?>
                </div>
            
            <div class="col-5 mb-5">
                <h4>
                    Date Start:
                </h4>
                <?= $result['date_start']; ?>
                </div>
            
            <div class="col-2"><h1>To</h1></div>
            <div class="col-5 mb-5">
                <h4>
                    Date End:
                </h4>
                <?= $result['date_end']; ?>
                </div>
            
            <div class="col-6 mb-5">
                <h4>Cost:</h4>
                <?= $result['cost']; ?>
                </div>
            
            <div class="col-6 mb-5">
                <h4>Contact:</h4>
                <?= $result['contact']; ?>
                </div>
            
            <div class="col-12 mb-5">
                <h4>Text:</h4>
                <?= $result['text']; ?>
                </div>
            
            
          <h1 class="h1">Result</h1>
          <div class="mb-3">
          <div class="col-5">
              <label for="result-date" class="form-label">Done By:</label>
              <input type="text" class="form-control" id="result" placeholder="@gmail.com" value="<?= $result['done_by'] ?>" name="done_by" />
        </div>
        </div>
            
          
            <div class="mb-3">
              <label for="result" class="form-label">Result:</label>
              <textarea class="form-control" id="result-text" rows="10" name="results"><?= $result['results'] ?></textarea>
              </div>
            
            <div class="mt-3">
            <label for="post-image" class="form-label">Image</label>
            <input type="file" name="results_image" id="post-image" />
            <?php if ( $result['results_image'] ) : ?>
              <input type="hidden" name="answer_image" value="<?= $result['results_image']; ?>" />
              <p><img src="uploads/<?= $result['results_image']; ?>" width="150px" /></p>
            <?php endif; ?>
            </div>
          

            <div class="text-end">
              <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button type="submit" class="btn btn-primary">Edit</button>
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

  