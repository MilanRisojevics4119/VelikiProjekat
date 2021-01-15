<?php
function printHeader($result)
{
  echo '  <nav class="navbar navbar-expand-lg">';
  foreach ($result as $rows) {
    if ($rows->rank == 3) {
      echo "<a class='navbar-brand' href=" . $rows->link . "><img src='public/images/logo.png' alt='logo' class='logoImg navbar-brand'></a>";
    }
  }
  echo '</div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 mainUl" id="mainUl">';
  foreach ($result as $rows) {
    if(isset($_SESSION['role_id'])) {
      if($_SESSION['role_id'] == 1) {
        if ($rows->rank == 6) {
          echo "<li class='nav-item'><a class='nav-link' href=" . $rows->link . ">" . $rows->name . "</a></li>";
        }
      }
    }
    if ($rows->rank == 1) {
      echo "<li class='nav-item'><a class='nav-link' href=" . $rows->link . ">" . $rows->name . "</a></li>";
    }
  }
  foreach ($result as $rows) {
    if ($rows->rank == 2) {
      echo "<li class='nav-item'><a class='nav-link' href='" . $rows->link . "' id=" . $rows->name . ">" . $rows->name . "</a></li>";
    }
  }
  echo '</ul>';

  echo '<ul class="mainUl navbar-nav mt-2 mt-lg-0">';
  foreach ($result as $rows) {
    if ($rows->rank == 5) {
      if(isset($_SESSION['user_id']) == false && $rows->name == "Log In") {
        echo "<li class='nav-item'><a class='nav-link' href='" . $rows->link . "' id=" . $rows->name . ">" . $rows->name . "</a></li>";
      }
      if(isset($_SESSION['user_id']) == false && $rows->name == "Register") {
        echo "<li class='nav-item'><a class='nav-link' href='" . $rows->link . "' id=" . $rows->name . ">" . $rows->name . "</a></li>";
      }


      if(isset($_SESSION['user_id']) == true && $rows->name == "Dashboard"){
        echo "<li class='nav-item'><a class='nav-link' href='" . $rows->link . "' id=" . $rows->name . ">" . $rows->name . "</a></li>";
      }
      if(isset($_SESSION['user_id']) == true && $rows->name == "Logout"){
        echo "<li class='nav-item'><a class='nav-link' href='" . $rows->link . "' id=" . $rows->name . ">" . $rows->name . "</a></li>";
      }
    }
  }
  echo '</ul>';
  if (isset($_SESSION['user_id'])) {
    foreach ($result as $rows) {
      if ($rows->rank == 4) {
        echo "<a class='nav-link' href='" . $rows->link . "'><img src = '" . $_SESSION['user_image'] . "' alt = 'profile" . $_SESSION['user_id'] . "' id='userImg'/></a>";
      }
    }
  }
  
  echo '</div></div></nav>';
  echo '</div>
  </div>
  ';
}