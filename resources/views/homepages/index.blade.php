@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Homepages</h1>
        <a href="{{ route('homepages.create') }}" class="btn btn-primary mb-3">Create New Homepage</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Role Line 1</th>
                <th>Role Line 2</th>
                <th>Flip Role</th>
                <th>Is Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($homepages as $homepage)
                <tr>
                    <td>{{ $homepage->id }}</td>
                    <td>{{ $homepage->role_line_1 }}</td>
                    <td>{{ $homepage->role_line_2 }}</td>
                    <td>{{ $homepage->flip_role }}</td>
                    <td>{{ $homepage->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('homepages.edit', $homepage) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('homepages.destroy', $homepage) }}" method="POST" style="display: inline-block;">
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
