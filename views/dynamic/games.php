<?php
  if (!isset($_GET['page'])) {
    header("Location:  ../index.php?error=invalidAccessMethodGames");
    exit();
  }
  include_once 'models/Game.php';
  include_once 'helpers/excerpt.php';
  $games = Game::show();
?>

<section class="games">
  <div class="">
    <div class="featured-tab">
      <h3>Featured</h3>
    </div>
    <div class="games-holder container-fluid d-flex">
    <?php
      foreach($games as $game) {
        ?>
          <div class="game card d-flex">
            <a href="?page=game&gameId=<?php echo $game->id ?>">
              <div class="game-image">
                <img src="<?php echo $game->image ?>" class="mainImage" alt="game">
                <img src="<?php echo $game->icon ?>" class='icon' alt="icon">
              </div>
            </a>
            <div class="pl-4 d-flex flex-column game-description">
             <p class="mt-5">Description: </p> <p><?php echo excerpt(200, $game->description) ?></p>
            </div>

            <div class="pl-4 game-info">
              <div class="pt-2 name">
                Name: <?php echo $game->name ?>
              </div>

              <div class="pt-2 genre">
                Genre: <?php echo $game->genre ?>
              </div>
              <div class="pt-2 categories">          
              </div>
            </div>

            <div class="p-4 metadata">
              <div class="studio pb-2">
                Game Studio(s): <?php echo $game->studio ?>
              </div>
              <div class="platforms pb-2">
                Platforms: <?php echo $game->platforms ?>
              </div>
              <div class="specs d-flex flex-column pb-2">
              <p class="mt-5">Specifications: </p><p><?php echo $game->specs ?></p>
              </div>

              <div class="pt-2 mr-5 btn btn-custom add-to-favorites">
                Add to whislist
              </div>

              <div class="pt-2 ml-5 btn btn-custom add-to-order">
                Order game
              </div>
            </div>
          </div>
        <?php
      }
    ?>
    </div>
    <div class="categories-main">
      <h3>Categories</h3>
      <div class="category-holder d-flex">
        <div class="category">
          <a href="#">Action</a>
        </div>
      </div>
    </div>
  </div>
</section>