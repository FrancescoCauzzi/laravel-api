@extends('layouts\admin')

@section('content')
<div class="container text-white d-flex flex-column gap-4">
    <h1 >{{ucfirst($type->name)}}</h1>
    <hr>
    <div class="__type-description">
        <h4>Description</h4>
        <p>
            {{$type->description}}
        </p>
    </div>
    <div class="__nr-of-project">
        <h5>Projects with this type:</h5>
        @if(count($type->projects) > 0)
        <table class="table text-white">
            <thead>
                <th>Project name</th>
                <th>Slug</th>
                <th class="text-center">Edit</th>
            </thead>
            <tbody>
                @foreach($type->projects as $project)
                <tr>
                    <td>
                        {{$project->name}}
                    </td>
                    <td>
                        {{$project->slug}}
                    </td>
                    <td class="text-center">
                        <a class="fw-bold" href="{{route('admin.projects.edit', ['project' => $project->slug])}}"><i class="fa-solid fa-file-pen"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <em>No Project to show here</em>

        @endif


    </div>
    <div class="__btns-ctn d-flex gap-5">

        <div class="__edit-btn">
            <button class="btn btn-primary"><a class="fw-bold" href="{{route('admin.types.edit', ['type' => $type->slug])}}">Edit this type</a></button>
        </div>
        <form class="text-center mb-5" action="{{ route('admin.types.destroy', $type->slug) }}" method="POST">
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
                    <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Are you sure that you want to delete the type: {{$type->name}}?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- <div class="modal-body">
                    With this action you will delete this comic
                    </div> --}}
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- here specify type="submit" !!! otherwise nothing works --}}
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
                </div>
            </div>


        </form>

    </div>

</div>

@endsection
