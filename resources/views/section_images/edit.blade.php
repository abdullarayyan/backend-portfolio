@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Image Details</h1>
        <form action="{{ route('section_images.update', ['section_image' => $sectionImage->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="section_id">Section</label>
                <select class="form-control" id="section_id" name="section_id">
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}" {{ $section->id == $sectionImage->section_id ? 'selected' : '' }}>{{ $section->project->title .' - ' .$section->title  }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="regular" {{ $sectionImage->type == 'regular' ? 'selected' : '' }}>Regular</option>
                    <option value="grid" {{ $sectionImage->type == 'grid' ? 'selected' : '' }}>Grid</option>
                </select>
            </div>
            <div class="form-group">
                <label for="path">Change Image (optional)</label>
                <input type="file" class="form-control-file" id="path" name="path">
                Current Image: <img src="{{ Storage::url($sectionImage->path) }}" alt="Image" style="width: 100px;">
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ $sectionImage->is_active ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$sectionImage->is_active ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sort">Sort</label>
                <input type="number" min="0" name="sort" value="{{$sectionImage->sort??'-'}}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
