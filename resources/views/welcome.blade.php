@extends('layouts.app')
@section('content')

<div class="container p-5 bg-light rounded-3 __jumbo">
    <div class=" d-flex">
        <div class="__welcome">

            <div class="logo_boolean">
                <img src="{{Vite::asset('resources/img/boolean-logo.png')}}" alt="">

            </div>
            <h1 class="display-5 fw-bold">
                Welcome to Boolfolio
            </h1>

            <p class="col-md-8 fs-4">This is my web application that present my projects during the Boolean-Web-Developer course</p>
        </div>
        <div class="__image">
            <img src="{{Vite::asset('resources/img/jumbo-image.jpg')}}" alt="">
        </div>

    </div>
</div>

@endsection
