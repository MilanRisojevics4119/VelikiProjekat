<?php

function excerpt($length, $string) {
  $new = substr($string, 0, $length);

  return $new . '...';
}