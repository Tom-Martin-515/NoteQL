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

        {{-- Sidebar --}}
        <nav class="sidebar bg-light border-end" style="width: 240px; min-height: 100vh;">

            <div class="p-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">NoteQL</h4>

                {{-- Collapse button (desktop) --}}
                <button class="btn btn-sm btn-light d-none d-md-inline sidebar-collapse">
                    <i class="bi bi-chevron-left"></i>
                </button>
            </div>

            <ul class="nav flex-column px-2">

                <li class="nav-item mb-2">
                    <a href="{{ route('guest-notes.index') }}" class="nav-link d-flex align-items-center">
                        <i class="bi bi-journal-text me-2"></i>
                        <span>Guest Notes</span>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center disabled">
                        <i class="bi bi-person-lines-fill me-2"></i>
                        <span>User Notes</span>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center disabled">
                        <i class="bi bi-gear me-2"></i>
                        <span>Settings</span>
                    </a>
                </li>

            </ul>
        </nav>

        {{-- Main content --}}
        <div class="flex-grow-1 p-4">

            {{-- Mobile toggle --}}
            <button class="btn btn-outline-secondary sidebar-toggle d-md-none mb-3">
                <i class="bi bi-list"></i>
            </button>

            @yield('content')

        </div>

    </div>

</body>
</html>