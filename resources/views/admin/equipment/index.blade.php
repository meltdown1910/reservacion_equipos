<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrar equipos</title>
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

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Equipos registrados</h2>

            <a href="{{ route('admin.equipment.create') }}" class="btn btn-primary">
                Registrar equipo
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
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

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Ubicación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($equipment as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>

                                    <td>{{ $item->name }}</td>

                                    <td>{{ $item->code }}</td>

                                    <td>
                                        {{ $item->description ?? 'Sin descripción' }}
                                    </td>

                                    <td>
                                        {{ $item->location ?? 'Sin ubicación' }}
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">

                                            <a href="{{ route('admin.equipment.edit', $item->id) }}"
                                               class="btn btn-warning btn-sm">
                                                Editar
                                            </a>

                                            <form action="{{ route('admin.equipment.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este equipo?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Eliminar
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        Todavía no hay equipos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                Volver al panel
            </a>
        </div>

    </div>

</body>
</html>
