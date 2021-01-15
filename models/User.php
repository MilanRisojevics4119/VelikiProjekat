<?php
class User {
  function getAllUsers()
  {
    global $conn;
    $query = "SELECT * FROM users";
    return $conn->query($query)->fetchAll();
  }
  
  function getUser($id) {
    global $conn;
    $query= "SELECT * FROM users WHERE id = $id";
    return $conn->query($query)->fetch();
  }

  function registerUser()
  {
    global $conn;
  
    $user_name = $_POST['username'];
    $name = $_POST['first_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwrodConf = $_POST['passwordConf'];
  
  
    if (empty($user_name) || empty($password) || empty($email) || empty($passwrodConf || empty($name))) {
      header("Location: ../index.php?error=emptyfields&" . $user_name . "&mail=" . $email);
  
      exit();
    } else if (!preg_match("/^([a-zA-Z][0-9]{3,16})$/", $user_name) && (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
      header("Location: ../index.php?page=register&error=incorrectfields&" . $user_name . "&mail=" . $email);
      exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../index.php?page=register&error=emptyfields&" . $user_name);
      exit();
    } else if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
      header("Location: ../index.php?page=register&error=incorrectpassword&" . $user_name . "&mail=" . $email);
      exit();
    } else if (!preg_match("/^([a-zA-Z0-9]{3,16})$/", $user_name)) {
      header("Location: ../index.php?page=register&error=emptyusername&&mail=" . $email);
      exit();
    } else if ($password !== $passwrodConf) {
      header("Location: ../index.php?page=register&error=passwordsunmatch&" . $user_name . "&mail=" . $email);
      exit();
    } else {
      $querry = "SELECT username FROM users WHERE username = :username OR email = :email";
      $stat = $conn->prepare($querry);
      if (!$conn->prepare($querry)) {
        header("Location: ../index.php?page=register&error=sqlfailed");
        exit();
      } else {
        $stat->bindParam(":username", $user_name);
        $stat->bindParam(":email", $email);
        $stat->execute();
        $result = $stat->fetch(PDO::FETCH_ASSOC);
        if ($result > 0) {
          header("Location: ../index.php?page=register&error=userexists");
          exit();
        } else {
  
          $querry = "INSERT INTO users (name, email, password, role_id, image, username) VALUES (:uname, :email, :pw, :roleId, :userImage, :username)";
          $stat = $conn->prepare($querry);
          $userImage = "public/images/assets/notset.jpg";
          if (!$conn->prepare($querry)) {
            header("Location: ../index.php?page=register&sqlFail");
            exit();
          } else {
            $roleId = 0;
            $hashPw = password_hash($password, PASSWORD_DEFAULT);
            $stat->bindParam(":uname", $name);
            $stat->bindParam(":email", $email);
            $stat->bindParam(":pw", $hashPw);
            $stat->bindParam(":roleId", $roleId);
            $stat->bindParam(":userImage", $userImage);
            $stat->bindParam(":username", $user_name);
            $stat->execute();
  
  
            header("Location: ../index.php?page=login&register=success");
            exit();
          }
        }
      }
    }
  }

  function getUserGames() {
    if(!isset($_SESSION['user_id'])) {
      header("Location: ../index.php?page=login&error=nouser");
      exit();
    }
    global $conn;
    $userId = $_SESSION['user_id'];

    $query = 'SELECT game_id FROM orders WHERE user_id ='.$userId;
    $res = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);

    $arrayOfGames = [];

    foreach($res as $game) {
      $queryGame = 'SELECT * FROM games WHERE id ='.$game['game_id'];
      $res = $conn->query($queryGame)->fetchAll(PDO::FETCH_ASSOC);
      array_push($arrayOfGames, $res);
    }

    return $arrayOfGames;
  }

  function loginUser()
  {
    global $conn;
  
    $user_name = $_POST['username'];
    $password = $_POST['password'];
  
    if (empty($password) || empty($user_name)) {
      header("Location: ../index.php?page=login&error=emptyfields");
      exit();
    } else {
      $querry = 'SELECT * FROM users WHERE username=:username;';
      $stmt = $conn->prepare($querry);
      if (!$conn->prepare($querry)) {
        header("Location: ../index.php?page=login&statementNotRead1y");
        exit();
      } else {
        $stmt->bindParam(":username", $user_name);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $pwdCheck = password_verify($password, $result["password"]);
        if ($pwdCheck == false) {
          header("Location: ../index.php?page=login&error=wrongPwd");
          exit();
        } else if ($pwdCheck == true) {
          session_start();
          $_SESSION['user_id'] = $result['id'];
          $_SESSION['name'] = $result['name'];
          $_SESSION['user_email'] = $result['email'];
          $_SESSION['username'] = $result['username'];
          $_SESSION['role_id'] = $result['role_id'];
          $_SESSION['user_image'] = $result['image'];
          $_SESSION['user_description'] = $result['description'];
          header("Location: ../index.php?page=dashboard&login=success");
          exit();
        } else {
          header("Location:  ../index.php?page=login&error=godKnowsWhatThisIs");
          exit();
        }
        header("Location: ../index.php?page=login&error=nouser");
        exit();
      }
    }
  }

  function masterEdit() {
    global $conn;
    $name = $_POST['name'];
    $id = $_POST['id'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $roleId = $_POST['role_id'];
    $description = $_POST['description'];

    $sql = "UPDATE users SET description = :desc, name = :name, email = :email, username = :username, role_id = :role_id  WHERE id = :id ;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":desc", $description, PDO::PARAM_STR);
    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":role_id", $roleId);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();
    header("Location: ../index.php?page=dashboard&success=userEdited");
  }

  function editUser() {
    global $conn;
    session_start();
  
    $id = $_SESSION['user_id'];
    $file = $_FILES['profileImg'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $extensionImg = explode('.', $fileName);
    $formated = strtolower(end($extensionImg));
    $alowedFormats = array('jpg', 'png', 'jpeg', 'gif');

    if (in_array($formated, $alowedFormats)) {
      if ($fileSize < 2516000) {
        $newName = "profile" . $id . "." . $formated;
        $fileDest = 'public/images/users/' . $newName;
        $fileDestP = 'public/images/users/' . $newName;
        //These are for deletion
        if ($_SESSION['user_image'] != NULL) {
          $fileToDel = "public/images/users/profile" . $id . "*";
          $fileInfo = glob($fileToDel);
          $fileExt = explode(".", $fileInfo[0]);
          $realExt = strtolower(end($fileExt));
          $file = 'public/images/users/profile' . $id . '.' . $realExt;
          if(is_file($file)) {
            unlink($file);
          }
        }
        //End of deletion
        move_uploaded_file($fileTmpName, $fileDest);
        $sql = "UPDATE users SET image='$fileDestP' WHERE id='$id';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $_SESSION['user_image'] = $fileDestP;

        $desc = $_POST['descChange'];

        $query = "UPDATE users SET description = :descr WHERE id= :id ;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":descr", $desc, PDO::PARAM_STR);

        $stmt->bindParam(":id", $id);
        $stmt->execute();
        header("Location: ../index.php?page=profile&success=success");
        exit();
      } else {
        echo 'Your file is too big!';
        header("Location: ../index.php?page=profile&error=bigFile");
      }
    } else {
      if (!in_array($formated, $alowedFormats)) {
        $desc = $_POST['descChange'];
        $query = "UPDATE users SET description = :descr WHERE id= :id ;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":descr", $desc, PDO::PARAM_STR);

        $stmt->bindParam(":id", $id);
        $stmt->execute();
        header("Location: ../../index.php?page=profile&success=descChanged");
      } else {
        header("Location: ../../index.php?page=profile&error=invalidType");
      }
    }
  }

  function deleteUser() {
    global $conn;
    $userId = $_POST['user_id'];
    session_start();
    if ($userId == $_SESSION['user_id']) {
      header("Location: ../index.php?page=admin&error=notSelf");
    } else {
      $query = "DELETE FROM users WHERE id = :id";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(":id", $userId);
      $stmt->execute();
      header("Location: ../index.php?page=admin");
    }
  }
}

if (isset($_POST['register'])) {
  include_once '../config/connection.php';
  User::registerUser();
} else if (isset($_POST['login'])) {
  include_once '../config/connection.php';
  User::loginUser();
} else if (isset($_POST['editUser'])) {
  include_once '../config/connection.php';
  User::editUser();
} else if (isset($_POST['deleteUser'])) {
  include_once '../config/connection.php';
  User::deleteUser();
} else if (isset($_POST['editMaster'])) {
  include_once '../config/connection.php';
  User::masterEdit();
}
