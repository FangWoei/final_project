<?php

if ( !Auth::isUserLoggedIn() ) {
  header("Location: /");
  exit;
}

    $user = User::getUserByID( $_GET['id'] );
  
    require "parts/header.php";
?>
    <link rel="stylesheet" href="css/users.css">

    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit User</h1>
      </div>
      <div class="card mb-2 p-4">
        <form
          method="POST"
          action="/users/edit">
          <?php require "parts/error.php"; ?>
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control disabled" id="name" name="name" value="<?= $user['name']; ?>" disabled/>
              </div>
              <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control disabled" id="email" name="email" value="<?= $user['email']; ?>" disabled />
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role">
              <option value="">Select an option</option>
              <option value="user" <?php
                if ( $user['role'] === 'user' ) {
                  echo 'selected';
                }
              ?>>User</option>
              <option value="customer" <?= $user['role'] === 'customer' ? 'selected' : ''; ?>>Customer</option>
              <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : ''; ?>>Editor</option>
              <option value="admin" <?=  $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
          </div>
          <div class="d-grid">
            <input type="hidden" name="id" value="<?= $user['id']; ?>" />
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-users" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Users</a
        >
      </div>
    </div>

<?php
  require "parts/footer.php";