<?php
$nomCentre = $config['nom_centre'] ?? 'Institut';
$telefon = $config['telefon'] ?? '';
$email = $config['email'] ?? '';
$adreca = $config['adreca'] ?? '';
$cpCiutat = $config['cp_ciutat'] ?? '';
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($nomCentre) ?></title>
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/landing.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a href="/" class="logo"><?= htmlspecialchars($nomCentre) ?></a>
            <nav class="nav-main">
                <a href="#sobre-nosaltres">Sobre nosaltres</a>
                <a href="#oferta">Oferta educativa</a>
                <a href="#contacte">Contacte</a>
            </nav>
        </div>
    </header>

    <main>
        <?php if ($hero): ?>
        <section class="hero" id="inici">
            <div class="hero-bg"></div>
            <div class="container hero-inner">
                <h1 class="hero-title"><?= htmlspecialchars($hero['titol']) ?></h1>
                <?php if (!empty($hero['subtitol'])): ?>
                <p class="hero-subtitle"><?= htmlspecialchars($hero['subtitol']) ?></p>
                <?php endif; ?>
                <?php if (!empty($hero['cos'])): ?>
                <p class="hero-text"><?= nl2br(htmlspecialchars($hero['cos'])) ?></p>
                <?php endif; ?>
                <a href="#sobre-nosaltres" class="btn btn-primary">Més informació</a>
            </div>
        </section>
        <?php endif; ?>

        <?php foreach ($seccions as $s):
            if ($s['clau'] === 'hero') continue;
            $id = str_replace('_', '-', $s['clau']);
        ?>
        <section class="section section-<?= htmlspecialchars($s['clau']) ?>" id="<?= htmlspecialchars($id) ?>">
            <div class="container">
                <?php if (!empty($s['titol'])): ?>
                <h2 class="section-title"><?= htmlspecialchars($s['titol']) ?></h2>
                <?php endif; ?>
                <?php if (!empty($s['subtitol'])): ?>
                <p class="section-subtitle"><?= htmlspecialchars($s['subtitol']) ?></p>
                <?php endif; ?>
                <?php if (!empty($s['cos'])): ?>
                <div class="section-body"><?= nl2br(htmlspecialchars($s['cos'])) ?></div>
                <?php endif; ?>

                <?php if ($s['clau'] === 'oferta' && !empty($oferta)): ?>
                <div class="oferta-grid">
                    <?php foreach ($oferta as $o): ?>
                    <article class="oferta-card">
                        <h3><?= htmlspecialchars($o['titol']) ?></h3>
                        <?php if (!empty($o['descripcio'])): ?>
                        <p><?= nl2br(htmlspecialchars($o['descripcio'])) ?></p>
                        <?php endif; ?>
                        <?php if (!empty($o['enllac'])): ?>
                        <a href="<?= htmlspecialchars($o['enllac']) ?>" class="link">Més informació</a>
                        <?php endif; ?>
                    </article>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if ($s['clau'] === 'contacte'): ?>
                <div class="contacte-block">
                    <?php if ($adreca || $cpCiutat): ?>
                    <p class="contacte-item"><strong>Adreça:</strong> <?= htmlspecialchars(trim($adreca . ' ' . $cpCiutat)) ?></p>
                    <?php endif; ?>
                    <?php if ($telefon): ?>
                    <p class="contacte-item"><strong>Telèfon:</strong> <a href="tel:<?= htmlspecialchars(preg_replace('/\s+/', '', $telefon)) ?>"><?= htmlspecialchars($telefon) ?></a></p>
                    <?php endif; ?>
                    <?php if ($email): ?>
                    <p class="contacte-item"><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($email) ?>"><?= htmlspecialchars($email) ?></a></p>
                    <?php endif; ?>
                    <?php
                    $xarxes = ['facebook' => 'Facebook', 'twitter' => 'Twitter/X', 'instagram' => 'Instagram', 'linkedin' => 'LinkedIn'];
                    $teXarxes = false;
                    foreach ($xarxes as $key => $label) {
                        if (!empty($config[$key])) { $teXarxes = true; break; }
                    }
                    if ($teXarxes): ?>
                    <div class="xarxes">
                        <?php foreach ($xarxes as $key => $label): if (empty($config[$key])) continue; ?>
                        <a href="<?= htmlspecialchars($config[$key]) ?>" target="_blank" rel="noopener" class="xarxa" aria-label="<?= htmlspecialchars($label) ?>"><?= htmlspecialchars($label) ?></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php endforeach; ?>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($nomCentre) ?>. Tots els drets reservats.</p>
        </div>
    </footer>
    <script src="/js/landing.js"></script>
</body>
</html>
