@extends('layouts.admin')

@section('content')
<div class="container text-white">
    <h1>{{ ucwords(Auth::user()->name )}}'s dashboard</h1>
    <ul class="d-flex gap-3">
        <li>
            <button class="btn btn-primary"><a class="fw-bold" href="{{route('admin.projects.index')}}">Show me all the projects</a></button>
        </li>
        <li>
            <button class="btn btn-primary"><a class="fw-bold" href="{{route('admin.types.index')}}">Show me all the types</a></button>
        </li>
        <li>
            <button class="btn btn-primary"><a class="fw-bold" href="{{route('admin.technologies.index')}}">Show me all the technologies</a></button>
        </li>
    </ul>
</div>
@endsection
