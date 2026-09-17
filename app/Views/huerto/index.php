<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4 mb-5">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="titulo-panel">🌱 Mi Huerto</h1>
            <p class="subtitulo-panel mb-0">Estado general de tus cultivos de hoy</p>
        </div>
        <a href="<?= base_url('huerto/nuevo') ?>" class="btn btn-success">
            + Nuevo cultivo
        </a>
    </div>

    <!-- Tarjetas de resumen -->
    <div class="row g-3 mb-4">

        <div class="col-6 col-lg-3">
            <div class="card card-resumen">
                <div class="card-body">
                    <div class="resumen-icono icono-total">🌿</div>
                    <div>
                        <div class="resumen-numero"><?= $totalCultivos ?></div>
                        <div class="resumen-etiqueta">Cultivos</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card card-resumen">
                <div class="card-body">
                    <div class="resumen-icono icono-riego">💧</div>
                    <div>
                        <div class="resumen-numero"><?= $requierenRiego ?></div>
                        <div class="resumen-etiqueta">Riego hoy</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card card-resumen">
                <div class="card-body">
                    <div class="resumen-icono icono-cosecha">🥬</div>
                    <div>
                        <div class="resumen-numero"><?= $listosCosecha ?></div>
                        <div class="resumen-etiqueta">Cosechar</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card card-resumen">
                <div class="card-body">
                    <div class="resumen-icono icono-termi">🧺</div>
                    <div>
                        <div class="resumen-numero"><?= $cosechados ?></div>
                        <div class="resumen-etiqueta">Cosechados</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Listado de cultivos (tabla) -->
    <div class="panel-tabla">

        <?php if (empty($cultivos)): ?>

            <div class="estado-vacio">
                <div class="icono">🪴</div>
                <h5 class="mt-2 fw-semibold">Todavía no tenés cultivos</h5>
                <p class="mb-3">Cargá tu primer cultivo y empezá a llevar la bitácora.</p>
                <a href="<?= base_url('huerto/nuevo') ?>" class="btn btn-success">+ Nuevo cultivo</a>
            </div>

        <?php else: ?>

            <div class="table-responsive">
                <table class="table table-huerto align-middle">

                    <thead>
                        <tr>
                            <th>Cultivo</th>
                            <th>Siembra</th>
                            <th>Próximo riego</th>
                            <th>Cosecha estimada</th>
                            <th>Estado</th>
                            <th>Alertas</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($cultivos as $cultivo): ?>

                            <?php
                                $filaAlerta = $cultivo['requiere_riego'] ? 'fila-riego' : ($cultivo['listo_cosechar'] ? 'fila-cosecha' : '');
                                $proximoRiego = $cultivo['proximo_riego']
                                    ? date('d/m/Y', strtotime($cultivo['proximo_riego']))
                                    : '—';
                                $fechaCosecha = $cultivo['fecha_cosecha_estimada']
                                    ? date('d/m/Y', strtotime($cultivo['fecha_cosecha_estimada']))
                                    : '—';
                            ?>

                            <tr class="<?= $filaAlerta ?>">

                                <td>
                                    <div class="nombre-planta"><?= esc($cultivo['nombre_planta']) ?></div>
                                    <?php if (! empty($cultivo['variedad'])): ?>
                                        <span class="variedad-planta"><?= esc($cultivo['variedad']) ?></span>
                                    <?php endif; ?>
                                </td>

                                <td class="fecha-cell">
                                    <?= date('d/m/Y', strtotime($cultivo['fecha_siembra'])) ?>
                                </td>

                                <td class="fecha-cell">
                                    <span class="<?= $cultivo['requiere_riego'] ? 'fecha-proxima text-warning fw-bold' : '' ?>">
                                        <?= $proximoRiego ?>
                                    </span>
                                </td>

                                <td class="fecha-cell">
                                    <?= $fechaCosecha ?>
                                </td>

                                <td>
                                    <?php if ($cultivo['estado'] === 'Listo para Cosechar'): ?>
                                        <span class="badge badge-estado badge-listo">Listo para Cosechar</span>
                                    <?php elseif ($cultivo['estado'] === 'Cosechado'): ?>
                                        <span class="badge badge-estado badge-cosechado">Cosechado</span>
                                    <?php else: ?>
                                        <span class="badge badge-estado badge-crecimiento">En Crecimiento</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="d-flex flex-column gap-1">

                                        <?php if ($cultivo['requiere_riego']): ?>
                                            <span class="badge-alerta badge-alerta-riego">💧 Requiere riego hoy</span>
                                        <?php endif; ?>

                                        <?php if ($cultivo['listo_cosechar']): ?>
                                            <span class="badge-alerta badge-alerta-cosecha">🌿 Listo para cosechar</span>
                                        <?php endif; ?>

                                    </div>
                                </td>

                                <td class="text-end">
                                    <div class="d-flex flex-column flex-lg-row gap-1 justify-content-lg-end">

                                        <form action="<?= base_url('huerto/registrarRiego/' . $cultivo['id']) ?>" method="post">
                                            <button type="submit" class="btn btn-accion btn-mini-riego w-100">💧 Riego</button>
                                        </form>

                                        <form
                                            action="<?= base_url('huerto/cambiarEstado/' . $cultivo['id']) ?>"
                                            method="post"
                                            class="d-flex flex-column flex-lg-row gap-1"
                                        >
                                            <select name="estado" class="form-select select-estado">
                                                <option value="En Crecimiento" <?= $cultivo['estado'] === 'En Crecimiento' ? 'selected' : '' ?>>En Crecimiento</option>
                                                <option value="Listo para Cosechar" <?= $cultivo['estado'] === 'Listo para Cosechar' ? 'selected' : '' ?>>Listo para Cosechar</option>
                                                <option value="Cosechado" <?= $cultivo['estado'] === 'Cosechado' ? 'selected' : '' ?>>Cosechado</option>
                                            </select>
                                            <button type="submit" class="btn btn-accion btn-mini-estado">Estado</button>
                                        </form>

                                        <a
                                            href="<?= base_url('huerto/eliminar/' . $cultivo['id']) ?>"
                                            class="btn btn-accion btn-mini-eliminar"
                                            onclick="return confirm('¿Seguro que querés eliminar este cultivo?')"
                                        >🗑️ Eliminar</a>

                                    </div>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>