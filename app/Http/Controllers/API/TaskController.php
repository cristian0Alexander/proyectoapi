<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // GET /api/tasks  -> lista todas
    public function index()
    {
        return response()->json(Task::all());
    }

    // GET /api/tasks/{id}  -> una sola
    public function show(Task $task)
    {
        return response()->json($task);
    }

    // POST /api/tasks  -> crear
    public function store(Request $request)
    {
        $datos = $request->validate([
            'title'       => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'responsable' => 'nullable|string|max:255',
        ]);

        $task = Task::create($datos);

        return response()->json([
            'mensaje' => 'Tarea creada correctamente',
            'tarea'   => $task,
        ], 201);
    }

    // PUT/PATCH /api/tasks/{id}  -> actualizar
    public function update(Request $request, Task $task)
    {
        $datos = $request->validate([
            'title'       => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'responsable' => 'nullable|string|max:255',
        ]);

        $task->update($datos);

        return response()->json([
            'mensaje' => 'Tarea actualizada correctamente',
            'tarea'   => $task,
        ]);
    }

    // DELETE /api/tasks/{id}  -> eliminar
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'mensaje' => 'Tarea eliminada correctamente',
        ]);
    }
}