@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Homepage Image</h1>
        <form action="{{ route('homepage_images.update', $homepageImage) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="homepage_id">Homepage ID</label>
                <select class="form-control" id="homepage_id" name="homepage_id" required>
                    @foreach ($homepages as $homepage)
                        <option value="{{ $homepage->id }}" {{ $homepageImage->homepage_id == $homepage->id ? 'selected' : '' }}>
                            {{ $homepage->id }} - {{ $homepage->role_line_1 }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="profile" {{ $homepageImage->type == 'profile' ? 'selected' : '' }}>Profile</option>
                    <option value="click" {{ $homepageImage->type == 'click' ? 'selected' : '' }}>Click</option>
                    <option value="angle" {{ $homepageImage->type == 'angle' ? 'selected' : '' }}>Angle</option>
                </select>
            </div>
            <div class="form-group">
                <label for="path">Change Image</label>
                <input type="file" class="form-control-file" id="path" name="path">
                <img src="{{ asset('storage/' . $homepageImage->path) }}" width="100" alt="Current Image">
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ $homepageImage->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$homepageImage->is_active ? 'selected' : '' }}>Not Active</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sort">Sort</label>
                <input type="number" min="0" name="sort" value="{{$homepageImage->sort??'-'}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
