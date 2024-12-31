@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Section Images</h1>
        <a href="{{ route('section_images.create') }}" class="btn btn-primary mb-3">Add New Image</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>project</th>
                <th>Section</th>
                <th>Type</th>
                <th>Path</th>
                <th>Is Active</th>
                <th>Sort</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td>{{ $image->section->project->title }}</td>
                    <td>{{ $image->section->title }}</td>
                    <td>{{ $image->type }}</td>
                    <td><img src="{{ Storage::url($image->path) }}" alt="Image" style="width: 100px;"></td>
                    <td>{{ $image->is_active ? 'Yes' : 'No' }}</td>
                    <td>{{ $image->sort}}</td>

                    <td>
                        <a href="{{ route('section_images.edit', $image) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('section_images.destroy', $image) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
