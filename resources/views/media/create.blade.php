@extends('layouts.app')


@section('content')
    <div class="container mt-5">
        <h2>Upload Media</h2>

        <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">File (Image, Video, Audio)</label>
                <input type="file" class="form-control" id="file" name="file" accept="image/*,video/*,audio/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
            <a href="{{ route('media.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
