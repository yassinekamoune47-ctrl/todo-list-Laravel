
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier une tâche</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm mx-auto border-0"
         style="max-width: 600px;">

        <div class="card-body p-4">

            <h1 class="h3 mb-4">Modifier la tâche</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.update', $task->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">
                        Titre
                    </label>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control"
                        value="{{ old('title', $task->title) }}"
                        required
                    >
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        class="form-control"
                        rows="4"
                    >{{ old('description', $task->description) }}</textarea>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="form-label">
                        Statut de la tâche
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select"
                        required
                    >
                        <option value="pending"
                            @selected(old('status', $task->status ?? 'pending') === 'pending')>
                            Pending
                        </option>

                        <option value="in_progress"
                            @selected(old('status', $task->status ?? 'pending') === 'in_progress')>
                            In Progress
                        </option>

                        <option value="completed"
                            @selected(old('status', $task->status ?? 'pending') === 'completed')>
                            Completed
                        </option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Enregistrer les modifications
                    </button>

                    <a href="{{ route('tasks.index') }}"
                       class="btn btn-outline-secondary">
                        Annuler
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>
