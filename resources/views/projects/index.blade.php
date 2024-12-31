@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Projects</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add New Project</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Skill</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Type</th>
                <th>Image</th>
                <th>Is Active</th>
                <th>Sort</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->skill->title }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->subtitle }}</td>
                    <td>{{ $project->type }}</td>
                    <td><img src="{{ asset('storage/' . $project->image_src) }}" alt="Project Image" style="width: 100px;"></td>
                    <td>{{ $project->is_active ? 'Yes' : 'No' }}</td>
                    <td>{{ $project->sort}}</td>
                    <td>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
