<?php
if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

$profile = Profile::getProfilesUsers();

  require "parts/header.php";
?>
    <link rel="stylesheet" href="css/profiles.css">

    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Profile</h1>
      </div>
      <div class="card mb-2 p-3">
        <?php require "parts/success.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

              <tr>
              <td scope="row"><?= $profile['id']; ?></td>
              <td><?= $profile['name']; ?></td>
              <td><?= $profile['email']; ?></td>
              <td class="text-end">
                <div class="buttons d-flex justify-cotent-center">
                <a
                    href="/profiles?id=<?= $profile['id']; ?>"
                    target="_blank"
                    class="btn btn-primary btn-sm me-2 
                    ?>"
                    ><i class="bi bi-eye"></i
                  ></a>
                  <a
                    href="/manage-profiles-changepwd?id=<?= $profile['id']; ?>"
                    class="btn btn-warning btn-sm me-2"
                    ><i class="bi bi-key"></i
                  ></a>
                <a
                    href="/manage-profiles-edit?id=<?= $profile['id']; ?>"
                    class="btn btn-success btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>
                </div>
              </td>
            </tr>


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