<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A comprehensive portfolio project showcasing various features.">
    <meta name="author" content="Your Name">
    <title>Portfolio Project</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Portfolio Project</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('homepages.index') }}">Homepages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('homepage_images.index') }}">Homepage Images</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('about.index') }}">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('marquee_items.index') }}">Marquee Items</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('experiences.index') }}">Experiences</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('skills.index') }}">Skills</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('skills_sections.index') }}">skill Sections</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('projects.index') }}">Projects</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('project_sections.index') }}">Project Sections</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('section_images.index') }}">Section Images</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
