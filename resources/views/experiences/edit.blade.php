@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Experience</h1>
        <form action="{{ route('experiences.update', $experience) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $experience->title }}" required>
            </div>
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" class="form-control" id="company" name="company" value="{{ $experience->company }}" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $experience->start_date }}" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $experience->end_date }}">
            </div>
            <div class="form-group">
                <label for="is_still_working">Still Working</label>
                <select class="form-control" id="is_still_working" name="is_still_working">
                    <option value="1" {{ $experience->is_still_working ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$experience->is_still_working ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ $experience->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$experience->is_active ? 'selected' : '' }}>Not Active</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
