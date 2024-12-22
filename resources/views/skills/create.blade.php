@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Skill</h1>
        <form action="{{ route('skills.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="is_active">Status</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" selected>Active</option>
                    <option value="0">Not Active</option>
                </select>
            </div>
            <div class="form-group">
                <label for="skills_section_id">Skills Section</label>
                <select class="form-control" id="skills_section_id" name="skills_section_id">
                    <option value="" selected>None</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
