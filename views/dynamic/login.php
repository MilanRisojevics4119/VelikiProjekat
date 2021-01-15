<?php
if (!isset($_GET['page'])) {
  header("Location:  ../index.php?error=invalidAccessMethodLogin");
  exit();
}
?>

<section class="register">
  <div class="container">
    <div class="text-holder">
      <h1>Come Join the Fun</h1>
      <p>Login and see what your friends have been up to</p>
    </div>

    <div class="form-holder mt-5">
      <form action="models/User.php" method="POST">
        <div class="form-group">
          <input class="form-control" type="text" placeholder="Username" name="username">
        </div>
        <div class="form-group">
          <input class="form-control" type="password" placeholder="Password" name="password">
        </div>
        <div class="form-group">
          <input class="form-control" type="submit" name="login">
        </div>
      </form>
    </div>
  </div>

  <div class="container-fluid register-games">

  </div>
</section>