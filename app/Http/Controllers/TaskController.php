<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Afficher toutes les tâches
    public function index()
    {
        $tasks = Task::latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    // Afficher le formulaire d'ajout
    public function create()
    {
        return view('tasks.create');
    }

    // Ajouter une nouvelle tâche
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $validated['is_completed'] =
            $validated['status'] === 'completed';

        Task::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task added successfully!');
    }

    // Afficher une tâche
    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    // Modifier une tâche
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.edit', compact('task'));
    }

    // Enregistrer les modifications
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $validated['is_completed'] =
            $validated['status'] === 'completed';

        $task = Task::findOrFail($id);
        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    // Supprimer une tâche
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }
}