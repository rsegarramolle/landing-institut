<?php
$pageTitle = $item ? 'Editar oferta' : 'Nova oferta';
$item = $item ?? null;
$isEdit = (bool) $item;
ob_start();
?>
<div class="admin-page">
    <h1><?= $isEdit ? 'Editar oferta educativa' : 'Afegir estudi' ?></h1>
    <form method="post" action="<?= $isEdit ? '/admin/oferta/edit/' . (int) $item['id'] : '/admin/oferta/nova' ?>" class="admin-form">
        <label>Títol</label>
        <input type="text" name="titol" required value="<?= $item ? htmlspecialchars($item['titol']) : '' ?>">
        <label>Descripció</label>
        <textarea name="descripcio" rows="4"><?= $item ? htmlspecialchars($item['descripcio'] ?? '') : '' ?></textarea>
        <label>Enllaç (opcional)</label>
        <input type="url" name="enllac" value="<?= $item ? htmlspecialchars($item['enllac'] ?? '') : '' ?>" placeholder="https://...">
        <label>Ordre</label>
        <input type="number" name="ordre" value="<?= $item ? (int) $item['ordre'] : 0 ?>">
        <label class="checkbox-label">
            <input type="checkbox" name="actiu" value="1" <?= !$item || $item['actiu'] ? 'checked' : '' ?>>
            Visible a la landing
        </label>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Desar' : 'Crear' ?></button>
            <a href="/admin/oferta" class="btn btn-secondary">Cancel·lar</a>
        </div>
    </form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
