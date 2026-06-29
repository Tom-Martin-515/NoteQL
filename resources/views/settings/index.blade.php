@extends('layouts.ui.app')

@section('page-title', 'Settings')

@section('content')

<div class="ui-section ui-fade-in">

    <h4 class="mb-4">Appearance</h4>

    {{-- Dark Mode Toggle (logic added in next steps) --}}
    <div class="form-check form-switch mb-4">
        <input class="form-check-input" type="checkbox" id="darkModeToggle">
        <label class="form-check-label" for="darkModeToggle">
            Enable Dark Mode
        </label>
    </div>

</div>

@endsection
