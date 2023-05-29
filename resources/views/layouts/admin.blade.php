@php

$routeName = Route::currentRouteName();
function routeNameContains($string) {
    return str_contains( Route::currentRouteName(), $string);
}

@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Boolfolio') }} &#x1F47D;</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        <header>
            @include('layouts/partials/header')
        </header>
        <main id="admin-layout">
            <div class="container-fluid px-4 d-flex gap-5">


                <aside id="admin-sidebar">
                    <div class="card {{ $routeName == 'admin.dashboard.home' ? 'border-primary' : '' }}">
                        <div class="card-header {{ $routeName == 'admin.dashboard.home' ? 'text-primary' : '' }} fs-5 fw-bold">
                            Dashboard
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="{{route('admin.dashboard.home')}}" class="list-group-item list-group-item-action  {{routeNameContains('admin.dashboard.home') ? '__active' : ''}}">Home</a>
                        </div>
                    </div>

                    <div class="card {{ routeNameContains('projects.') ? 'border-primary' : '' }} ">
                        <div class="card-header {{ routeNameContains('projects.') ? 'text-primary' : '' }} fs-5 fw-bold">
                            Projects
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="{{route('admin.projects.index')}}" class="list-group-item list-group-item-action {{routeNameContains('projects.index') ? '__active' : ''}}">All Projects</a>
                            <a href="{{route('admin.projects.create')}}" class="list-group-item list-group-item-action {{routeNameContains('projects.create') ? '__active' : ''}}">Add a project</a>
                        </div>
                    </div>

                    <div class="card {{ routeNameContains('types.') ? 'border-primary' : '' }}">
                        <div class="card-header {{ routeNameContains('types.') ? 'text-primary' : '' }} fs-5 fw-bold">
                            Types
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="{{route('admin.types.index')}}" class="list-group-item list-group-item-action {{routeNameContains('types.index') ? '__active' : ''}}">All the types</a>
                            <a href="{{route('admin.types.create')}}" class="list-group-item list-group-item-action {{routeNameContains('types.create') ? '__active' : ''}}">Add a type</a>
                        </div>
                    </div>
                    <div class="card {{ routeNameContains('technologies.') ? 'border-primary' : '' }}">
                        <div class="card-header {{ routeNameContains('technologies.') ? 'text-primary' : '' }} fs-5 fw-bold">
                            Technologies
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="{{route('admin.technologies.index')}}" class="list-group-item list-group-item-action {{routeNameContains('technologies.index') ? '__active' : ''}}">All the technologies</a>
                            <a href="{{route('admin.technologies.create')}}" class="list-group-item list-group-item-action {{routeNameContains('technologies.create') ? '__active' : ''}}">Add a technology</a>
                        </div>
                    </div>
                </aside>
                <div class="__content">
                    @yield('content')

                </div>
            </div>
        </main>
        <footer >
            @include('layouts/partials/footer')
        </footer>
    </div>
</body>

</html>
