<?php require_once "../models/UserModel.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Filmy</title>
    <link rel="stylesheet" href="/resources/styles/gallery.css" />
    <link rel="stylesheet" href="/resources/styles/filmstyl.css" />
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
      <div class="galleryInterface">
        <div class="galleriesContainer">
          <div class="galleryAndPagin">
            <h1>Publiczne zdjęcia</h1>
            <article class="gallery1">
                <?php foreach ($publicPhotos as $photo) { ?>
                  <a  class="gallery-image" href="/images/watermarked/<?php echo $photo->_id; ?>">
                    <img  src="/images/thumbnail/<?php echo $photo->_id; ?>" />
                    <div>
                      Author: <?php echo $photo->author; ?><br/>Title: <?php echo $photo->title; ?> 
                    </div>
                  </a>
                <?php } ?>
            </article>
            <br><br>
            <div class="pagin">
              <a href="#">&laquo;</a>

              <?php for ($pageNumber = 1; $pageNumber <= $publicPhotoAmount; $pageNumber++) { ?>
                <a href="/gallery?publicPhotosPage=<?php echo $pageNumber ?>&privatePhotosPage=<?php echo $currentPrivatePage ?>"><?php echo $pageNumber?></a>
              <?php } ?>

              <a href="#">&raquo;</a>
            </div>
          </div>
          <?php if (UserModel::isUserAuthorized()) { ?>
              <div class="galleryAndPagin">
            <h1>Prywatne zdjęcia</h1>
                <article class="gallery1">
                  <?php foreach ($privatePhotos as $photo) { ?>
                    <a  class="gallery-image" href="/images/watermarked/<?php echo $photo->_id; ?>">
                      <img  src="/images/thumbnail/<?php echo $photo->_id; ?>" />
                      <div>
                        Title: <?php echo $photo->title; ?> 
                      </div>
                    </a>
                  <?php } ?>
                </article>
                <br><br>
                <div class="pagin">
                  <a href="#">&laquo;</a>

                  <?php for ($pageNumber = 1; $pageNumber <= $privatePhotoAmount; $pageNumber++) { ?>
                    <a href="/gallery?publicPhotosPage=<?php echo $currentPublicPage ?>&privatePhotosPage=<?php echo $pageNumber ?>"><?php echo $pageNumber?></a>
                  <?php } ?>

                  <a href="#">&raquo;</a>
                </div>
              </div>
          <?php } ?>
          </div>
          <div class="LogIn">
            <?php if (!UserModel::isUserAuthorized()) { ?>
              <p>Logowanie</p>
              <form action="/login" method="POST">
                <div>
                  <label for="username">Nazwa użytkownika:</label>
                  <input type="text" name="username">
                </div>

                <div>
                  <label for="password">Haslo:</label>
                  <input type="password" name="password">
                </div>

                <input type="submit" value="Zaloguj się" class="button">

                <a href="/register" class="button">Zarejestruj się</a>
              </form>
            <?php } else { ?>
              <p>Nazwa użytkownika</p>
              <p><?php echo UserModel::getAuthorizedUserName() ?></p>
              
              <a href="/logout">
                <input type="submit" value="wyloguj się" class="button">
              </a>
            <?php } ?>
            <p>Dodaj zdjęcie</p>
            <form action="/upload" method="POST" enctype="multipart/form-data">
              <label for="image">Dodaj zdjęcie</label>
              <input type="file" name="image" class="button">
              
              <?php if (!UserModel::isUserAuthorized()) { ?>
                <label for="author">Autor: </label>
                <input type="text" name="author">

                <label for="title">Tytuł: </label>
                <input type="text" name="title">

                <label for="watermark">Watermark: </label>
                <input type="text" name="watermark">
              <?php } else {?>
                <label for="author">Autor: </label>
                <input type="text" name="author" readonly="readonly" value="<?php echo UserModel::getAuthorizedUserName() ?>">
                
                <label for="title">Tytuł: </label>
                <input type="text" name="title">

                <label for="watermark">Watermark: </label>
                <input type="text" name="watermark">

                <div>
                  <p>Prywatność:</p>
                  Prywatne: <input type="radio" name="privacy" id="private" value="private">
                  Publiczne: <input type="radio" name="privacy" id="public" value="public">
                </div>
              <?php } ?>
                <p style="color: red;"><?php echo isset($_SESSION['upload_error']) ? $_SESSION['upload_error'] : '' ?></p>

              <button type="submit" class="button">Opublikuj</button>
            </form>
          </div>
        </div>
      </section>
      <footer class="footer">Aleksander Bastek s191341</footer>
    </main>
  </body>
</html>
