<?php
if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}


$leaves = Leave::getLeavesByUserRole();

require "parts/header.php";

?>
<link rel="stylesheet" href="css/leaves.css">
<div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Leaves</h1>
        <div class="text-end">
          <a href="/manage-leaves-add" class="btn btn-primary btn-sm"
            >Add Leaves</a
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
              <th scope="col">Name</th>
              <th scope="col">Created By</th>
              <th scope="col">Answer</th>
              <th scope="col" style="width: 30%"class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($leaves as $leave) { ?>
            <tr class="<?php
                if ( 
                  isset( $_SESSION['new_leave'] ) && 
                  $_SESSION['new_leave'] == $leave['name'] ) {
                    echo "table-success";
                    unset( $_SESSION['new_leave'] );
                }
              ?>">
              <th scope="row"><?= $leave['id'] ?></th>
              <td><?= $leave['name'] ?></td>
              <td><?= $leave['user_email']; ?></td>
              <td><span class="<?php 
                if($leave["answer"] == "approve"){
                  echo "badge bg-success";
                } else if($leave["answer"] == "reject"){
                  echo "badge bg-danger";
                } else if($leave["answer"] == "Select an option"){
                  echo "badge bg-secondary";
                }
                ?>">
                <?= $leave['answer']; ?>
              </span></td>
              
              <td class="text-end">
                <div class="buttons">
                <a
                    href="/leaves?id=<?= $leave['id']; ?>"
                    target="_blank"
                    class="btn btn-primary btn-sm me-2 
                    ?>"
                    ><i class="bi bi-eye"></i
                  ></a>
                  <a
                    href="/manage-leaves-edit?id=<?= $leave['id']; ?>"
                    class="btn btn-secondary btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>
                  
                  <?php if( Auth::isAdmin() ) :?>
                    <a
                    href="/manage-leaves-approve?id=<?= $leave['id']; ?>"
                    class="btn btn-success btn-sm me-2"
                    ><i class="bi bi-ui-checks"></i></a>
                  <?php endif; ?>

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $leave['id']; ?>">
                    <i class="bi bi-trash"></i
                    >
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="delete-modal-<?= $leave['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this form: <?= $leave['name']; ?>?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                          You're currently deleting <?= $leave['name']; ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>


                          <form method="POST" action="/leaves/delete">
                            <input type="hidden" name="id" value="<?= $leave['id']; ?>"/>
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
        <a href="/dashboard" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>
<?php
require "parts/footer.php";