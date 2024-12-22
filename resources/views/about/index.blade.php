@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>About Sections</h1>
        <a href="{{ route('about.create') }}" class="btn btn-primary mb-3">Create New Section</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Name 1</th>
                <th>Name 2</th>
                <th>Description</th>
                <th>Is Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($abouts as $about)
                <tr>
                    <td>{{ $about->id }}</td>
                    <td>{{ $about->title }}</td>
                    <td>{{ $about->name_1 }}</td>
                    <td>{{ $about->name_2 }}</td>
                    <td>{{ $about->description }}</td>
                    <td>{{ $about->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('about.edit', $about) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('about.destroy', $about) }}" method="POST" style="display:inline;">
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
