<?php
  session_start();

  $about = file_get_contents('../../public/views/about.html');
  $about = str_replace('../', '../../public/', $about);

  echo $about;
?>