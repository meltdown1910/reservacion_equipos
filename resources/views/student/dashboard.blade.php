<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel del estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand">Reservación de equipos</span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </nav>

    <div class="container py-5">

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <h2>Bienvenido, {{ Auth::user()->name }}</h2>

                <p class="text-muted">
                    Panel principal del estudiante.
                </p>

                <div class="alert alert-primary">
                    Desde aquí podrás consultar los equipos disponibles,
                    realizar reservaciones y revisar tus propias reservaciones.
                </div>

                <p>
                    <strong>Correo:</strong>
                    {{ Auth::user()->email }}
                </p>

                <p>
                    <strong>Rol:</strong>
                    Estudiante
                </p>

                <hr>

                <h4 class="mb-3">Opciones del estudiante</h4>

                <div class="d-grid gap-3 d-md-flex">

                    <a href="{{ route('student.equipment.index') }}"
                       class="btn btn-primary">
                        Consultar equipos disponibles
                    </a>

                    <a href="{{ route('student.reservations.index') }}"
                       class="btn btn-success">
                        Mis reservaciones
                    </a>

                </div>

            </div>
        </div>

    </div>

</body>
</html>
