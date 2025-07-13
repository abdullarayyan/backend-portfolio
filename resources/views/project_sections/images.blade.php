@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Images for Section: {{ $section->title }}</h1>

        <a href="{{ route('section_images.create', ['section_id' => $section->id]) }}" class="btn btn-primary mb-3">Add New Image</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Project</th>
                <th>Section</th>
                <th>Type</th>
                <th>Path</th>
                <th>Is Active</th>
                <th>Sort</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td>{{ $section->project->title }}</td>
                    <td>{{ $section->title }}</td>
                    <td>{{ $image->type }}</td>
                    <td><img src="{{ asset('storage/' . $image->path) }}" alt="Image" style="width: 100px;"></td>
                    <td>{{ $image->is_active ? 'Yes' : 'No' }}</td>
                    <td>{{ $image->sort }}</td>
                    <td>
                        <a href="{{ route('section_images.edit', $image) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('section_images.destroy', $image) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No images available for this section.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <a href="{{ route('project_sections.index') }}" class="btn btn-secondary">⬅ Back to Sections</a>
    </div>
@endsection
