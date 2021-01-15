<?php
  if (!isset($_GET['page'])) {
    header("Location:  ../index.php?error=invalidAccessMethodDashboard");
    exit();
  } else if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php?page=login&error=notLoggedIn");
    exit();
  }

  require_once 'models/User.php';
?>

<section class="dashboard">
<div class="sidebar-holder">
  <?php
  require_once "views/static/sidebar.php";
  ?>
</div>

<div class="account container ml-auto mr-auto">
  <div class="top">
    <h1>Account Information</h1>
  </div>

  <div class="bottom">
    <div class="first-part">
      <div class="your-info">
        <h1>YOUR INFORMATION</h1>

        <div class="user-info mr-1">
          <div class="row-custom mt-3">
            <p>Name</p> <p><?php echo $_SESSION['name'] ?></p>
          </div>
          <div class="row-custom mt-3">
            <p>Email</p><p><?php echo $_SESSION['user_email'] ?></p>
          </div>
          <div class="row-custom mt-3">
            <p>Username</p><p><?php echo $_SESSION['username'] ?></p>
          </div>
          <div class="row-custom mt-3">
            <p>Description</p><p><?php echo $_SESSION['user_description'] ?></p>
          </div>
        </div>
      </div>

      <div class="account-image ml-5">
        <h1>User Image</h1>
        <img src="<?php echo $_SESSION['user_image']; ?>" alt="user-image">
        <p class="mt-4"><?php echo $_SESSION['username'];?></p>
      </div>
    </div>

    <div class="second-part">
      <div class="game-info">
        <h1>Your Games</h1>

        <div class="games-holder">
            <?php
            $games = User::getUserGames();
            foreach($games as $game) {
              ?>
              <div class="game ml-5"> 
                <?php
                echo $game[0]['name'];
                ?>

              <a href="<?php echo '?page=game&gameId='.$game[0]['id']?>">
                <img src="<?php echo $game[0]['image'] ?>" alt="" srcset="">  
              </a>
              </div>
            <?php 
          }
          ?>
        </div>
      </div>
    </div>

    <div class="turd-part">
      <div class="edit-buttons mt-5">
          <button id="editButton" class="btn-success btn">Edit Your Account</button>
          <button id="cancelButton" class="btn-danger btn">Cancel</button>
      </div>
      <div class="edit-info" id="editAppear">
        <h1>Edit Your Account</h1>
        <div class="info-holder">
          <form action="models/User.php" method="POST" enctype="multipart/form-data">
            <div class="user-info mr-1">
              <div class="row-custom mt-3">
                <p>Upload Your Image: </p><input type="file" class="form-controll-file" name="profileImg"/>
              </div>
              <div class="row-custom last-row mb-3 mt-3">
                <p>Description</p><textarea type="text" name="descChange" class="form-control" value="<?php echo $_SESSION['user_description'] ?>"></textarea>
              </div>
              <input class="btn btn-primary" id="editSubmit" type="submit" name="editUser" value="Submit Your changes">
            </div>
          </form>
        </div>
      </div>
    </div>
      <?php 
        if($_SESSION['role_id'] == 1) {
          ?>
          <div class="admin-part">
          <?php
            require_once "views/dynamic/admin.php";
            ?>
          </div>
          <?php
        }
      ?>
  </div>
</div>
</section>