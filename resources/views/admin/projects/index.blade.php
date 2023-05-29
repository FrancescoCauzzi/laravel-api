
@extends('layouts.admin')

@section('content')

@php
function truncateText($text, $length = 30, $ending = '...')
{
    if (mb_strlen($text) <= $length) {
        return $text;
    }

    $truncatedText = rtrim(mb_substr($text, 0, $length - mb_strlen($ending))) . $ending;
    return $truncatedText;
}
@endphp

<div class="container py-2">
    <h1 class="text-white">Here are all the projects</h1>
    <table class="text-white table">
        <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Type</th>
            <th>Technologies</th>
            <th>Repository</th>
            <th>Show</th>
            <th>Edit</th>
            <th>Delete</th>

        </thead>
        <tbody>
            @foreach ($projects as $project)


            <tr>
                <td>{{$project->name}}</td>
                <td>{{truncateText($project->description)}}</td>
                @if ($project->cover_image)
                <th>{{ truncateText($project->cover_image) }}</th>
                @else
                <th></th>
                @endif
                <td>{{$project->type?->name}}</td>
                <td>
                    @foreach ($project->technologies as $tech)
                    <span class="mx-1">{{$tech->name}}</span>
                    @endforeach
                </td>
                <td>{{$project->repository}}</td>
                <td class="text-center"><a href="{{route('admin.projects.show', ['project' => $project])}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                <td class="text-center"><a href="{{route('admin.projects.edit', ['project' => $project])}}"><i class="fa-solid fa-file-pen"></a></td>

                <td>
                    <form class="text-center mb-5" action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <!-- Button trigger modal -->
                        <i class="__trash-can fa-solid fa-trash-can" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $project->slug }}"></i>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop{{ $project->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Are you sure that you want to delete this project?</h1>
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

                    {{-- <form class="text-center mb-5" action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <!-- Button trigger modal -->
                        <i class=" fa-solid fa-trash-can" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        </i>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Are you sure that you want to delete this project?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                // <div class="modal-body">
                                <!-- With this action you will delete this comic -->
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 <!-- here specify type="submit" !!! otherwise nothing works -->
                                <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form> --}}

                </td>




            </tr>

            @endforeach
        </tbody>
    </table>
    <hr>
    <div class="__btns-ctn py-3">
        <button class="btn btn-primary"><a class='fw-bold' href="{{route('admin.projects.create')}}">Add a new project</a></button>
    </div>
</div>

@endsection
