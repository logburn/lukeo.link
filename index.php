 <!DOCTYPE html>
<html>
  <head>
    <meta charset=UTF-8>
    <title>URL Shortener &nbsp;-&nbsp; lukeo.link</title>
    <meta name=viewport content=width=device-width,initial-scale=1>
    <link rel=stylesheet href=style.css type=text/css>
  </head>
  <body><div id=body>
    <div id=top class=center>
      <p>Looking for <a href=https://lukeogburn.com/>lukeogburn.com</a>?</p>
    </div>
    <div id=main>
      <h2 class=center>URL SHORTENER</h2>
      <form method=POST action=function.php>
        <input type=text name=url autofocus></input>
        <button type=submit>SHORTEN</button>
      </form>
      <?php
        if(isset($_GET["error"])){
          switch($_GET["error"]){
          case "stmt":
            echo "<p class='center error'>Error creating short URL</p>";
            break;
          case "hps":
            echo "<p class='center error'>Please enter a valid URL</p>";
            break;
          case "unr":
            echo "<p class='center error'>That URL wasn't recognized</p>";
            break;
          }
        }
        ?>
    </div>
<!--
    <div class=fileUpload>
      <form action="" method=POST>
        <input type=file name=fileUpload[] multiple>
        <button type=submit>
      </form>
    </div>
-->
    <!--<input type=checkbox id=boo>
    <div id=cookie><p><label for=boo>This site stores security cookies that do not identify or track you</label></p></div>-->
  </div></body>
</html>
