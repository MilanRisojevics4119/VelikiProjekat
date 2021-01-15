<?php
  function isAllowed($userId, $userGetId, $userRole = 0) {
    if($userRole == 1) return true;
    if($userId == $userGetId) return true;
  }

  function isAllowedGame($userRole = 0) {
    if($userRole == 1) return true;
  }
?>