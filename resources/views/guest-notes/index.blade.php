@extends('layouts.ui.app')

@section('page-title', 'Guest Notes')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')

@if (session('error'))
    <div class="alert alert-danger d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

{{-- Create Note Button --}}
<button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createNoteModal">
    <i class="bi bi-plus-circle me-1"></i>
    Create Note
</button>

{{-- Empty State --}}
@if (count($notes) === 0)
    <div class="text-center text-muted py-5">
        <i class="bi bi-journal-text" style="font-size: 3rem;"></i>
        <p class="mt-3">No notes yet. Create your first one above.</p>
    </div>
@endif

{{-- Notes Grid --}}
<div class="row">
    @foreach ($notes as $note)
        <div class="col-md-4 mb-3 note-card">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <p class="flex-grow-1 text-muted">{{ Str::limit($note['content'], 150) }}</p>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-secondary">Guest Note</small>

                        <form action="{{ route('guest-notes.destroy', $note['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger d-flex align-items-center">
                                <i class="bi bi-trash me-1"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- Create Note Modal --}}
<div class="modal fade" id="createNoteModal" tabindex="-1" aria-labelledby="createNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('guest-notes.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createNoteModalLabel">Create Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Note Content</label>
                    <textarea name="note" class="form-control" rows="4" required></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save Note</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection