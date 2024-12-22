@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Hero Section</h1>
        <form action="{{ route('hero-sections.update', $heroSection->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="role_line1">Role Line 1</label>
                <input type="text" class="form-control" id="role_line1" name="role_line1" value="{{ $heroSection->role_line1 }}" required>
            </div>
            <div class="form-group">
                <label for="role_line2">Role Line 2</label>
                <input type="text" class="form-control" id="role_line2" name="role_line2" value="{{ $heroSection->role_line2 }}">
            </div>
            <div class="form-group">
                <label for="flip_role">Flip Role</label>
                <input type="text" class="form-control" id="flip_role" name="flip_role" value="{{ $heroSection->flip_role }}">
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                <small class="form-text text-muted">Current: {{ $heroSection->profile_image }}</small>
            </div>
            <div class="form-group">
                <label for="click_image">Click Image</label>
                <input type="file" class="form-control-file" id="click_image" name="click_image">
                <small class="form-text text-muted">Current: {{ $heroSection->click_image }}</small>
            </div>
            <div class="form-group">
                <label for="angles_images">Angles Images (JSON Array)</label>
                <input type="text" class="form-control" id="angles_images" name="angles_images" value="{{ $heroSection->angles_images }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('hero-sections.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
