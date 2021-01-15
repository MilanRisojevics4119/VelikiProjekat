<?php

require_once "views/static/header.php";

//Pages logic
?>

<div class="main">
  <?php
  if (isset($_GET['page'])) {
    if ($_GET['page'] == 'login') {
      include_once "views/dynamic/login.php";
    } else if ($_GET['page'] == 'logout') {
      include_once "views/dynamic/logout.php";
    } else if ($_GET['page'] == 'register') {
      include_once "views/dynamic/register.php";
    } else if ($_GET['page'] == 'admin') {
      include_once "views/dynamic/admin.php";
    } else if ($_GET['page'] == 'poll') {
      include_once "views/dynamic/poll.php";
    } else if ($_GET['page'] == 'contact') {
      include_once "views/dynamic/contact.php";
    } else if ($_GET['page'] == 'games') {
      include_once "views/dynamic/games.php";
    } else if ($_GET['page'] == 'dashboard') {
      include_once "views/dynamic/dashboard.php";
    }else if ($_GET['page'] == 'game') {
      include_once "views/dynamic/game.php";
    }else if ($_GET['page'] == 'gameEdit') {
      include_once "views/dynamic/gameEdit.php";
    }else if ($_GET['page'] == 'userEdit') {
      include_once "views/dynamic/userEdit.php";
    }else {
      include_once "views/404.php";
    }
  } else {
    include_once "views/dynamic/home.php";
  }
  ?>
</div>

<?php
require_once "views/static/footer.php";
