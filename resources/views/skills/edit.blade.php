@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Skill</h1>
        <form action="{{ route('skills.update', $skill) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $skill->title }}" required>
            </div>
            <div class="form-group">
                <label for="is_active">Status</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ $skill->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$skill->is_active ? 'selected' : '' }}>Not Active</option>
                </select>
            </div>
            <div class="form-group">
                <label for="skills_section_id">Skills Section</label>
                <select class="form-control" id="skills_section_id" name="skills_section_id">
                    <option value="" {{ !$skill->skills_section_id ? 'selected' : '' }}>None</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ $skill->skills_section_id == $section->id ? 'selected' : '' }}>
                            {{ $section->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
