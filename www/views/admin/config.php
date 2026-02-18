<?php
$pageTitle = 'Configuració general';
$nomCentre = $configValues['nom_centre'] ?? '';
$adreca = $configValues['adreca'] ?? '';
$cpCiutat = $configValues['cp_ciutat'] ?? '';
$telefon = $configValues['telefon'] ?? '';
$email = $configValues['email'] ?? '';
$facebook = $configValues['facebook'] ?? '';
$twitter = $configValues['twitter'] ?? '';
$instagram = $configValues['instagram'] ?? '';
$linkedin = $configValues['linkedin'] ?? '';
$ok = isset($_GET['ok']);
ob_start();
?>
<div class="admin-page">
    <h1>Configuració general</h1>
    <p class="admin-intro">Dades del centre que es mostren a la landing (peu, contacte, xarxes).</p>
    <?php if ($ok): ?>
    <p class="success-msg">Configuració desada correctament.</p>
    <?php endif; ?>
    <form method="post" action="/admin/config" class="admin-form">
        <h2>Dades del centre</h2>
        <label>Nom del centre</label>
        <input type="text" name="nom_centre" value="<?= htmlspecialchars($nomCentre) ?>">
        <label>Adreça</label>
        <input type="text" name="adreca" value="<?= htmlspecialchars($adreca) ?>">
        <label>CP i ciutat</label>
        <input type="text" name="cp_ciutat" value="<?= htmlspecialchars($cpCiutat) ?>">
        <label>Telèfon</label>
        <input type="text" name="telefon" value="<?= htmlspecialchars($telefon) ?>">
        <label>Email (secretaria)</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>">
        <h2>Xarxes socials (URLs)</h2>
        <label>Facebook</label>
        <input type="url" name="facebook" value="<?= htmlspecialchars($facebook) ?>" placeholder="https://...">
        <label>Twitter / X</label>
        <input type="url" name="twitter" value="<?= htmlspecialchars($twitter) ?>" placeholder="https://...">
        <label>Instagram</label>
        <input type="url" name="instagram" value="<?= htmlspecialchars($instagram) ?>" placeholder="https://...">
        <label>LinkedIn</label>
        <input type="url" name="linkedin" value="<?= htmlspecialchars($linkedin) ?>" placeholder="https://...">
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Desar configuració</button>
        </div>
    </form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
