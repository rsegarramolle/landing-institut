<?php
$error = $error ?? null;
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accés administració</title>
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body class="login-page">
    <div class="login-box">
        <h1>Panell d'administració</h1>
        <p class="login-subtitle">Introduïu les vostres credencials</p>
        <?php if ($error): ?>
        <p class="error-msg"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="post" action="/admin/login" class="login-form">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required autocomplete="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <label for="password">Contrasenya</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
        <p class="back-link"><a href="/">Tornar a la landing</a></p>
    </div>
</body>
</html>
