@extends('layouts.app')


@section('content')
    <div class="container mt-5">
        <h2>All Media</h2>

        <a href="{{ route('media.create') }}" class="btn btn-primary mb-3">Upload New Media</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Title</th>
                <th>File</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($media as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>
                        @if($item->type == 'image')
                            <img src="{{ asset('storage/' . $item->file_path) }}" width="100">
                        @elseif($item->type == 'video')
                            <video width="100" controls>
                                <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                            </video>
                        @elseif($item->type == 'audio')
                            <audio controls>
                                <source src="{{ asset('storage/' . $item->file_path) }}" type="audio/mpeg">
                            </audio>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('media.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('media.destroy', $item->id) }}" method="POST" style="display:inline;">
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
