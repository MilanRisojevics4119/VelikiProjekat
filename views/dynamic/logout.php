<?php
if (!isset($_GET['page'])) {
  header("Location:  ../index.php?error=invalidAccessMethodLogout");
  exit();
}
session_start();
session_unset();
session_destroy();

header("Location: index.php?success=loggedOut");
