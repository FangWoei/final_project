<?php
if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}


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
        <?php if ( $leave['image'] ) : ?>
        <div class="text-center">
            <img src="uploads/<?= $leave['image']; ?>" class="img-fluid" />
        </div>
        <?php endif; ?>
        <div class="mt-5">
          <h1 class='
          <?php
          if($leave["answer"] == "approve"){
            echo "text-success";
          } else if($leave["answer"] == "reject"){
            echo "text-danger";
          } else if($leave["answer"] == "Select an option"){
            echo "text-secondary";
          }
          ?>'>
            <?= $leave['answer']; ?>
          </h1>
        </div>
        <div class="text-center mt-3">
            <a href="/manage-leaves" class="btn btn-link btn-sm"
            ><i class="bi bi-arrow-left"></i> Back</a
            >
        </div>
    </div>

<?php
  require "parts/footer.php";