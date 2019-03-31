<?php
  require "conn.php";
  
  $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $url = basename($url);
  
  $stmt = $conn->prepare("SELECT * FROM directories WHERE fromsite = :site");
  $stmt->bindParam(":site", $url);
  $stmt->execute();
  $return = $stmt->fetch(PDO::FETCH_OBJ);
  $return = $return->tosite;
  
  if(substr($return, 0, 5)!="http:" && substr($return, 0, 6)!="https:"){
    $return = "http://".$return;
  }
  
  header("Location: $return");
?>