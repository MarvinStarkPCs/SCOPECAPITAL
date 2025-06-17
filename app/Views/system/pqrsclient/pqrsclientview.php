<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow mb-4">
    <div class="card-header py-3 bg-dark-blue">
        <h6 class="m-0 font-weight-bold text-white">Mis Solicitudes PQRS</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Adjunto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pqrs as $item): ?>
                        <tr>
                            <td><?= esc($item['unique_code']) ?></td>
                            <td><?= esc($item['email']) ?></td>
                            <td><?= esc($item['type']) ?></td>
                            <td>
                                <?php
                                    // Colores según estado (id_status)
                                    $statusColor = [
                                        '1' => 'warning',   // Pendiente
                                        '2' => 'success',   // Resuelta
                                        '3' => 'danger'     // Rechazada
                                    ][$item['id_status']] ?? 'secondary';
                                ?>
                                <span class="badge badge-<?= $statusColor ?>"><?= esc($item['status']) ?></span>
                            </td>
                            <td><?= date('Y-m-d H:i', strtotime($item['created_at'])) ?></td>
                            <td>
                                <?php if (!empty($item['attachment_url'])): ?>
                                    <a href="<?= base_url('upload/pqrs/' . $item['attachment_url']) ?>" target="_blank" class="btn btn-sm btn-light">
                                        Details
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No adjunto</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal<?= $item['id_request'] ?>">
                                    <i class="fas fa-eye"></i> Ver
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Detalles -->
                        <div class="modal fade" id="detailModal<?= $item['id_request'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Detalle PQRS #<?= esc($item['unique_code']) ?></h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Tipo:</strong> <?= esc($item['type']) ?></p>
                                        <p><strong>Estado:</strong> <?= esc($item['status']) ?></p>
                                        <p><strong>Descripción:</strong><br><?= esc($item['description']) ?></p>
                                        <p><strong>Respuesta:</strong><br>
                                            <?= $item['response'] ? esc($item['response']) : '<em>Aún no hay respuesta</em>' ?>
                                        </p>
                                        <p><strong>Creado:</strong> <?= esc($item['created_at']) ?></p>
                                        <p><strong>Actualizado:</strong> <?= esc($item['updated_at']) ?></p>
                                        <?php if (!empty($item['attachment_url'])): ?>
                                            <p><strong>Adjunto:</strong>
                                                <a href="<?= base_url('upload/pqrs/' . $item['attachment_url']) ?>" target="_blank">
                                                    Ver archivo
                                                </a>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
