<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Filmy</title>
    <link rel="stylesheet" href="/resources/styles/filmstyl.css" />
    <script src="/resources/libraries/jquery/jquery-1.8.2.min.js"></script>
    <script src="/resources/scripts/filmy.js"></script>
  </head>
  <body>
    <main class="container">
      <header class="header">
        <h2>Kinematografia</h2>
      </header>
      <nav class="nav">
        <label for="show-menu" class="show-menu">Menu</label>
        <input type="checkbox" id="show-menu" role="button" />
        <ul class="menu-list">
          <li class="menu-item">
            <a href="/" class="menu-link">Start</a>
          </li>
          <li class="menu-item">
            <a href="/films" class="menu-link">Filmy</a>
          </li>
          <li class="menu-item">
            <a href="/series" class="menu-link">Seriale</a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="#"> Reżyserzy</a>
            <ul class="dropdown">
              <li class="menu-link"><a href="#">Lynch</a></li>
              <li class="menu-link"><a href="#">Tarantino</a></li>
              <li class="menu-link"><a href="#">Tarkovsky</a></li>
            </ul>
          </li>
        </ul>
      </nav>
      <div class="wrapper">
        <section class="aside">
          filmy
          <div></div>
          <div id="addtable"></div>
        </section>
      </div>
      <footer class="footer">Aleksander Bastek s191341</footer>
    </main>
  </body>
</html>
