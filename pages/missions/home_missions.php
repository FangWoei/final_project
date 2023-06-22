<?php

if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

  $keyword = isset( $_GET["keyword"] ) ? $_GET["keyword"] : "";
    $database = new DB();
    $missions = $database->fetchAll(
    "SELECT * FROM missions
    WHERE status = 'publish' AND text like '%$keyword%'
    ORDER BY id DESC"
  );

  require "parts/header.php";
?>
    <link rel="stylesheet" href="css/missions.css">

    <div class="container mx-auto my-5" style="max-width: 500px;">
    <?php if(Auth::isAdmin() || Auth::isEditor() || Auth::isCustomer()) : ?>
  <div class="mt-5 d-flex justify-content-end align-items-end">
    <a href="/manage-missions" class="btn btn-primary btn-sm">Manage-Job</a>
  </div>
  <?php endif ?>

      <h1 class="h1 mb-4 text-center">Job Department</h1>

      <form
        action=""
        method="GET"
        class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" name="keyword" value="<?= $keyword; ?>">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

      <?php foreach ($missions as $mission) : ?>
      <div class="card my-3">
        <div class="card-body">
          <h5 class="card-title"><?= $mission['title']; ?></h5>
          <p class="card-text"><?php 
            // $excerpt = str_split( $mission['tent'], 100 );
            // echo $excerpt[0]; ?>
          </p>
          <div class="text-end">
            <a href="/missions?id=<?= $mission['id']; ?>" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
    <div class="mt-4 d-flex justify-content-center gap-3">
      <a href="/dashboard" class='m-2 text-decoration-none'>Back</a>
    </div>

<?php
    require 'parts/footer.php';
