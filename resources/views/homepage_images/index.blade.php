@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Homepage Images</h1>
        <a href="{{ route('homepage_images.create') }}" class="btn btn-primary mb-3">Add New Image</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Homepage ID</th>
                <th>Type</th>
                <th>Image</th>
                <th>Is Active</th>
                <th>Sort</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td>{{ $image->homepage_id }}</td>
                    <td>{{ $image->type }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $image->path) }}" width="100" alt="Image">
                    </td>
                    <td>{{ $image->is_active ? 'Yes' : 'No' }}</td>
                    <td>{{ $image->sort}}</td>
                    <td>
                        <a href="{{ route('homepage_images.edit', $image) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('homepage_images.destroy', $image) }}" method="POST" style="display:inline;">
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
