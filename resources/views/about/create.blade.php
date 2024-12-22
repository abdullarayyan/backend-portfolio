@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create About Section</h1>
        <form action="{{ route('about.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="name_1">Name 1</label>
                <input type="text" class="form-control" id="name_1" name="name_1" required>
            </div>
            <div class="form-group">
                <label for="name_2">Name 2</label>
                <input type="text" class="form-control" id="name_2" name="name_2" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" selected>Active</option>
                    <option value="0">Not Active</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('about.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
