@extends('layouts/admin')

@section('content')
<div class=" __create-ctn text-white">
  <h1>Edit this project</h1>

  <form action="{{route('admin.projects.update', $project->slug)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="name">Name</label>
      <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{old('name') ?? $project->name}}">
      @error('name')

        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
        <label for="name">Type</label>
        <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="">

            <option >None</option>

            @foreach ($types as $type )
            <option value="{{$type->id}}" {{$type->id == old('type_id', $project->type_id) ? 'selected' : ''}}>{{$type->name}}</option>
            @endforeach
        </select>
        @error('type_id')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
        <h6>Technologies</h6>
        <div class="row">
            @foreach ($technologies as $technology)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-check">
                    @if($errors->any())
                        <input id="technology_{{$technology->id}}" name="technologies[]" type="checkbox" value="{{$technology->id}}" @checked(in_array($technology->id, old('technologies', [])))>
                    @else
                        <input id="technology_{{$technology->id}}" name="technologies[]" type="checkbox" value="{{$technology->id}}" @checked($project->technologies->contains($technology->id))>
                    @endif
                        <label for="technology-{{$technology->id}}">{{$technology->name}}</label>
                </div>
            </div>
            @endforeach
        </div>
        @error('technologies')
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-3">
      <label for="description">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{old('description') ?? $project->description}}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
        <label for="repository">Repository</label>
        <input class="form-control @error('repository') is-invalid @enderror" type="text" id="repository" name="repository" value="{{old('repository') ?? $project->repository}}">
        @error('repository')
          <div class="invalid-feedback">
            {{$message}}
          </div>
        @enderror
    </div>
    {{-- file insertion down here here --}}
    <div class="mb-3">
        <label for="cover_image">Project image</label>
        <input class="form-control @error('cover_image') is-invalid @enderror" type="file" id="cover_image" name="cover_image" value="{{old('cover_image')}}">
        @error('cover_image')
          <div class="invalid-feedback">
            {{$message}}
          </div>
        @enderror
    </div>



    <button type="submit" class="btn btn-primary fw-bold">Edit this Project</button>

  </form>


</div>

@endsection
