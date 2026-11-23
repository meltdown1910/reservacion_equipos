<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar equipo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
                Panel de administración
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </nav>

    <div class="container py-5">
        <div class="card shadow-sm mx-auto" style="max-width: 650px;">
            <div class="card-body p-4">

                <h2 class="mb-4">Editar equipo</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.equipment.update', $equipment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nombre del equipo</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $equipment->name) }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Código del equipo</label>
                        <input
                            type="text"
                            name="code"
                            class="form-control"
                            value="{{ old('code', $equipment->code) }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea
                            name="description"
                            class="form-control"
                            rows="3"
                        >{{ old('description', $equipment->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ubicación</label>
                        <input
                            type="text"
                            name="location"
                            class="form-control"
                            value="{{ old('location', $equipment->location) }}"
                        >
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.equipment.index') }}" class="btn btn-secondary">
                            Regresar
                        </a>

                        <button type="submit" class="btn btn-success">
                            Actualizar equipo
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</body>
</html>
