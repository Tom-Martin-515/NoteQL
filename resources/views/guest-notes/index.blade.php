@extends('layouts.noteql')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<h1 class="mb-4">Guest Notes</h1>

{{-- Create Note Form --}}
<form action="{{ route('guest-notes.store') }}" method="POST" class="mb-4">
    @csrf
    <div class="mb-3">
        <label class="form-label">Note Content</label>
        <textarea name="note" class="form-control" rows="3" required></textarea>
    </div>
    <button class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>
        Add Note
    </button>
</form>

{{-- Empty State --}}
@if (count($notes) === 0)
    <div class="text-center text-muted py-5">
        <i class="bi bi-journal-text" style="font-size: 3rem;"></i>
        <p class="mt-3">No notes yet. Add your first one above.</p>
    </div>
@endif

{{-- Notes Grid --}}
<div class="row">
    @foreach ($notes as $note)
        <div class="col-md-4 mb-3 note-card">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">

                    {{-- Note content --}}
                    <p class="flex-grow-1 text-muted">
                        {{ Str::limit($note['content'], 150) }}
                    </p>

                    {{-- Priority stars --}}
                    <div class="d-flex align-items-center mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <form action="{{ route('guest-notes.priority', $note['id']) }}" method="POST" class="me-1">
                                @csrf
                                <input type="hidden" name="priority" value="{{ $i }}">
                                <button class="btn btn-link p-0 m-0">
                                    <i class="bi {{ $note['priority'] >= $i ? 'bi-star-fill text-warning' : 'bi-star' }}"></i>
                                </button>
                            </form>
                        @endfor
                    </div>

                    {{-- Footer row --}}
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <small class="text-secondary">Guest Note</small>

                        <form action="{{ route('guest-notes.destroy', $note['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection