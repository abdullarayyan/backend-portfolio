@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Edit Media</h2>

        <form action="{{ route('media.update', ['medium' => $medium->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $medium->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Current File</label>
                <div>
                    @if($medium->type == 'image')
                        <img src="{{ asset('storage/' . $medium->file_path) }}" width="150">
                    @elseif($medium->type == 'video')
                        <video width="200" controls>
                            <source src="{{ asset('storage/' . $medium->file_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @elseif($medium->type == 'audio')
                        <audio controls>
                            <source src="{{ asset('storage/' . $medium->file_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Upload New File (Optional)</label>
                <input type="file" class="form-control" id="file" name="file" accept="image/*,video/*,audio/*">
                <small class="text-muted">Leave blank if you don't want to change the file.</small>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('media.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
