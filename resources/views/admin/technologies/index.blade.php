
@extends('layouts.admin')

@section('content')

<div class="container py-2">
    <h1 class="text-white">Here are all the technologies</h1>
    <table class="text-white table">
        <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Website</th>
            <th>N° of Projects</th>
            <th>Show</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)
            <tr>
                <td>{{$technology->name}}</td>
                <td>{{$technology->description}}</td>
                <td><a href="{{$technology->website}}">{{$technology->website}}</a></td>
                <td class="text-center">{{count($technology->projects)}}</td>
                 <td class="text-center"><a href="{{route('admin.technologies.show', ['technology' => $technology])}}"><i class="fa-solid fa-magnifying-glass"></i></a>
                </td>
                <td class="text-center"><a href="{{route('admin.technologies.edit', ['technology' => $technology])}}"><i class="fa-solid fa-file-pen"></a></td>
                <td>
                    <form class="text-center mb-5" action="{{ route('admin.technologies.destroy', $technology->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <!-- Button trigger modal -->
                        <i class="__trash-can fa-solid fa-trash-can" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $technology->slug }}"></i>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop{{ $technology->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Are you sure that you want to delete this technology?</h1>
                                        <button technology="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- With this action you will delete this comic --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button technology="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        {{-- here specify technology="submit" !!! otherwise nothing works --}}
                                        <button technology="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </td>

            </tr>

            @endforeach
        </tbody>
    </table>
    <hr>
    <div class="__btns-ctn py-3">
        <button class="btn btn-primary"><a class='fw-bold' href="{{route('admin.technologies.create')}}">Add a new technology</a></button>
    </div>
</div>

@endsection
