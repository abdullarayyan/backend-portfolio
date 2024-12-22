@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Marquee Item</h1>
        <form action="{{ route('marquee_items.update', $marqueeItem) }}" method="POST">
            @csrf
            @method('PUT')  <!-- Important for routing the update correctly -->
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" class="form-control" id="content" name="content" value="{{ $marqueeItem->content }}" required>
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ $marqueeItem->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$marqueeItem->is_active ? 'selected' : '' }}>Not Active</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('marquee_items.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
