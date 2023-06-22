<?php
if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

$results = Result::getResultByUserRole();
require "parts/header.php";

?>
    <link rel="stylesheet" href="css/results.css">
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Result</h1>
      </div>
      <div class="card mb-2 p-4">
      <?php require "parts/success.php"; ?>
      <?php require "parts/error.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Title</th>
              <th scope="col">Created By</th>
              <th scope="col">Done By</th>
              <th scope="col" class="text-end" style="width: 28%;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($results as $result) : ?>
            <tr>
              <th scope="row"><?= $result['id']; ?></th>
              <td><?= $result['title']; ?></td>
              <td><?= $result['user_name']; ?></td>
              <td><?= $result['done_by']; ?></td>
              <td class="text-end">
                <div class="buttons">
                  <a
                    href="/home_results?id=<?= $result['id']; ?>"
                    target="_blank"
                    class="btn btn-primary btn-sm me-1 "
                    ><i class="bi bi-eye"></i
                  ></a>
                  <a
                    href="/manage-results-edit?id=<?= $result['id']; ?>"
                    class="btn btn-secondary btn-sm me-1"
                    ><i class="bi bi-pencil"></i
                  ></a>

                </div>
              </td>
            </tr>
           
          <?php endforeach ?>
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i>Back</a
        >
      </div>
    </div>

<?php
  require "parts/footer.php";

            