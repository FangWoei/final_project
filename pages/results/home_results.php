<?php
if ( !Auth::isUserLoggedIn() ) {
    header("Location: /");
    exit;
  }
  
$result = Result:: getResultByID();

require "parts/header.php";
?>
    <link rel="stylesheet" href="css/results.css">
    <div class="container mx-auto my-5" style="max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="h1">Result</h1>
        </div>
        <div class="card mb-2 p-5">
            <div class="row">
            <form method="POST" action="/results/delete">
            <?php if ( $result['image'] ) : ?>
            <div class="text-center">
            <input type="hidden" name="image">
                <img src="uploads/<?= $result['image']; ?>" class="img-fluid" />
            </div>
            <?php endif; ?>
            <div class="col-12 mb-5">
                <h4>Title:</h4>
                <input type="hidden" name="title">
                <?= $result['title']; ?>
            </div>
            <div class="row">
                <div class="col-5 mb-5">
                    <h4>
                        Date Start:
                    </h4>
                    <input type="hidden" name="date_start">
                    <?= $result['date_start']; ?>
                </div>
                <div class="col-2"><h1>To</h1></div>
                <div class="col-5 mb-5">
                    <h4>
                        Date End:
                    </h4>
                    <input type="hidden" name="date_end">
                    <?= $result['date_end']; ?>
                </div>
            </div>
            <div class="row">
            <div class="col-6 mb-5">
                <h4>Cost:</h4>
                <input type="hidden" name="cost">
                <?= $result['cost']; ?>
            </div>
            <div class="col-6 mb-5">
                <h4>Contact:</h4>
                <input type="hidden" name="contact">
                <?= $result['contact']; ?>
            </div>
            </div>

            <div class="col-12 mb-5">
                <h4>Text:</h4>
                <input type="hidden" name="text">
                <?= $result['text']; ?>
            </div>
            <h1>Result</h1>
            <div class="col-6 my-5">
                <h4>Done_by:</h4>
                <?= $result['done_by']; ?>
            </div>
            <div class="col-12 mb-5">
                <h4>results:</h4>
                <?= $result['results']; ?>
            </div>
            <?php if ( $result['results_image'] ) : ?>
            <div class="text-center">
                <img src="uploads/<?= $result['results_image']; ?>" class="img-fluid" />
            </div>
            <?php endif; ?>
        </div>
    
    </div>
    </div>

        <div class="text-center mt-3">
            <a href="/manage-results" class="btn btn-link btn-sm"
            ><i class="bi bi-arrow-left"></i> Back</a
            >
        </div>
    </div>

    <?php

require "parts/footer.php";