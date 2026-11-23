<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel - Reservación de equipos</title>

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
                    Tu sesión está activa.
                </p>

                <p>
                    <strong>Correo:</strong>
                    {{ Auth::user()->email }}
                </p>

                <p>
                    <strong>Rol:</strong>
                    {{ Auth::user()->role === 'admin' ? 'Administrador' : 'Estudiante' }}
                </p>

            </div>
        </div>
    </div>

</body>
</html>
