<?php
$name = $_POST['name'];
$sbject = $_POST['subject'];
$from = $_POST['mail'];
$message = $_POST['message'];
if (isset($_POST['submit'])) {
  if (empty($name) || empty($sbject) || empty($from) || empty($message)) {
    header("Location: ../index.php?error=emptyfields&" . $username . "&mail=" . $email);

    exit();
  } else if (!preg_match("/^([a-zA-Z][0-9]{2,16})$/", $name) && (!filter_var($from, FILTER_VALIDATE_EMAIL))) {
    header("Location: ../index.php?error=incorrectfields&" . $username . "&mail=" . $email);
    exit();
  } else if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../index.php?error=emptyfields&" . $name);
    exit();
  } else if (!preg_match("/^([a-zA-Z0-9]{2,16})$/", $name)) {
    header("Location: ../index.php?error=emptyusername&mail=" . $email);
    exit();
  } else {
    $myMail = "mrisojevic4119s@raf.rs";
    $headers = 'From: ' . $from;
    $txt = "You have recieved an e-mail from" . $name . ".\n\n" . $message;
    mail($myMail, $subject, $txt, $headers);

    header("Location: ../index.php?success=mailSent");
  }
} else {
  var_dump($name, $sbject, $from, $message);
}
