<?php

if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

  $keyword = isset( $_GET["keyword"] ) ? $_GET["keyword"] : "";
    $database = new DB();
    $posts = $database->fetchAll(
    "SELECT * FROM posts 
    WHERE status = 'publish' AND title like '%$keyword%'
    ORDER BY id DESC"
  );

  // $posts = Post::getPublishPosts();

  require "parts/header.php";
?>
    <link rel="stylesheet" href="css/post.css">

    <div class="container mx-auto my-5" style="max-width: 500px;">
    <?php if(Auth::isAdmin() || Auth::isEditor() ) : ?>
  <div class="mt-5 d-flex justify-content-end align-items-end">
    <a href="/manage-posts" class="btn btn-primary btn-sm">Manage-post</a>
  </div>
<?php endif ?>

      <h1 class="h1 mb-4 text-center">Post</h1>

      <form
        action=""
        method="GET"
        class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" name="keyword" value="<?= $keyword; ?>">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

      <?php foreach ($posts as $post) : ?>
      <div class="card my-3">
        <div class="card-body">
          <h5 class="card-title"><?= $post['title']; ?></h5>
          <p class="card-text"><?php 
            $excerpt = str_split( $post['content'], 100 );
            echo $excerpt[0]; ?>
            <a href="/post?id=<?= $post['id']; ?>">... read more</a>
          </p>
          <div class="text-end">
            <a href="/post?id=<?= $post['id']; ?>" class="btn btn-primary btn-sm">Read More</a>
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
