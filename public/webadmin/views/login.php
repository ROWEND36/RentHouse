<!DOCTYPE html>

<html lang="en">

<head>
  <title> </title>
  <meta charset="UTF-8">
  <meta name="Description" content="Offering training on the modern technologies.">
  <meta name="Keyword" content="Computer, Training, Computer Networking, Cyber Security, Digital Forensic,">
  <meta name="viewport" content="width=device-width scale=1.0">

  <link rel="Stylesheet" href="css/style.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://kit.fontawesome.com/bbd45143cf.js" crossorigin="anonymous"></script>

</head>

<body>


  <!--NAVBAR SECTION-->
  <header>
    <nav class="navbar navbar-expand-lg bg-dark">
      <div class="container-fluid">
        <a href="#" class="navbar-brand ml-3">Eddy<span style="color:#00E8E8">:)sy</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse"></div>
        <div class="collapse navbar-collapse" id="navbarMenu">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="About.html">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Contact.html">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Blog.html">Blog</a>
            </li>
          </ul>

        </div>
      </div>
    </nav>
  </header>

  <div class="container">
    <div class="row justify-content-center text-center m-2 pb-4" id="collapseParent">
      <div class="col-md-4 card collapse <?php if (!isset($signup_mode)) {
        echo " show";
      } ?>" id="login-card" data-parent="#collapseParent">
        <div class="card-body">
          <h4>Login in as Administrator</h4>
          <?php if (isset($login_error)) {
            echo "<span class='text-danger'>" .
              $login_error->getMessage() .
              "</span>";
          } ?>
          <form method="post" action="/webadmin/login.php" class="form-inline justify-content-center mb-4">
            <input type="email" required name="email" id="email" Placeholder="Email" size="40" class="form-control p-2 mx-1 my-2" value="<?php if(array_key_exists("email",$_POST))echo $_POST["email"]?>">
            <input type="password" required name="password" id="password" Placeholder="Password" size="40" minlength=8 class="form-control p-2 mx-1 my-2">
            <input type="submit" value="Login" class="btn btn-danger px-4 py-2">
          </form>
          <span class="">Don't Have An Account? <a class="" data-toggle="collapse" href="#sign-up-card" data-parent="#collapseParent" role="button" aria-expanded="<?php if (
            isset($signup_mode)
          ) {
            echo "true";
          } else {
            echo "false";
          } ?>" aria-controls="sign-up-card">
              Sign up
            </a>
            instead</span><br />
          <span class="">Forgot Password? <a class="" data-toggle="collapse" href="#forgot-password" data-parent="#collapseParent" role="button" aria-expanded="false" aria-controls="forgot-password">
              Recover Password
            </a></span>

        </div>

      </div>


      <div class="card col-md-4 collapse <?php if (isset($signup_mode)) {
        echo " show";
      } ?>" id="sign-up-card" data-parent="#collapseParent">
        <div class="card-body">
          <h4>Sign up as Administrator</h4>
          <?php if (isset($signup_error)) {
            echo "<span id='signup_error' class='text-danger'>" .
              $signup_error->getMessage() .
              "</span>";
          } ?>
          <form method="post" id="signupform" action="/webadmin/signup.php" class="form-inline justify-content-center mb-4">
            <input type="email" required name="email" id="email" Placeholder="Email" size="40" class="form-control p-2 mx-1 my-2" value="<?php if(array_key_exists("email",$_POST))echo $_POST["email"]?>">
            <input type="password" required name="password" id="password" Placeholder="Password" size="40" minlength=8 class="form-control p-2 mx-1 my-2">
            <input type="password" required name="confirmpassword" id="confirmpassword" Placeholder="Repeat Password" size="40" minlength=8 class="form-control p-2 mx-1 my-2">
            <input type="password" required name="secret_key" id="secret_key" Placeholder="Enter Api Key" size="40" minlength=8 class="form-control p-2 mx-1 my-2">

            <input type="submit" value="Sign Up" class="btn btn-danger px-4 py-2">
          </form>
          <span class="">Already Have An Account? <a class="" data-toggle="collapse" href="#login-card" data-parent="#collapseParent" role="button" aria-expanded="<?php if (
            !isset($signup_mode)
          ) {
            echo "true";
          } else {
            echo "false";
          } ?>" aria-controls="login-card">
              Log in
            </a>
            instead</span>

        </div>
      </div>

      <div class="card col-md-4 collapse" id="forgot-password" data-parent="#collapseParent">
        <div class="card-body">
          <span class="text-danger">Note this action can only be done once in 30 minutes</span>
          <form method="post" action="/webadmin/send_password.php" class="form-inline justify-content-center mb-4">
            <input type="email" required name="email" id="email" Placeholder="Email" size="40" class="form-control p-2 mx-1 my-2">
            <input type="submit" value="Send Email" class="btn btn-danger px-4 py-2">
          </form>
          <span class=""><a class="" data-toggle="collapse" href="#login-card" data-parent="#collapseParent" role="button" aria-expanded="<?php if (
            !isset($signup_mode)
          ) {
            echo "true";
          } else {
            echo "false";
          } ?>" aria-controls="login-card">
              Back To Log in
            </a></span>
        </div>
      </div>

    </div>
  </div>

  <footer>
    <div class="section-5 text-center mt-auto">
      <hr>
      <h5 style="color: aquamarine;"> Eddysy Solutions&copy;</h5>
    </div>
  </footer>


  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $("#signupform").submit(function(e){
      var span = $("#signup_error").length;
      var form = $(this);
      if(!span.length){
        span = form.before("<span id='signup_error' class='text-danger'></span>").prev()
      }
      if(form.find("#password").val() != form.find("#confirmpassword").val()){
        span.text("Passwords do not match");
        return false;
      }
    });
  </script>


</body>


</html>