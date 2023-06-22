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
<link rel="stylesheet" href="css/signup.css">

<div id="signup">
    <div class="signup-box">
      <h2>Sign Up a New Account</h2>
      <?php require "parts/error.php"; ?>
      <form
      action="/auth/signup" method="POST"
      >
      <div class="user-box">
      <input 
          type="text" 
          class="form-control" 
          id="name" 
          name="name" />
        <label>Name</label>
      </div>
      <div class="user-box">
      <input 
          type="email" 
          class="form-control" 
          id="email" 
          name="email" />
        <label>Email</label>
      </div>
      <div class="user-box">
      <input
          type="password"
          class="form-control"
          id="password"
          name="password"/>
        <label>Password</label>
      </div>
      <div class="user-box">
      <input
          type="password"
          class="form-control"
          id="confirm_password"
          name="confirm_password"/>
        <label>Confirm_Password</label>
      </div>
      <button class="btn w-100">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Sign Up
</button>
      <a href="/login" class="text-decoration-none small d-flex justify-content-end mt-5"
          >Don't have an account? Login here
          <i class="bi bi-arrow-right-circle"></i
        ></a>
    </form>
  </div>
</div>
<?php
  require "parts/footer.php";
