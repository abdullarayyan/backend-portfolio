@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Project Section</h1>
        <form action="{{ route('project_sections.update', $projectSection) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="project_id">Project</label>
                <select class="form-control" id="project_id" name="project_id">
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ $project->id == $projectSection->project_id ? 'selected' : '' }}>{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="normal_section" {{ $projectSection->type == 'normal_section' ? 'selected' : '' }}>Normal Section</option>
                    <option value="slider_section" {{ $projectSection->type == 'slider_section' ? 'selected' : '' }}>Slider Section</option>
                    <option value="grid_section" {{ $projectSection->type == 'grid_section' ? 'selected' : '' }}>Grid Section</option>
                    <option value="AfterBefore" {{ $projectSection->type == 'AfterBefore' ? 'selected' : '' }}>After Before  Section</option>
                    <option value="numbers" {{ $projectSection->type == 'numbers' ? 'selected' : '' }}>Number Section</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $projectSection->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $projectSection->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="has_images">Has Images</label>
                <select class="form-control" id="has_images" name="has_images">
                    <option value="0" {{ !$projectSection->has_images ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $projectSection->has_images ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ $projectSection->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$projectSection->is_active ? 'selected' : '' }}>Not Active</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sort">Sort</label>
                <input type="number" min="0" name="sort" value="{{$projectSection->sort??'-'}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
