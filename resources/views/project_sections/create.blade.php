@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Project Section</h1>
        <form action="{{ route('project_sections.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="project_id">Project</label>
                <select class="form-control" id="project_id" name="project_id">
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="intro">Intro</option>
                    <option value="work_process">Work Process</option>
                    <option value="outcomes">Outcomes</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="has_images">Has Images</label>
                <select class="form-control" id="has_images" name="has_images">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1">Active</option>
                    <option value="0">Not Active</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sort">Sort</label>
                <input type="number" min="0" name="sort" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
