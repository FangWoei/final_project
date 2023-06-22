<?php

if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

$mission = Mission::getMissionByID();
require "parts/header.php";

?>
    <link rel="stylesheet" href="css/mission.css">
    <div class="container mx-auto my-5" style="max-width: 500px;">
        <h1 class="h1 mb-4 text-center"><?= $mission['title']; ?></h1>
        <div class="mb-3">
            <div class="row">
            <div class="col-5">
              <h4>Start:</h4>
              <?= $mission['date_start']; ?>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
              <h1>To</h1>
            </div>
            <div class="col-5">
            <h4>End:</h4>
              <?= $mission['date_end']; ?>             
            </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
            <div class="col-5">
            <h4>Price($):</h4>
            <?= $mission['cost']; ?>
            </div>
            <div class="col-2">
            </div>
            <div class="col-5">
            <h4>Contact number</h4>
              <?= $mission['contact']; ?>
            </div>
          </div>
          <h4>Text</h4>
        <?php  
            echo nl2br( $mission['text'] );
        ?>
         <?php if ( $mission['image'] ) : ?>
        <div class="text-center">
            <img src="uploads/<?= $mission['image']; ?>" class="img-fluid" />
        </div>
        <?php endif; ?>
        <?php if(Auth::isAdmin() || Auth::isEditor() || Auth::isUser()) : ?>
        <a
          href="/results?id=<?= $mission['id']; ?>"
          class="btn btn-success btn-sm me-2
          <?php 
          if($mission["status"] == "pending"){
            echo "disabled";
          }else if($mission["status"] == "publish"){
            echo " ";
          }
          ?>"
          ><i class="bi bi-journal-check"></i></a>
          <?php endif ?>

        <!-- Chat -->
        <div class="mt-3">
            <?php if ( Auth::isUserLoggedIn()) : ?>
            <h4>Chat</h4>
            <?php
                $chats = Chat_M::getChat_MByMissionID($mission['id']);
            ?>
                <?php
                foreach ($chats as $chat) :
                ?>
            <div class="card mt-2 <?php echo ( $chat["user_id"] === $_SESSION['user']['id'] ? "text-end" : '' ); ?>">
                <div class="card-body">
                  <p class="card-text"><small class="text-muted" style="font-size: 10px;" >chated By (<?= $chat['role']; ?>)<?= $chat['name']; ?></small></p>
                  <p class="card-text"><?= $chat['chat']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
            <?php if ( Auth::isUserLoggedIn() ) : ?>
            <form
                action="/chats/add"
                method="POST"    
                >
                <div class="mt-3">
                    <label for="chats" class="form-label">Enter your chat below:</label>
                    <textarea class="form-control" id="chats" rows="3" name="chat"></textarea>
                </div>
                <input type="hidden" name="mission_id" value="<?= $mission['id']; ?>" />
                <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>" />
                <button type="submit" class="btn btn-primary mt-2">Send</button>
            </form>
            <?php endif; ?>
        </div>

        <div class="text-center mt-3">
            <a href="/home_missions" class="btn btn-link btn-sm"
            ><i class="bi bi-arrow-left"></i> Back</a
            >
        </div>
    </div>

<?php
  require "parts/footer.php";