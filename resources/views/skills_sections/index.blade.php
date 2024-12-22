@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Skills Sections</h1>
        <a href="{{ route('skills_sections.create') }}" class="btn btn-primary mb-3">Add New Skills Section</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($sections as $section)
                <tr>
                    <td>{{ $section->id }}</td>
                    <td>{{ $section->title }}</td>
                    <td>{{ $section->subtitle }}</td>
                    <td>{{ $section->description }}</td>
                    <td>
                        <a href="{{ route('skills_sections.edit', $section) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('skills_sections.destroy', $section) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No Skills Sections found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
