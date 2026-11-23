<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de administrador</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Administración de equipos</span>

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
                    Panel de administración.
                </p>

                <div class="alert alert-primary">
                    Desde aquí podrás administrar los equipos y consultar
                    todas las reservaciones.
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.equipment.index') }}" class="btn btn-primary">
                        Administrar equipos
                    </a>

                    <a href="{{ route('admin.reservations.index') }}" class="btn btn-success">
                        Consultar reservaciones
                    </a>
                </div>

                <hr>

                <p>
                    <strong>Correo:</strong>
                    {{ Auth::user()->email }}
                </p>

                <p>
                    <strong>Rol:</strong> Administrador
                </p>
            </div>
        </div>
    </div>

</body>
</html>
