@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Marquee Items</h1>
        <a href="{{ route('marquee_items.create') }}" class="btn btn-primary mb-3">Add New Item</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Content</th>
                <th>Is Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($marqueeItems as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->content }}</td>
                    <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('marquee_items.edit', $item) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('marquee_items.destroy', $item) }}" method="POST" style="display:inline;">
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
