<?php
require_once 'helpers/auth.php';
$userIdSession = $_SESSION['user_id'];
$userIdGet = $_GET['id'];
$role = $_SESSION['role_id'];
if(!isAllowed($userIdSession, $userIdGet, $role)) {
  header('Location: index.php?page=home&error=notAllowed');
}

require_once 'models/User.php';
$user = User::getUser($userIdGet);
?>

<section class="user-edit container mt-5 mb-5">
  <form action="models/User.php" method="POST">
    <div class="form-group">
    <label for="name">User Name</label>
      <input type="text" class="form-control" name="name" value="<?php echo $user->name; ?>">
      <input type="hidden" name="id" value="<?php echo $user->id; ?>">
    </div>
    <div class="form-group">
    <label for="email">User Email</label>
      <input type="text" class="form-control" name="email" value="<?php echo $user->email; ?>">
    </div>
    <div class="form-group">
    <label for="username">Username</label>
      <input type="text" class="form-control" name="username" value="<?php echo $user->username; ?>">
    </div>
    <div class="form-group">
    <label for="role_id">Role Id</label>
      <input min="0" max="1" type="number" class="form-control" name="role_id" value="<?php echo $user->role_id; ?>">
    </div>
    <div class="form-group">
    <label for="description">Description</label>
      <input type="text" class="form-control" name="description" value="<?php echo $user->description; ?>">
    </div>

    <div class="form-group mt-5">
      <input type="submit" class="form-control" name="editMaster" value="Edit User">
    </div>
  </form>
</section>