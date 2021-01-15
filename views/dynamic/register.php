<?php
if (!isset($_GET['page'])) {
  header("Location:  ../index.php?error=invalidAccessMethodRegister");
  exit();
}
?>
<section class="register">
  <div class="container p-5">
    <div class="text-holder">
      <h1>Come Join the Fun</h1>
      <p>Register, and start writing your first post</p>
    </div>

    <div class="form-holder mt-5">
      <form action="models/User.php" method="POST">
        <div class="form-group">
          <input class="form-control" type="text" placeholder="First Name" name="first_name">
        </div>
        <div class="form-group">
          <input class="form-control" type="email" placeholder="Email" name="email"></div>
        <div class="form-group">        
          <input class="form-control" type="password" placeholder="Password" name="password">
        </div>
        <div class="form-group">
          <input class="form-control" type="password" placeholder="Confirm Password" name="passwordConf"></div>
        <div class="form-group">
          <input class="form-control" type="text" placeholder="Username" name="username"></div>
        <div class="form-group">
          <input class="form-control" type="submit" name="register">
        </div>
      </form>
    </div>
  </div>
</section>