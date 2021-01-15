<?php
  require_once 'models/User.php';
  require_once 'models/Game.php';
  $users = User::getAllUsers();
  $games = Game::show();
?>

<div class="users-info">
  <h1>All Users</h1>
  <div class="users-table">
    <div class="heading-tab">
      <p>Id</p>
      <p>Name</p>
      <p>Email</p>
      <p>Role Id</p>
      <p>Username</p>
      <p>Actions</p>
    </div>
    <div class="user-tab">
      <?php 
        foreach($users as $user) {
      ?>
        <div class="user-div">
          <p><?php echo $user->id; ?></p>
          <p><?php echo $user->name; ?></p>
          <p><?php echo $user->email; ?></p>
          <p><?php echo $user->role_id; ?></p>
          <p><?php echo $user->username; ?></p>
          <div class="actions">
          <a href="index.php?page=userEdit&id=<?php echo $user->id ?>">Edit</a>
          <div class="delete">
            <form action="models/User.php" method="POST">
              <input type="hidden" name="user_id" value="<?php echo $user->id ?>">
              <input type="submit" name="deleteUser" value="Delete">
            </form>
          </div>
          </div>
        </div>
        <?php
        }
      ?>
    </div>
    <div class="games-table">
      <div class="heading-tab">
        <p>Id</p>
        <p>Name</p>
        <p>Studio</p>
        <p>Genre</p>
        <p>Price</p>
        <p>Actions</p>
      </div>   
      <div class="games-tab">
        <?php 
          foreach($games as $game) {
        ?>
        <div class="game-div">
          <p><?php echo $user->id; ?></p>
          <p><?php echo $game->name; ?></p>
          <p><?php echo $game->studio; ?></p>
          <p><?php echo $game->genre; ?></p>
          <p><?php echo $game->price; ?></p>
          <div class="actions">
            <a href="index.php?page=gameEdit&id=<?php echo $game->id ?>">Edit</a>
            <div class="delete">
              <form action="models/Game.php" method="POST">
                <input type="hidden" name="game_id" value="<?php echo $game->id ?>">
                <input type="submit" name="deleteGame" value="Delete">
              </form>
            </div>
          </div>
        </div>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</div>