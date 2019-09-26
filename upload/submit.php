<?php

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

$pid = randID();
$file = $_FILES["images"];

if($file["name"][0]!=NULL){
  for($i=0; $i<sizeof($file["name"]); $i++){
    $ext = explode('.', $file["name"][$i]);
    $ext = strtolower($ext[sizeof($ext)-1]);
    $allowedExt = array('jpg', 'jpeg', 'png', 'doc', 'docx', 'pdf');
    if(in_array($ext, $allowedExt)){
      if(!$file["error"][$i]){
        $imgDest = randID().".".$ext;
        $img .= $imgDest.",";
        $dest = $_SERVER['DOCUMENT_ROOT']."/forum/images/".$imgDest;
        move_uploaded_file($file["tmp_name"][$i], $dest);
      }else{
        echo "Error uploading file";
        exit();
      }
    }else{
      msg("Bad file type.");
      header("Location: /post");
      exit(); //this is needed for some reason
    }
  }
}else{
  $img = NULL;
}
?>
