<?php

require "parts/header.php";

?>
<link rel="stylesheet" href="css/style.css">

<div id="home" class="d-flex justify-content-center align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="card text-center w-50">
        <div class="card-title">
          <h3>
            Welcome to Forward Company
          </h3>
        </div>
        <div class="card-body">
        <p class="fs-3"><span class="auto-type"></span></p>
          <a href="/login" class="btn btn-primary">Login</a>
          <a href="/signup" class="btn btn-primary">SignUp</a>
        </div>
      </div>
      </div>
    </div>
</div>





<script>
  var typed = new Typed(".auto-type",{
    strings: [" Life is like a box of chocolates, you never know what you are going to get." ,"You must always have faith in who you are!" ,"The longest day has an end."],
    typeSpeed: 50,
    backSpeed: 50,
    loop: true
    
  })

</script>
<?php
  require "parts/footer.php";

            