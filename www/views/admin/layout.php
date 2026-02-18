<?php
$pageTitle = $pageTitle ?? 'Administració';
$currentUser = $_SESSION['admin_email'] ?? '';
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body class="admin-body">
    <header class="admin-header">
        <div class="admin-header-inner">
            <a href="/admin" class="admin-logo">Panell admin</a>
            <nav class="admin-nav">
                <a href="/admin/seccions" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin/seccions') !== false ? 'active' : '' ?>">Seccions</a>
                <a href="/admin/oferta" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin/oferta') !== false ? 'active' : '' ?>">Oferta educativa</a>
                <a href="/admin/config" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin/config') !== false ? 'active' : '' ?>">Configuració</a>
                <span class="admin-user"><?= htmlspecialchars($currentUser) ?></span>
                <a href="/admin/logout" class="logout">Sortir</a>
            </nav>
        </div>
    </header>
    <main class="admin-main">
        <?= $content ?? '' ?>
    </main>
</body>
</html>
