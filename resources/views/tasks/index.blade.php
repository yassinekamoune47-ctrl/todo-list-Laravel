<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">My Todo List</h1>

            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                + Ajouter une tâche
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row g-3">
            @forelse ($tasks as $task)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $task->title }}
                            </h5>

                            <p class="card-text">
                                {{ $task->description ?: 'Aucune description' }}
                            </p>


                            @if ($task->status === 'completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif ($task->status === 'in_progress')
                                <span class="badge bg-primary">In Progress</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif


                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-primary">
                                    Modifier
                                </a>

                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                    onsubmit="return confirm('Voulez-vous supprimer cette tâche ?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Aucune tâche pour le moment.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

</body>

</html>
