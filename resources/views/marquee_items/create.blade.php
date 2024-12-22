@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Marquee Item</h1>
        <form action="{{ route('marquee_items.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" class="form-control" id="content" name="content" required>
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" selected>Active</option>
                    <option value="0">Not Active</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
