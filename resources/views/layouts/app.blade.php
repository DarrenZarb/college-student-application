<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College & Student Management</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS (optional) -->
    <style>
        body {
            padding-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">College & Student Management</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/colleges">Colleges</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/students">Students</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        @yield('content')

    </div>

    <!-- Bootstrap JS & Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
