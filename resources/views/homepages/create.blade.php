@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Homepage</h1>
        <form method="POST" action="{{ route('homepages.store') }}">
            @csrf
            <div class="form-group">
                <label for="role_line_1">Role Line 1</label>
                <input type="text" class="form-control" id="role_line_1" name="role_line_1" required>
            </div>
            <div class="form-group">
                <label for="role_line_2">Role Line 2</label>
                <input type="text" class="form-control" id="role_line_2" name="role_line_2">
            </div>
            <div class="form-group">
                <label for="flip_role">Flip Role</label>
                <input type="text" class="form-control" id="flip_role" name="flip_role">
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" selected>Active</option>
                    <option value="0">Not Active</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('homepages.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
