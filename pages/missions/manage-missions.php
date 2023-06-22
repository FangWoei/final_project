<?php

if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

$missions = Mission::getmissionsByUserRole();

  require "parts/header.php";

?>
    <link rel="stylesheet" href="css/mission.css">
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Job</h1>
        <div class="text-end">
          <a href="/manage-missions-add" class="btn btn-primary btn-sm"
            >Add New Job</a
          >
        </div>
      </div>
      <div class="card mb-2 p-4">
      <?php require "parts/success.php"; ?>
      <?php require "parts/error.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col" style="width: 15%;">Title</th>
              <th scope="col">Created By</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($missions as $mission) { ?>
            <tr class="<?php
                if ( 
                  isset( $_SESSION['new_mission'] ) && 
                  $_SESSION['new_mission'] == $mission['title'] ) {
                    echo "table-success";
                    unset( $_SESSION['new_mission'] );
                }
              ?>">
              <th scope="row"><?= $mission['id'] ?></th>
              <td><?= $mission['title'] ?></td>
              <td><?= $mission['user_name']; ?></td>
              <td><span class="<?php 
                if($mission["status"] == "pending"){
                  echo "badge bg-warning";
                } else if($mission["status"] == "publish"){
                  echo "badge bg-success";
                }
                ?>">
                <?= $mission['status']; ?>
              </span></td>
              
              <td class="text-end">
                <div class="buttons">
                  <a
                    href="/missions?id=<?= $mission['id']; ?>"
                    target="_blank"
                    class="btn btn-primary btn-sm me-2 
                    <?php 
                    if($mission["status"] == "pending"){
                      echo "disabled";
                    }else if($mission["status"] == "publish"){
                      echo " ";
                    }
                    ?>"
                    ><i class="bi bi-eye"></i
                  ></a>
                  <a
                    href="/manage-missions-edit?id=<?= $mission['id']; ?>"
                    class="btn btn-secondary btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>

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

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $mission['id']; ?>">
                    <i class="bi bi-trash"></i
                    >
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="delete-modal-<?= $mission['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this job: <?= $mission['title']; ?>?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                          You're currently deleting <?= $mission['title']; ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>


                          <form method="POST" action="/missions/delete">
                            <input type="hidden" name="id" value="<?= $mission['id']; ?>"/>
                            <button type="submit" class="btn btn-danger">Yes, please delete</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </td>
            </tr>
           
          <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a href="/home_missions" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i>Back</a
        >
      </div>
    </div>

    <?php

require "parts/footer.php";

?>