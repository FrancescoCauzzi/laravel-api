
@extends('layouts.admin')

@section('content')

<div class="container py-2 text-white">
    <h1 class="">{{ucfirst($technology->name)}}</h1>
    <hr>
    <div class="__description mb-4">
        <h5>Description</h5>

        <p class="">
            {{$technology->description}}
        </p>
    </div>
    <div class="__website mb-4">
        <h5>Website</h5>
        <a href="{{$technology->website}}">{{$technology->website}}</a>
    </div>
    <div class="__btns-ctn d-flex gap-5">

        <div class="__edit-btn">
            <button class="btn btn-primary"><a class="fw-bold" href="{{route('admin.technologies.edit', ['technology' => $technology->slug])}}">Edit this technology</a></button>
        </div>
        <form class="text-center mb-5" action="{{ route('admin.technologies.destroy', $technology->slug) }}" method="POST">
            @csrf
            @method('DELETE')

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger text-uppercase fw-bold px-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Delete
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Are you sure that you want to delete the technology: {{$technology->name}}?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- <div class="modal-body">
                    With this action you will delete this comic
                    </div> --}}
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- here specify technology="submit" !!! otherwise nothing works --}}
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
                </div>
            </div>


        </form>

    </div>

</div>

@endsection
