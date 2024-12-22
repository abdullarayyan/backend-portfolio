@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Experiences</h1>
        <a href="{{ route('experiences.create') }}" class="btn btn-primary mb-3">Add New Experience</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Company</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Still Working</th>
                <th>Is Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($experiences as $experience)
                <tr>
                    <td>{{ $experience->id }}</td>
                    <td>{{ $experience->title }}</td>
                    <td>{{ $experience->company }}</td>
                    <td>{{ $experience->start_date }}</td>
                    <td>{{ $experience->end_date ?? 'N/A' }}</td>
                    <td>{{ $experience->is_still_working ? 'Yes' : 'No' }}</td>
                    <td>{{ $experience->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('experiences.edit', $experience) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('experiences.destroy', $experience) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
