<?php
$pageTitle = 'Seccions de la landing';
ob_start();
?>
<div class="admin-page">
    <h1>Seccions de la landing</h1>
    <p class="admin-intro">Editeu el contingut de cada secció que es mostra a la pàgina principal.</p>
    <div class="table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Clau</th>
                    <th>Títol</th>
                    <th>Ordre</th>
                    <th>Actiu</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($seccions as $s): ?>
                <tr>
                    <td><code><?= htmlspecialchars($s['clau']) ?></code></td>
                    <td><?= htmlspecialchars($s['titol'] ?? '') ?></td>
                    <td><?= (int) $s['ordre'] ?></td>
                    <td><?= $s['actiu'] ? 'Sí' : 'No' ?></td>
                    <td><a href="/admin/seccions/edit/<?= (int) $s['id'] ?>" class="btn btn-sm">Editar</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
