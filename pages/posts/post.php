<?php

if ( !Auth::isUserLoggedIn() ) {
    header("Location: /");
    exit;
  }

    $post = Post::getPostByID();
    
    require "parts/header.php";
?>
    <link rel="stylesheet" href="css/post.css">
    <div class="container mx-auto my-5" style="max-width: 500px;">
        <h1 class="h1 mb-4 text-center"><?= $post['title']; ?></h1>
        <?php if ( $post['image'] ) : ?>
        <div class="text-center">
            <img src="uploads/<?= $post['image']; ?>" class="img-fluid" />
        </div>
        <?php endif; ?>
        <?php  
            echo nl2br( $post['content'] );
           
        ?>
        <!-- comments -->
        <div class="mt-3">
            <?php if ( Auth::isUserLoggedIn()) : ?>
            <h4>Comments</h4>
            <?php
                $comments = Comment::getCommentsByPostID( $post['id']);
            ?>
                <?php
                foreach ($comments as $comment) :
                ?>
            <div class="card mt-2 <?php echo ( $comment["user_id"] === $_SESSION['user']['id'] ? "fw-bold" : '' ); ?>">
                <div class="card-body">
                    <p class="card-text"><?= $comment['comments']; ?></p>
                    <p class="card-text"><small class="text-muted" style="font-size: 10px;" >Commented By <?= $comment['name']; ?></small></p>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
            <?php if ( Auth::isUserLoggedIn() ) : ?>
            <form
                action="/comments/add"
                method="POST"    
                >
                <div class="mt-3">
                    <label for="comments" class="form-label">Enter your comment below:</label>
                    <textarea class="form-control" id="comments" rows="3" name="comments"></textarea>
                </div>
                <input type="hidden" name="post_id" value="<?= $post['id']; ?>" />
                <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>" />
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
            <?php endif; ?>
        </div>

        <div class="text-center mt-3">
            <a href="/home_post" class="btn btn-link btn-sm"
            ><i class="bi bi-arrow-left"></i> Back</a
            >
        </div>
    </div>

    <?php

require "parts/footer.php";