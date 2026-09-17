<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4 mb-5">

    <div class="tarjeta-form">

        <div class="cabecera">
            <span class="brand-icon" style="background: linear-gradient(135deg, var(--verde-hoja), var(--verde-medio));">🌱</span>
            <h1>Nuevo cultivo</h1>
        </div>

        <div class="cuerpo">

            <?php if (session()->getFlashdata('errores')): ?>
                <div class="alert alert-danger alert-soft">
                    <strong>Revisá los siguientes campos:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach (session()->getFlashdata('errores') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('huerto/crear') ?>" method="post">

                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nombre_planta" class="form-label">Nombre de la planta</label>
                            <input
                                type="text"
                                name="nombre_planta"
                                id="nombre_planta"
                                class="form-control"
                                value="<?= old('nombre_planta') ?>"
                                placeholder="Ej. Tomate, Lechuga, Albahaca"
                                required
                            >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="variedad" class="form-label">Variedad</label>
                            <input
                                type="text"
                                name="variedad"
                                id="variedad"
                                class="form-control"
                                value="<?= old('variedad') ?>"
                                placeholder="Ej. Cherry, Crespa, Genovesa"
                                required
                            >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="fecha_siembra" class="form-label">Fecha de siembra</label>
                            <input
                                type="date"
                                name="fecha_siembra"
                                id="fecha_siembra"
                                class="form-control"
                                value="<?= old('fecha_siembra') ?>"
                                required
                            >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="dias_cosecha_estimados" class="form-label">Días para cosechar</label>
                            <input
                                type="number"
                                name="dias_cosecha_estimados"
                                id="dias_cosecha_estimados"
                                class="form-control"
                                value="<?= old('dias_cosecha_estimados') ?>"
                                min="1"
                                placeholder="Ej. 60"
                                required
                            >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="frecuencia_riego_dias" class="form-label">Frecuencia de riego (días)</label>
                            <input
                                type="number"
                                name="frecuencia_riego_dias"
                                id="frecuencia_riego_dias"
                                class="form-control"
                                value="<?= old('frecuencia_riego_dias') ?>"
                                min="1"
                                placeholder="Ej. 2"
                                required
                            >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="ultimo_riego" class="form-label">Último riego</label>
                            <input
                                type="datetime-local"
                                name="ultimo_riego"
                                id="ultimo_riego"
                                class="form-control"
                                value="<?= old('ultimo_riego') ?>"
                                required
                            >
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-4">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="En Crecimiento" <?= old('estado') === 'En Crecimiento' ? 'selected' : '' ?>>En Crecimiento</option>
                                <option value="Listo para Cosechar" <?= old('estado') === 'Listo para Cosechar' ? 'selected' : '' ?>>Listo para Cosechar</option>
                                <option value="Cosechado" <?= old('estado') === 'Cosechado' ? 'selected' : '' ?>>Cosechado</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-guardar">Guardar cultivo</button>
                    <a href="<?= base_url() ?>" class="btn btn-cancelar">Cancelar</a>
                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>