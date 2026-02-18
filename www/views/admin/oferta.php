<?php
$pageTitle = 'Oferta educativa';
ob_start();
?>
<div class="admin-page">
    <h1>Oferta educativa</h1>
    <p class="admin-intro">Gestioneu els estudis que es mostren a la secció "Oferta educativa".</p>
    <p><a href="/admin/oferta/nova" class="btn btn-primary">Afegir estudi</a></p>
    <div class="table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Títol</th>
                    <th>Ordre</th>
                    <th>Actiu</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($oferta as $o): ?>
                <tr>
                    <td><?= htmlspecialchars($o['titol']) ?></td>
                    <td><?= (int) $o['ordre'] ?></td>
                    <td><?= $o['actiu'] ? 'Sí' : 'No' ?></td>
                    <td>
                        <a href="/admin/oferta/edit/<?= (int) $o['id'] ?>" class="btn btn-sm">Editar</a>
                        <a href="/admin/oferta/delete/<?= (int) $o['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Segur que voleu eliminar aquest element?');">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
