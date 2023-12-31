<!DOCTYPE html>
<html>
  <head>
    <title>Company HR System</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <script src="https://unpkg.com/typed.js@2.0.15/dist/typed.umd.js"></script>

  </head>
  <body>
  <?php 
    // only show the act-as-user banner if it's currently acting as
    if ( isset( $_SESSION['original_user'] ) && isset( $_SESSION['user'] ) ) : ?>
    <div class="container  bg-transparent position-relative">
      <div class="alert alert-info text-center">
        <h3>
          You are acting as <?= $_SESSION['user']['name']; ?>
        </h3>
        <form
          method="POST"
          action="users/stop-acting"
          >
          <button type="submit"  class="btn btn-info btn-sm">
            <i class="bi bi-stop-circle"></i> Stop acting as <?= $_SESSION['user']['name']; ?>
          </button>
        </form>
      </div>
    </div>
    <?php endif;