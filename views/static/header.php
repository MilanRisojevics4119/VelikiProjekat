<?php
include 'config/connection.php';
include 'helpers/generateHeader.php';
session_start();
$sql = "SELECT * FROM menu;";
$result = executeQuery($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="assets/images/icon.png">
  <link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="public/css/style.css" type="text/css">
  <title>Blogstore - register for free</title>
</head>

<body>
  <div class="backdrop"></div>
  <header id="header">
    <?php printHeader($result); ?>
  </header>
