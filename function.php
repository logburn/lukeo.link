<?php
  require "conn.php";
  
  function verifyID($pid){
    require "conn.php";
    $stmt = $GLOBALS['conn']->prepare("SELECT * FROM directories WHERE fromsite = :pid");
    $stmt->bindParam(":pid", $pid);
    $stmt->execute();
    $return = $stmt->fetch(PDO::FETCH_OBJ)->fromsite;
    return ($return!=NULL)?false:true;
  }
  
  function randID($length = 4) {
    //Note that $length must be even, or it will round down
    do{
      if(function_exists("random_bytes")){
        $bytes = random_bytes(ceil($length/2));
      }elseif(function_exists("openssl_random_pseudo_bytes")){
        $bytes = openssl_random_pseudo_bytes(ceil($length/2));
      }else{
        throw new Exception("No cryptographically secure random function available.");
      }
      $x = substr(bin2hex($bytes), 0, $length);
      $id = strtolower(gmp_strval(gmp_init($x, 36), 62));
    } while(!verifyID($id));
    return $id;
  }
  
  function hyperSearch($text){
    preg_match_all("#((((-|_){0,}\w)+\.([a-zA-Z]+){2,})|((((http)|(https)):\/\/){1}((-|_){0,}\w)+\.([a-zA-Z]+){2,}))((\w+|-|_|\/|\.)+){0,}#", $text, $match);
    if($match[0]==NULL){
      return false;
    }else{
      return true;
    }
  }
  
  if(hyperSearch($_POST["url"]) == false){
      header("Location: /?error=hps");
      exit();
  }
  
  $stmt = $conn->prepare("SELECT * FROM directories WHERE tosite = :site");
  $stmt->bindParam(":site", $_POST["url"]);
  $stmt->execute();
  $return = $stmt->fetch(PDO::FETCH_OBJ)->fromsite;
  $siteExists = ($return==NULL)?false:$return;
  
  if($siteExists == false){
    $fromurl = randID();
    $tourl = $_POST["url"];
    $stmt = $conn->prepare("INSERT INTO directories (fromsite, tosite) VALUES (:f, :t)");
    $stmt->bindParam(":f", $fromurl);
    $stmt->bindParam(":t", $tourl);
    $stmt->execute();
    if(!$stmt){
      header("Location: /?error=stmt");
    }else{
      header("Location: /done.php?code=$fromurl");
    }
  }else{
    header("Location: /done.php?code=$siteExists");
  }
?>