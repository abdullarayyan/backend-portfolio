@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Skills</h1>
        <a href="{{ route('skills.create') }}" class="btn btn-primary mb-3">Add New Skill</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Section</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($skills as $skill)
                <tr>
                    <td>{{ $skill->id }}</td>
                    <td>{{ $skill->title }}</td>
                    <td>{{ $skill->is_active ? 'Active' : 'Not Active' }}</td>
                    <td>{{ $skill->section ? $skill->section->title : 'None' }}</td>
                    <td>
                        <a href="{{ route('skills.edit', $skill) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('skills.destroy', $skill) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No Skills found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
