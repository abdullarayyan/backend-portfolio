@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Projects</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add New Project</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Skill</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Type</th>
                <th>Image</th>
                <th>Mobile Image</th>
                <th>Is Active</th>
                <th>Sort</th>
                <th>Subscribers</th>
                <th>Satisfaction Rate</th>
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
                    <td>
                        @if($project->image_mobile)
                            <img src="{{ asset('storage/' . $project->image_mobile) }}" style="width: 100px;">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $project->is_active ? 'Yes' : 'No' }}</td>
                    <td>{{ $project->sort}}</td>
                    <td>
                        <form action="{{ route('projects.update', $project->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="subscribers" value="{{ $project->subscribers }}" class="form-control form-control-sm" style="width: 80px; display:inline-block;">
                            <button type="submit" class="btn btn-sm btn-success">✔</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('projects.update', $project->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="satisfaction_rate" value="{{ $project->satisfaction_rate }}" min="0" max="100" class="form-control form-control-sm" style="width: 80px; display:inline-block;">
                            <button type="submit" class="btn btn-sm btn-success">✔</button>
                        </form>
                    </td>

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
