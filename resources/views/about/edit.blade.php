@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit About Section</h1>
        <form action="{{ route('about.update', $about) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $about->title }}" required>
            </div>
            <div class="form-group">
                <label for="name_1">Name 1</label>
                <input type="text" class="form-control" id="name_1" name="name_1" value="{{ $about->name_1 }}" required>
            </div>
            <div class="form-group">
                <label for="name_2">Name 2</label>
                <input type="text" class="form-control" id="name_2" name="name_2" value="{{ $about->name_2 }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $about->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ $about->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$about->is_active ? 'selected' : '' }}>Not Active</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('about.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
