@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Homepage Image</h1>
        <form action="{{ route('homepage_images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="homepage_id">Homepage ID</label>
                <select class="form-control" id="homepage_id" name="homepage_id" required>
                    @foreach ($homepages as $homepage)
                        <option value="{{ $homepage->id }}">{{ $homepage->id }} - {{ $homepage->role_line_1 }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="profile">Profile</option>
                    <option value="click">Click</option>
                    <option value="angle">Angle</option>
                </select>
            </div>
            <div class="form-group">
                <label for="path">Image</label>
                <input type="file" class="form-control-file" id="path" name="path" required>
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" selected>Active</option>
                    <option value="0">Not Active</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sort">Sort</label>
                <input type="number" min="0" name="sort" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
