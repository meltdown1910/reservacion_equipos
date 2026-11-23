<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis reservaciones</title>
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
            <h2>Mis reservaciones</h2>

            <a href="{{ route('student.equipment.index') }}" class="btn btn-primary">
                Consultar equipos
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

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>Equipo</th>
                                <th>Código</th>
                                <th>Ubicación</th>
                                <th>Fecha de reservación</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($reservations as $reservation)

                                <tr>
                                    <td>
                                        {{ $reservation->equipment->name }}
                                    </td>

                                    <td>
                                        {{ $reservation->equipment->code }}
                                    </td>

                                    <td>
                                        {{ $reservation->equipment->location ?? 'Sin ubicación' }}
                                    </td>

                                    <td>
                                        {{ $reservation->reserved_at->format('d/m/Y H:i') }}
                                    </td>

                                    <td>
                                        @if ($reservation->status === 'active')
                                            <span class="badge bg-success">
                                                Activa
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Cancelada
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($reservation->status === 'active')

                                            <form action="{{ route('student.reservations.cancel', $reservation->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('¿Deseas cancelar esta reservación?')">

                                                @csrf

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Cancelar
                                                </button>

                                            </form>

                                        @else

                                            <span class="text-muted">
                                                Sin acciones
                                            </span>

                                        @endif
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        Todavía no tienes reservaciones.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">
                Volver al panel
            </a>
        </div>

    </div>

</body>
</html>
