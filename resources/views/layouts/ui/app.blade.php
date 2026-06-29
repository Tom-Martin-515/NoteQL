<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoteQL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <div class="d-flex">

        @include('layouts.ui.sidebar')

        <div class="flex-grow-1 d-flex flex-column min-vh-100">

            @include('layouts.ui.header')

            <main class="flex-grow-1 py-4">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>


            @include('layouts.ui.footer')

        </div>
    </div>

</body>
</html>
