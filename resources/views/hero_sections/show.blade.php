@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Hero Section Details</h1>
            <p><strong>Role Line 1:</strong> {{ $heroSection->role_line1 }}</p>
            <!-- Add more fields as needed -->
            <a href="{{ route('hero-sections.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
