# 🌱 Mi Huerto — Sistema de Gestión de Huertos Urbanos y Comunitarios

Sistema web desarrollado en **CodeIgniter 4** (MVC) para llevar la bitácora de
cultivos de un huerto urbano: control de inventario, historial de riego y un
panel dinámico de alertas de atención inmediata.

## ✨ Funcionalidades

- **Panel de alertas**: detecta de forma automática los cultivos que requieren
  riego hoy y los que ya están listos para cosechar, comparando fechas.
- **Alta de cultivos**: registro de planta, variedad, fecha de siembra, días
  estimados de cosecha, frecuencia de riego y último riego.
- **Registro de riego**: actualiza con un clic la fecha del último riego.
- **Cambio de estado**: En Crecimiento → Listo para Cosechar → Cosechado.
- **Eliminación** de cultivos.
- **Tarjetas de resumen**: total de cultivos, riegos del día, listos para
  cosechar y cosechados.
- **Diseño responsive** con Bootstrap 5, View Layouts y badges de color para las alertas.

## 🛠️ Tecnologías

| Herramienta | Versión |
|---|---|
| PHP | 8.1+ |
| CodeIgniter | 4.7 |
| MySQL / MariaDB | cualquier |
| Bootstrap | 5.3 |
| Composer | 2.x |

## 📦 Instalación

### 1. Requisitos

- XAMPP (Apache + MySQL) activos.
- PHP 8.1+ con las extensiones `intl`, `mbstring` y `mysqli` habilitadas en `php.ini`.
- Composer instalado globalmente.

### 2. Clonar e instalar dependencias

```bash
git clone <url-del-repositorio> huerto-comunitario
cd huerto-comunitario
composer install
```

### 3. Configurar entorno

```bash
cp env .env
```

Editar `.env`:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost/huerto-comunitario/public/'

database.default.hostname = localhost
database.default.database = huerto_db
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

> ⚠️ Si usás otro host/puerto (ej. `php spark serve` en el puerto 8080), ajustá
> `app.baseURL` a la URL donde se sirve la aplicación.

### 4. Crear la base de datos

Crear la base `huerto_db` (desde phpMyAdmin o MySQL) y ejecutar las **migraciones**
(la estructura de la tabla se genera únicamente con el comando `spark`):

```bash
php spark migrate
```

### 5. Levantar el servidor

Desde Apache/XAMPP accediendo a `http://localhost/huerto-comunitario/public/`,
o bien:

```bash
php spark serve
# http://localhost:8080
```

## 🗄️ Estructura base de datos

Tabla **`cultivos`** creada mediante migración (`php spark make:migration CrearTablaCultivos`):

| Campo | Tipo | Descripción |
|---|---|---|
| `id` | INT (PK, auto) | Identificador |
| `nombre_planta` | VARCHAR(100) | Nombre común del cultivo |
| `variedad` | VARCHAR(100, null) | Variedad (opcional) |
| `fecha_siembra` | DATE | Fecha de plantación |
| `dias_cosecha_estimados` | INT | Días aproximados a la cosecha |
| `frecuencia_riego_dias` | INT | Cada cuántos días se riega |
| `ultimo_riego` | DATETIME | Última vez que se regó |
| `estado` | VARCHAR(50) | En Crecimiento / Listo para Cosechar / Cosechado |
| `created_at` / `updated_at` | DATETIME | Gestionadas automáticamente |

## 🧭 Rutas

| Método | Ruta | Acción |
|---|---|---|
| GET | `/` | Panel de alertas |
| GET | `/huerto/nuevo` | Formulario de alta |
| POST | `/huerto/crear` | Guarda un cultivo |
| POST | `/huerto/registrarRiego/{id}` | Registra el riego |
| POST | `/huerto/cambiarEstado/{id}` | Cambia el estado |
| GET | `/huerto/eliminar/{id}` | Elimina el cultivo |

## 📂 Estructura del proyecto

```
app/
├── Config/                 # Rutas, autoload, etc.
├── Controllers/Huerto.php  # Lógica de control
├── Database/Migrations/    # CrearTablaCultivos
├── Models/CultivoModel.php # Modelo del cultivo
└── Views/
    ├── layouts/main.php    # View Layout (Bootstrap 5)
    └── huerto/
        ├── index.php       # Panel con resumen y alertas
        └── nuevo.php       # Formulario de alta
```

---

*Trabajo Práctico Integrador — Práctica Profesionalizante III, 2° año.*