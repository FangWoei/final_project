<?php
if ( !Auth::isUserLoggedIn() ) {
    header("Location: /");
    exit;
  }
  
require "parts/header.php";

?>
<link rel="stylesheet" href="css/dashboard.css">

<style>
    #dashboard{
    background: url(../img/dashboard.jpg);
    height: 120vh;
    background-size: cover;
}
#dashboard .bi{
    font-size: 80px !important;
}
</style>

<div id="dashboard">
<h1 class="text-white text-center pt-3">
    Dashboard
</h1>

    <div class="container pt-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-3 my-3">
                <div class="card text-center">
                    <i class="bi bi-box2-fill fs-1 pt-4"></i>
                    <h3 class="py-4">Jobs</h3>
                    <div class="text-center mt-3">
                    <a href="/home_missions" class="btn btn-primary btn-sm w-50 mb-3"
                    >Access</a
                    >
                    </div>
                </div>
            </div>

            <div class="col-3 my-3">
                <div class="card text-center">
                <i class="bi bi-envelope-paper fs-1 pt-4"></i>
                    <h3 class="py-4">Results</h3>
                    <div class="text-center mt-3">
                    <a href="/manage-results" class="btn btn-primary btn-sm w-50 mb-3"
                    >Access</a
                    >
                    </div>
                </div>
            </div>

            <?php if(Auth::isAdmin()) : ?>
            <div class="col-3 my-3">
                <div class="card text-center">
                    <i class="bi bi-people fs-1 pt-4"></i>
                    <h3 class="py-4">User</h3>
                    <div class="text-center mt-3">
                    <a href="/manage-users" class="btn btn-primary btn-sm w-50 mb-3"
                    >Access</a
                    >
                    </div>
                </div>
            </div>
            <?php endif ?>
        </div>

        <div class="row d-flex justify-content-center align-items-center">
        <?php if(Auth::isAdmin() || Auth::isEditor() || Auth::isUser()) : ?>
            <div class="col-3 my-3">
                <div class="card text-center">
                    <i class="bi bi-pencil-square fs-1 pt-4"></i>
                    <h3 class="py-4">Posts</h3>
                    <div class="text-center mt-3">
                    <a href="/home_post" class="btn btn-primary btn-sm w-50 mb-3"
                    >Access</a
                    >
                    </div>
                </div>
            </div>
            <?php endif ?>

        <?php if(Auth::isAdmin() || Auth::isEditor() || Auth::isUser()) : ?>
            <div class="col-3 my-3">
                    <div class="card text-center">
                    <i class="bi bi-door-open-fill fs-1 pt-4"></i>
                    <h3 class="py-4">Take Leaves</h3>
                    <div class="text-center mt-3">
                    <a href="/manage-leaves" class="btn btn-primary btn-sm w-50 mb-3"
                    >Access</a
                    >
                    </div>
                </div>
            </div>
            <?php endif ?>

        <?php if(Auth::isAdmin() || Auth::isEditor() || Auth::isUser()) : ?>
            <div class="col-3 my-3">
                <div class="card text-center">
                <i class="bi bi-person-lines-fill fs-1 pt-4"></i>
                    <h3 class="py-4">Profiles</h3>
                    <div class="text-center mt-3">
                    <a href="/manage-profiles" class="btn btn-primary btn-sm w-50 mb-3"
                    >Access</a
                    >
                    </div>
                </div>
            </div>
            <?php endif ?>
        </div>
         <div class="py-5 d-flex justify-content-center">
            <a href="/logout" class="btn btn-danger">LogOut</a>
         </div>
    </div>
</div>



<?php

require "parts/footer.php";

