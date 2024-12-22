@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Hero Sections</h1>
            <a href="{{ route('hero-sections.create') }}" class="btn btn-primary mb-3">Add New</a>
            <table class="table">
                <thead>
                <tr>
                    <th>Role Line 1</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($heroSections as $section)
                    <tr>
                        <td>{{ $section->role_line1 }}</td>
                        <td>
                            <a href="{{ route('hero-sections.show', $section->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('hero-sections.edit', $section->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('hero-sections.destroy', $section->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
