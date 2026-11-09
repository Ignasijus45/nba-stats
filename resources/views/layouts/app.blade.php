<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NBA Stats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/teams">🏀 NBA Stats</a>
            <a href="/teams" class="btn btn-dark btn-sm">Teams</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
