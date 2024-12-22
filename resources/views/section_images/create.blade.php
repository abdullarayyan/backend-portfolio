@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Image to Section</h1>
        <form action="{{ route('section_images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="section_id">Section</label>
                <select class="form-control" id="section_id" name="section_id">
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="regular">Regular</option>
                    <option value="grid">Grid</option>
                </select>
            </div>
            <div class="form-group">
                <label for="path">Image</label>
                <input type="file" class="form-control-file" id="path" name="path" required>
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sort">Sort</label>
                <input type="number" min="0" name="sort" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Image</button>
        </form>
    </div>
@endsection
