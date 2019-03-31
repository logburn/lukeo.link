 <!DOCTYPE html>
<html>
  <head>
    <meta charset=UTF-8>
    <title>URL Shortener &nbsp;-&nbsp; lukeo.link</title>
    <meta name=viewport content=width=device-width,initial-scale=1>
  <link rel=stylesheet href=style.css type=text/css>
  </head>
  <body>
    <div id=top class=center>
      <p>Check out <a href=https://lukeogburn.com/>my main site</a>!</p>
    </div>
    <div id=main>
      <h2 class=center>HERE'S YOUR SHORT URL</h2>
      <p class=center>lukeo.link/<?=$_GET["code"]?></p>
      <br>
      <p class=center><a href=/>Want to make another?</a></p>
    </div>
  </body>
</html>