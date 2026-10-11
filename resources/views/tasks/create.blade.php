<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter une tâche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body p-4">
                <h1 class="h3 mb-4">Ajouter une tâche</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">
                            Description
                        </label>
                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>



                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>

                        <select name="status" id="status" class="form-select">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">
                        Ajouter
                    </button>

                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                        Retour
                    </a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
