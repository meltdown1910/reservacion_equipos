<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Equipos disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a href="{{ route('student.dashboard') }}" class="navbar-brand">
                Panel del estudiante
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
            <div>
                <h2>Equipos disponibles</h2>
                <p class="text-muted mb-0">
                    Selecciona el equipo que deseas reservar.
                </p>
            </div>

            <a href="{{ route('student.reservations.index') }}" class="btn btn-success">
                Mis reservaciones
            </a>
        </div>

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

        <div class="row">

            @forelse ($equipment as $item)

                <div class="col-md-6 col-lg-4 mb-4">

                    <div class="card shadow-sm h-100">

                        <div class="card-body">

                            <h5 class="card-title">
                                {{ $item->name }}
                            </h5>

                            <p class="mb-2">
                                <strong>Código:</strong>
                                {{ $item->code }}
                            </p>

                            <p class="mb-2">
                                <strong>Descripción:</strong>
                                {{ $item->description ?? 'Sin descripción' }}
                            </p>

                            <p class="mb-3">
                                <strong>Ubicación:</strong>
                                {{ $item->location ?? 'Sin ubicación' }}
                            </p>

                            <span class="badge bg-success mb-3">
                                Disponible
                            </span>

                            <form action="{{ route('student.equipment.reserve', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Deseas reservar este equipo?')">

                                @csrf

                                <button type="submit" class="btn btn-primary w-100">
                                    Reservar equipo
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Actualmente no hay equipos disponibles.
                    </div>
                </div>

            @endforelse

        </div>

        <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">
            Volver al panel
        </a>

    </div>

</body>
</html>
