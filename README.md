# API de Tareas con Laravel

API REST básica desarrollada con **Laravel** que permite gestionar tareas (CRUD completo) y responde en formato **JSON**. Fue creada para las prácticas 11 y 12 del módulo *Desarrollo de Aplicaciones Móviles (DAM)* y está pensada para ser consumida desde un frontend en **Ionic + Angular**.

## Tecnologías

- PHP 8.2 o superior
- Laravel 11 o superior
- MySQL (XAMPP)
- Composer

## Requisitos previos

- [XAMPP](https://www.apachefriends.org/) con Apache y MySQL iniciados
- [Composer](https://getcomposer.org/)
- [Git](https://git-scm.com/)
- Extensión `zip` habilitada en `php.ini`

## Instalación

1. Clona el repositorio:

```bash
git clone https://github.com/TU_USUARIO/proyectoapi.git
cd proyectoapi
```

2. Instala las dependencias:

```bash
composer install
```

3. Crea el archivo de entorno y genera la clave de la aplicación:

```bash
copy .env.example .env
php artisan key:generate
```

4. Crea la base de datos `practica11ionic` en phpMyAdmin (`http://localhost/phpmyadmin`) con cotejamiento `utf8mb4_unicode_ci`.

5. Verifica la conexión en el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=practica11ionic
DB_USERNAME=root
DB_PASSWORD=
```

6. Ejecuta las migraciones:

```bash
php artisan migrate
```

7. Inicia el servidor:

```bash
php artisan serve
```

La API quedará disponible en `http://127.0.0.1:8000/api`.

## Modelo de datos

Tabla `tasks`:

| Campo         | Tipo      | Descripción                    |
|---------------|-----------|--------------------------------|
| `id`          | bigint    | Identificador (autoincremental)|
| `title`       | string    | Título de la tarea (requerido) |
| `descripcion` | text      | Descripción (opcional)         |
| `responsable` | string    | Responsable (opcional)         |
| `created_at`  | timestamp | Fecha de creación              |
| `updated_at`  | timestamp | Fecha de actualización         |

## Endpoints

URL base: `http://127.0.0.1:8000/api`

| Método       | Ruta           | Descripción                  |
|--------------|----------------|------------------------------|
| GET          | `/tasks`       | Lista todas las tareas       |
| GET          | `/tasks/{id}`  | Muestra una tarea            |
| POST         | `/tasks`       | Crea una tarea               |
| PUT / PATCH  | `/tasks/{id}`  | Actualiza una tarea          |
| DELETE       | `/tasks/{id}`  | Elimina una tarea            |

> Para las peticiones con cuerpo (POST, PUT, PATCH) envía los headers `Accept: application/json` y `Content-Type: application/json`.

### Ejemplos

**Crear una tarea** — `POST /api/tasks`

```json
{
    "title": "Realizar Diagrama entidad relación",
    "descripcion": "para proyecto final",
    "responsable": "Juanito"
}
```

Respuesta `201 Created`:

```json
{
    "mensaje": "Tarea creada correctamente",
    "tarea": {
        "title": "Realizar Diagrama entidad relación",
        "descripcion": "para proyecto final",
        "responsable": "Juanito",
        "updated_at": "2026-10-20T00:00:00.000000Z",
        "created_at": "2026-10-20T00:00:00.000000Z",
        "id": 4
    }
}
```

**Listar tareas** — `GET /api/tasks`

```json
[
    {
        "id": 1,
        "title": "Comprar frutas",
        "descripcion": null,
        "responsable": null,
        "created_at": "2026-10-19T02:17:27.000000Z",
        "updated_at": "2026-10-19T02:17:27.000000Z"
    }
]
```

**Actualizar una tarea** — `PUT /api/tasks/1`

```json
{
    "title": "Comprar verduras",
    "descripcion": "en el mercado",
    "responsable": "María"
}
```

Respuesta `200 OK`:

```json
{
    "mensaje": "Tarea actualizada correctamente",
    "tarea": { "id": 1, "title": "Comprar verduras", "...": "..." }
}
```

**Eliminar una tarea** — `DELETE /api/tasks/1`

```json
{
    "mensaje": "Tarea eliminada correctamente"
}
```

### Códigos de respuesta

| Código | Significado                                   |
|--------|-----------------------------------------------|
| 200    | Operación exitosa                             |
| 201    | Recurso creado                                |
| 404    | La tarea no existe                            |
| 422    | Error de validación (por ejemplo, sin `title`)|

## Estructura relevante

```
app/
├── Http/Controllers/API/TaskController.php   # Lógica del CRUD
└── Models/Task.php                           # Modelo Task
database/migrations/                          # Migraciones de la tabla tasks
routes/api.php                                # Definición de endpoints
```

## Datos de prueba (opcional)

```bash
php artisan tinker
```

```php
use App\Models\Task;
Task::create(['title' => 'Comprar frutas']);
Task::create(['title' => 'Hacer ejercicio']);
Task::create(['title' => 'Leer un libro']);
```

## Frontend

Esta API será consumida desde un proyecto **Ionic + Angular** (plantilla *tabs*) con Axios o Fetch, mostrando las tareas en una tabla en la página `Task`.

## Autor

- **Nombre:** Cristian Alexander
- **Curso:** Desarrollo de Aplicaciones Móviles (DAM) — ITCA FEPADE

