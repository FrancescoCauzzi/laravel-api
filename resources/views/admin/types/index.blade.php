
@extends('layouts.admin')

@section('content')

<div class="container py-2">
    <h1 class="text-white">Here are all the types</h1>
    <table class="text-white table">
        <thead>
            <th>Name</th>
            <th>Description</th>
            <th>N* of projects</th>
            <th>Show</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @foreach ($types as $type)
            <tr>
                <td>{{$type->name}}</td>
                <td>{{$type->description}}</td>

                <td class="text-center">{{count($type->projects)}}</td>
                <td class="text-center"><a href="{{route('admin.types.show', ['type' => $type])}}"><i class="fa-solid fa-magnifying-glass"></i></a>
                </td>
                <td class="text-center"><a href="{{route('admin.types.edit', ['type' => $type])}}"><i class="fa-solid fa-file-pen"></a></td>
                <td>
                    <form class="text-center mb-5" action="{{ route('admin.types.destroy', $type->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <!-- Button trigger modal -->
                        <i class="__trash-can fa-solid fa-trash-can" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $type->slug }}"></i>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop{{ $type->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Are you sure that you want to delete this type?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- With this action you will delete this comic --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        {{-- here specify type="submit" !!! otherwise nothing works --}}
                                        <button type="submit" class="btn btn-danger">Delete</button>
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
        <button class="btn btn-primary"><a class='fw-bold' href="{{route('admin.types.create')}}">Add a new type</a></button>
    </div>
</div>

@endsection
