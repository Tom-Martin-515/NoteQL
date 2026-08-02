<nav class="sidebar bg-light border-end" style="width: 240px; min-height: 100vh;">

    <div class="p-3 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">NoteQL</h4>

        <div class="d-flex align-items-center">
            <button class="btn btn-sm btn-light d-none d-md-inline sidebar-collapse me-2">
                <i class="bi bi-chevron-left"></i>
            </button>
        </div>
    </div>

    <ul class="nav flex-column px-2">

        <!-- Notes (formerly Guest Notes) -->
        <li class="nav-item mb-2">
            <a href="{{ route('guest-notes.index') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('guest-notes.index') ? 'active' : '' }}">
                <i class="bi bi-journal-text me-2"></i>
                <span>Notes</span>
            </a>
        </li>

        <!-- User Notes (only visible when logged in) -->
        @auth
        <li class="nav-item mb-2">
            <a href="{{ route('user-notes.index') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('user-notes.index') ? 'active' : '' }}">
                <i class="bi bi-person-lines-fill me-2"></i>
                <span>User Notes</span>
            </a>
        </li>
        @endauth

        <li class="nav-item mb-2">
            <a href="{{ route('settings.index') }}"
                class="nav-link d-flex align-items-center {{ request()->routeIs('settings.index') ? 'active' : '' }}">
                <i class="bi bi-gear me-2"></i>
                <span>Settings</span>
            </a>
        </li>

    </ul>
</nav>

