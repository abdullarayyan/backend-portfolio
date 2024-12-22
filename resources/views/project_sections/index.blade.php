@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Project Sections</h1>
        <a href="{{ route('project_sections.create') }}" class="btn btn-primary mb-3">Add New Section</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Type</th>
                <th>Description</th>
                <th>Has Images</th>
                <th>Is Active</th>
                <th>Sort</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sections as $section)
                <tr>
                    <td>{{ $section->id }}</td>
                    <td>{{ $section->title }}</td>
                    <td>{{ $section->type }}</td>
                    <td>{{ $section->description }}</td>
                    <td>{{ $section->has_images ? 'Yes' : 'No' }}</td>
                    <td>{{ $section->is_active ? 'Yes' : 'No' }}</td>
                    <td>{{ $section->sort}}</td>
                    <td>
                        <a href="{{ route('project_sections.edit', $section) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('project_sections.destroy', $section) }}" method="post" style="display:inline;">
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
