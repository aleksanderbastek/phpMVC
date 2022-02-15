<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/styles/register.css">
    <title>Register</title>
</head>
<body>
    <div class="register">
        <h2>Rejestracja</h2>

        <form action="/register" method="POST">
            <div>
                <label for="email">Email:</label>
                <input type="text" name="email" value="<?php echo $email ?>">
            </div>

            <div>
                <label for="username">Nazwa użytkownka:</label>
                <input type="text" name="username" value="<?php echo $username ?>">
            </div>
            
            <div>
                <label for="password">Hasło:</label>
                <input type="password" name="password" value="<?php echo $password ?>">
            </div>

            <div>
                <label for="repeatedPassword">Powtórz hasło:</label>
                <input type="password" name="repeatedPassword" value="<?php echo $repeatedPassword ?>">
            </div>

            <div>
                <?php foreach ($errors as $error) { ?>
                    <p style="color: red"><?php echo $error ?></p>
                <?php } ?>
            </div>

            <input type="submit" value="Zarejestruj się">
            
            <a href="/">Anuluj</a>
        </form>
    </div>
</body>
</html>