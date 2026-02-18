<?php
$pageTitle = 'Editar secció';
ob_start();
?>
<div class="admin-page">
    <h1>Editar secció: <?= htmlspecialchars($seccio['clau']) ?></h1>
    <form method="post" action="/admin/seccions/edit/<?= (int) $seccio['id'] ?>" class="admin-form">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="<?= (int) $seccio['id'] ?>">
        <label>Títol</label>
        <input type="text" name="titol" value="<?= htmlspecialchars($seccio['titol'] ?? '') ?>">
        <label>Subtítol</label>
        <input type="text" name="subtitol" value="<?= htmlspecialchars($seccio['subtitol'] ?? '') ?>">
        <label>Cos (text)</label>
        <textarea name="cos" rows="6"><?= htmlspecialchars($seccio['cos'] ?? '') ?></textarea>
        <label>Ordre</label>
        <input type="number" name="ordre" value="<?= (int) $seccio['ordre'] ?>">
        <label class="checkbox-label">
            <input type="checkbox" name="actiu" value="1" <?= $seccio['actiu'] ? 'checked' : '' ?>>
            Secció visible a la landing
        </label>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Desar</button>
            <a href="/admin/seccions" class="btn btn-secondary">Cancel·lar</a>
        </div>
    </form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
