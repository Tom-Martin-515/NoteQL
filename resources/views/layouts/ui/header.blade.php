<header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">

    {{-- Left: Page Title --}}
    <h5 class="mb-0">
        @yield('page-title', 'NoteQL')
    </h5>

    {{-- Right: Future actions (dark mode, user menu, etc.) --}}
    <div class="d-flex align-items-center">

        {{-- Mobile sidebar toggle --}}
        <button class="btn btn-outline-secondary d-md-none me-2 sidebar-toggle">
            <i class="bi bi-list"></i>
        </button>

        {{-- Placeholder for future header actions --}}
        <button class="btn btn-light disabled">
            <i class="bi bi-three-dots"></i>
        </button>

    </div>

</header>

