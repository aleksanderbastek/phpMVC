<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  <ul>
    <?php foreach ($posts as $post): ?>
    <li>
      <h3><?= $post->title ?></h3>
      <p><?= $post->contents ?></p>
    </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>