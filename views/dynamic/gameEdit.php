<?php
require_once 'helpers/auth.php';
$gameIdGet = $_GET['id'];
$role = $_SESSION['role_id'];
if(!isAllowedGame($role)) {
  header('Location: index.php?page=home&error=notAllowed');
}
require_once 'models/Game.php';
$game = Game::show($gameIdGet);
?>


<section class="user-edit container mt-5 mb-5">
  <form action="models/Game.php" method="POST">
    <div class="form-group">
    <label for="name">Game Name</label>
      <input type="text" class="form-control" name="name" value="<?php echo $game->name; ?>">
      <input type="hidden" name="id" value="<?php echo $game->id; ?>">
    </div>
    <div class="form-group">
    <label for="description">Game Description</label>
      <textarea type="text" class="form-control" name="description"><?php echo $game->description; ?></textarea>
    </div>
    <div class="form-group">
    <label for="specs">Game Specifications</label>
      <textarea type="text" class="form-control" name="specs"><?php echo $game->specs; ?></textarea>
    </div>
    <div class="form-group">
    <label for="genre">Game Genre(s)</label>
      <input type="text" class="form-control" name="genre" value="<?php echo $game->genre; ?>">
    </div>
    <div class="form-group">
    <label for="studio">Game Studio</label>
      <input type="text" class="form-control" name="studio" value="<?php echo $game->studio; ?>">
    </div>
    <div class="form-group">
    <label for="platforms">Game Platforms</label>
      <input type="text" class="form-control" name="platforms" value="<?php echo $game->platforms; ?>">
    </div>
    <div class="form-group">
    <label for="price">Game Price</label>
      <input min="0" type="number" class="form-control" name="price" value="<?php echo $game->price; ?>">
    </div>
    <div class="form-group mt-5">
      <input type="submit" class="form-control" name="editMaster" value="Edit Game">
    </div>
  </form>
</section>