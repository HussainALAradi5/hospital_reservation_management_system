<!DOCTYPE html>
<html>

<head>
    <title>Hospital System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('layouts.partials.header')

    <div class="container mt-4">
        @yield('content')
    </div>

    @include('layouts.partials.footer')
</body>

</html>
