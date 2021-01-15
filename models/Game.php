<?php 

class Game {
  function create() {
    //Input game info
    $user = $_SESSION['role_id'];
    $name = $_POST['game_name'];
    $name = $_POST['game_price'];
    $name = $_POST['game_description'];
    $name = $_POST['game_specs'];
    $name = $_POST['game_genre'];
    $name = $_POST['game_studio'];
    $name = $_POST['game_platforms'];
    //Images related info
    $gameImage = $_FILES['game_image'];
    $imageName = $gameImage['name'];
    $fileTmpName = $gameImage['tmp_name'];
    $fileSize = $gameImage['size'];
    $fileError = $gameImage['error'];
    $fileType = $gameImage['type'];

    $extensionImg = explode('.', $imageName);
    $formated = strtolower(end($extensionImg));
    //Icon related info
    $iconImage = $_FILES['game_image'];
    $iconName = $iconImage['name'];
    $iconTmpName = $iconImage['tmp_name'];
    $iconSize = $iconImage['size'];
    $iconError = $iconImage['error'];
    $iconType = $iconImage['type'];

    $extensionIcon = explode('.', $iconName);
    $formatedIcon = strtolower(end($extensionIcon));

    //formats
    $alowedFormats = array('jpg', 'png', 'jpeg', 'gif');

    //Code to insert one image, or more
    if (in_array($formated, $alowedFormats)) {
      if ($fileError == 0) {
        if ($fileSize < 1516000) {
          $newName = "profile" . $id . "." . $formated;
          $fileDest = '../../assets/images/profile/' . $newName;
          $fileDestP = 'assets/images/profile/' . $newName;
          //These are for deletion
          if ($_SESSION['user_image'] != NULL) {
            $fileToDel = "../../assets/images/profile/" . $id . "*";
            $fileInfo = glob($fileToDel);
            $fileExt = explode(".", $fileInfo[0]);
            $realExt = strtolower(end($fileExt));
            $file = '../../assets/images/profile/' . $id . '.' . $realExt;
            if(is_file($file)) {
              unlink($file);
            }
          }
          //End of deletion
          move_uploaded_file($fileTmpName, $fileDest);
          $sql = "UPDATE users SET user_image='$fileDestP' WHERE id='$id';";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $_SESSION['user_image'] = $fileDestP;

          $desc = $_POST['descChange'];

          $query = "UPDATE users SET user_desc = :descr WHERE id= :id ;";
          $stmt = $conn->prepare($query);
          $stmt->bindParam(":descr", $desc, PDO::PARAM_STR);

          $stmt->bindParam(":id", $id);
          $stmt->execute();
          header("Location: ../../index.php?page=profile&success=success");
          exit();
        } else {
          echo 'Your file is too big!';
          header("Location: ../../index.php?page=profile&error=bigFile");
        }
      } else {
        header("Location: ../../index.php?page=profile&error=error");
      }
    } else {
      if (!in_array($formated, $alowedFormats)) {
        $desc = $_POST['descChange'];
        $query = "UPDATE users SET user_desc = :descr WHERE id= :id ;";
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

  function masterEdit() {
    global $conn;
    $id = $_POST['id'];
    $name = $_POST['name'];
    $specs = $_POST['specs'];
    $genre = $_POST['genre'];
    $studio = $_POST['studio'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $platforms = $_POST['platforms'];


    $sql = "UPDATE games SET name = :name, specs = :specs, genre = :genre, studio = :studio, price = :price, description = :description, platforms = :platforms  WHERE id = :id ;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":specs", $specs);
    $stmt->bindParam(":genre", $genre);
    $stmt->bindParam(":studio", $studio);
    $stmt->bindParam(":price", $price);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":platforms", $platforms);

    $stmt->execute();
    header("Location: ../index.php?page=dashboard&success=gameEdited");
  }

  function show($gameId = 0) {
    if($gameId == 0) {
      //Show all games
      global $conn;
      $query = "SELECT * FROM games";
      return $conn->query($query)->fetchAll();
    } else {
      //Show-get specific
      global $conn;
      $query= "SELECT * FROM games WHERE id = $gameId";
      return $conn->query($query)->fetch();
    }
  }

  function delete() {
    global $conn;
    $gameId = $_POST['game_id'];
    
    $query = "DELETE FROM games WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $gameId);
    $stmt->execute();
    header("Location: ../index.php?page=dashboard");
  }
}

if (isset($_POST['editMaster'])) {
  include_once '../config/connection.php';
  Game::masterEdit();
}if(isset($_POST["deleteGame"])){
  include_once '../config/connection.php';
  Game::delete();
}