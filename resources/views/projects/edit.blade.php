@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Project</h1>
        <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}" required>
            </div>
            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ $project->subtitle }}" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" class="form-control" id="type" name="type" value="{{ $project->type }}" required>
            </div>
            <div class="form-group">
                <label for="image_src">Change Image (optional)</label>
                <input type="file" class="form-control-file" id="image_src" name="image_src">
                Current Image: <img src="{{ asset('storage/' . $project->image_src) }}" width="100">
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ $project->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$project->is_active ? 'selected' : '' }}>Not Active</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sort">Sort</label>
                <input type="number" min="0" name="sort" value="{{$project->sort??'-'}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Project</button>
        </form>
    </div>
@endsection
