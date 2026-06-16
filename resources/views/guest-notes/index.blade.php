@extends('layouts.noteql')

@section('content')
    <h1 class="mb-4">Guest Notes</h1>

    {{-- Create Note Form --}}
    <form action="{{ route('guest-notes.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">Note Content</label>
            <textarea name="note" class="form-control" rows="3" required></textarea>
        </div>
        <button class="btn btn-primary">Add Note</button>
    </form>

    {{-- Notes Grid --}}
    <div class="row">
        @foreach ($notes as $note)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p>{{ $note['content'] }}</p>

                        <form action="{{ route('guest-notes.destroy', $note['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection