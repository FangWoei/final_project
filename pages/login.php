<?php

require "parts/header.php";

?>
<style>
  html {
    height: 100%;
}
body {
    margin:0;
    padding:0;
    font-family: sans-serif;
    background: linear-gradient(#141e30, #243b55);
}
</style>
<link rel="stylesheet" href="css/login.css">


<div id="login">
  <div class="container">
  <div class="row">
    <div class="login-box" >
      <h2>Login</h2>
      <?php require "parts/error.php"; ?>
      <form 
      action="/auth/login" method="POST"
      >
        <div class="user-box">
        <input
        type="text"
        class="form-control"
        id="email"
        placeholder="email@example.com"
        name="email"
        >
        <label>Email</label>
      </div>
      <div class="user-box">
        <input
        type="password"
        class="form-control"
        id="password"
        placeholder="Password"
        name="password"
        >
        <label>Password</label>
      </div>
      <button type="submit" class="btn w-100">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Login
      </button>
        <a href="/signup" class="text-decoration-none small d-flex justify-content-end mt-5"
          >Don't have an account? Sign up here
          <i class="bi bi-arrow-right-circle"></i
        ></a>
    </form>
  </div>
</div>
  </div>
</div>
<?php
  require "parts/footer.php";

            