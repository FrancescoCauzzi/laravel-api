@extends('layouts\admin')

@section('content')
<div class="container text-white d-flex flex-column gap-4">
    <h1 >{{ucfirst($project->name)}}</h1>
    <hr>
    @if ( $project->cover_image)

    <div class="__proj-image">
        <h5>Project Cover</h5>
        <img src="{{asset('storage/' . $project->cover_image)}}" alt="">
    </div>
    @endif

    <div class="__proj-type">
        <h5>Project Type:</h5>
        <span>{{ $project->type->name ?? 'not specified'}}</span>
    </div>

    @if (count($project->technologies) >0)
    <div class="__proj-tech">
        <h5>Project Technologies:</h5>
        @foreach ($project->technologies as $tech )
        <span class="badge rounded-pill bg-primary">{{$tech->name}}</span>
        @endforeach
    </div>
    @endif
    <div class="__proj-description">
        <h4>Description</h4>
        <p>
            {{$project->description}}
        </p>
    </div>

    <div class="__repository-url">
        <h4>Repository:</h4>
        <div class="">
            {{-- In HTML, the target="_blank" attribute is used to specify that a link should open in a new browser window or tab when clicked. When you set the target attribute to _blank, the linked document or URL will be loaded into a new browsing context, separate from the current page. --}}
          <a href="{{$project->repository}}" target="_blank">Github</a>
        </div>
    </div>

    <div class="__btns-ctn d-flex gap-5">

        <div class="__edit-btn">
            <button class="btn btn-primary"><a class="fw-bold" href="{{route('admin.projects.edit', ['project' => $project->slug])}}">Edit this project</a></button>
        </div>
        <form class="text-center mb-5" action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
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
                    <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Are you sure that you want to delete this project?</h1>
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
