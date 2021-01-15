<?php
class Poll
{
  function getPolls()
  {
    global $conn;
    $query = "SELECT id, question FROM polls WHERE DATE(NOW()) BETWEEN starts AND ends ";

    return $conn->query($query)->fetchAll();
  }

  public function completed($poll, $user)
  {
    $completed = $this->getAnswers($poll, $user) ? true : false;

    return $completed;
  }

  public function getAnswers($poll, $user)
  {
    global $conn;
    $answersQuery = "SELECT polls_choices.id AS choice_id, polls_choices.name AS choice_name FROM polls_answers INNER JOIN polls_choices ON polls_answers.choice_id = polls_choices.id WHERE polls_answers.user_Id = :user AND polls_answers.poll_id = :poll";
    $stmt = $conn->prepare($answersQuery);
    $stmt->bindParam(":poll", $poll);
    $stmt->bindParam(":user", $user);
    $stmt->execute();
    return $stmt->rowCount();
  }

  function getChoices($id)
  {
    $user = $_SESSION['user_id'];
    global $conn;
    if ($this->completed($id, $user) == true) {
      //Get all answers
      $answersQuery = "SELECT polls_choices.name, COUNT(polls_answers.id) * 100/(SELECT COUNT(*) FROM polls_answers WHERE polls_answers.poll_id = :poll_id ) as percentage FROM polls_choices LEFT JOIN polls_answers ON polls_choices.id = polls_answers.choice_id WHERE polls_choices.poll_id = :poll_id GROUP BY polls_choices.id";
      $stmt = $conn->prepare($answersQuery);
      $stmt->bindParam(":poll_id", $id);
      $stmt->execute();
      return $stmt->fetchAll();
    } else {
      //Check user answers as well
      $query = "SELECT polls.id, polls_choices.id AS choice_id, polls_choices.name FROM polls INNER JOIN polls_choices on polls.id = polls_choices.poll_id WHERE polls.id = :poll AND DATE(NOW()) BETWEEN polls.starts AND polls.ends";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(":poll", $id);
      $stmt->execute();
      return $stmt->fetchAll();
    }
  }

  function getPoll($id)
  {
    global $conn;
    $pollQuery = "SELECT id, question FROM polls WHERE id= :id AND DATE(NOW()) BETWEEN starts AND ends";
    $stmt = $conn->prepare($pollQuery);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    return $res;
  }

  function vote()
  {
    if (isset($_POST['pollHidden'], $_POST['choice'])) {
      global $conn;
      session_start();
      if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php?error=NoUser");
        exit();
      }
      $user = $_SESSION['user_id'];
      $poll = $_POST['pollHidden'];
      $choice = $_POST['choice'];

      $voteQuery =
        "INSERT INTO polls_answers (user_id, poll_id, choice_id)
      SELECT :user_id, :poll_id, :choice_id FROM polls WHERE EXISTS (
        SELECT id FROM polls WHERE id = :poll_id
        ) 
        AND EXISTS(
          SELECT id FROM polls_choices WHERE id = :choice_id AND poll_id = :poll_id
        ) 
        AND NOT EXISTS(
          SELECT id FROM polls_answers WHERE user_id = :user_id AND poll_id = :poll_id
        ) AND DATE(NOW()) BETWEEN polls.starts AND polls.ends LIMIT 1";
      $stmt = $conn->prepare($voteQuery);
      $stmt->bindParam(":poll_id", $poll);
      $stmt->bindParam(":user_id", $user);
      $stmt->bindParam(":choice_id", $choice);
      $stmt->execute();
      header("Location: ../index.php?postId=" . $poll);
    }
  }
}

if (isset($_POST['pollHidden'])) {
  include_once '../config/connection.php';
  Poll::vote();
} 
