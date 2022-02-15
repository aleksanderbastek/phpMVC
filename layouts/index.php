<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Filmy</title>
    <link rel="stylesheet" href="/resources/styles/filmstyl.css" />
    <link rel="stylesheet" href="/resources/libraries/jquery-ui/jquery-ui.min.css" />
    <script src="/resources/libraries/jquery/jquery-1.8.2.min.js"></script>
    <script src="/resources/libraries/jquery-ui/jquery-ui.min.js"></script>
    <script src="/resources/scripts/filmy.js"></script>
    <script src="/resources/scripts/jquerycomp.js"></script>
  </head>
  <body onload="favfilmol()">
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
            <a href="/gallery" class="menu-link">Galeria</a>
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
      <section class="aside">
        <article class="galery">
          <a href="lynch.jpg" target="_blank">
            <img class="image 1im" src="/resources/gallery/lynch.jpg" alt="lynch" />
          </a>
          <a href="tarkovsky.jpg" target="_blank">
            <img class="image 2im" src="/resources/gallery/tarkovsky.jpg" alt="tarkovsky" />
          </a>
          <a href="kubrick.jpg" target="_blank">
            <img class="image 3im" src="/resources/gallery/kubrick.jpg" alt="kubrick" />
          </a>
          <a href="kurosawa.jpg" target="_blank">
            <img class="image 4im" src="/resources/gallery/kurosawa.jpg" alt="kurosawa" />
          </a>
          <a href="tarantino.jpg" target="_blank">
            <img class="image 5im" src="/resources/gallery/tarantino.jpg" alt="tarantino" />
          </a>
          <a href="scorsese.jpg" target="_blank">
            <img class="image 6im" src="/resources/gallery/scorsese.jpg" alt="scorsese" />
          </a>
        </article>
        <article id="interaction">
          <label for="favourite-film">Wpisz swój ulubiony film</label>
          <form id="favourite-film">
            <div class="ui-widget">
              <input type="text" id="fav" title="Wpisz film, który lubisz." />
              <input type="button" value="Zapisz" onclick="favfilm()" />
            </div>
          </form>
          <div id="rfav"></div>
          <br />
          <label for="must-see"
            >Film który musisz obejrzeć zanim wrócisz do tej strony</label
          >
          <form id="must-see">
            <div class="ui-widget">
              <input
                type="text"
                id="must"
                title="Wpisz film, który musisz obejrzeć."
              />
              <input type="button" value="Zapisz" onclick="mustfilm()" />
            </div>
          </form>
          <div id="rms"></div>
        </article>
      </section>
      <footer class="footer">Aleksander Bastek s191341</footer>
    </main>
  </body>
</html>
