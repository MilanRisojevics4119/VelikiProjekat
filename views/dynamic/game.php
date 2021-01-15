<?php
  if (!isset($_GET['page'])) {
    header("Location: ../index.php?error=invalidAccessMethodGame");
    exit();
  }
  include_once 'models/Game.php';
  include_once 'helpers/excerpt.php';
  $gameId = $_GET['gameId'];
  $games = Game::show($gameId);
?>

<section class="game-section container-fluid">
  <div class="game card d-flex">
    <a href="?page=game&gameId=<?php echo $games->id ?>">
      <div class="game-image">
        <img src="<?php echo $games->image ?>" class="mainImage" alt="game">
        <img src="<?php echo $games->icon ?>" class='icon' alt="icon">
      </div>
    </a>
    <div class="game-description">
      <?php echo 200, $games->description; ?>
    </div>

    <div class="game-info">
      <div class="name">
        <?php echo $games->name ?>
      </div>

      <div class="genre">
        <?php echo $games->genre ?>
      </div>
      <div class="categories">
        
      </div>

      <div class="add-to-favorites btn btn-custom">
        Add to whislist
      </div>

      <div class="add-to-favorites btn btn-custom">
        Order game
      </div>
    </div>

    <div class="metadata">
      <div class="studio">
        <?php echo $games->studio ?>
      </div>
      <div class="platforms">
        <?php echo $games->platforms ?>
      </div>
      <div class="specs">
        <?php echo $games->specs ?>
      </div>
    </div>
  </div>
</section>