@extends('layouts/admin')

@section('content')
<div class="container __create-ctn text-white">
  <h1>Add a project</h1>

  {{-- we need to tell to the form thet it has to accept files as well, we add  enctype="multipart/form-data" to the form tag--}}
  <form action="{{route('admin.projects.store')}}" method="POST" class="py-5" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label for="name">Name</label>
      <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{old('name')}}">
      @error('name')

        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
        <label for="type_id">Type</label>
        <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
            <option>None</option>
            @foreach ($types as $type )
            <option value="{{$type->id}}" {{$type->id == old('type_id') ? 'selected' : ''}}>{{$type->name}}</option>
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
            @foreach ($technologies as $tech)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-check">
                    <input type="checkbox" id="technology-{{$tech->id}}" name="technologies[]" value="{{$tech->id}}" @checked(in_array($tech->id, old('technologies') ?? []))>
                    {{-- {{ old('technologies') && in_array($tech->id, old('technologies')) ? 'checked' : '' }} --}}
                    <label for="technology-{{$tech->id}}">{{$tech->name}}</label>
                </div>
            </div>
            @endforeach
        </div>
        @error('technologies')
        <div class="text-danger">
          {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-3">
      <label for="description">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{old('description')}}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
        <label for="repository">Repository</label>
        <input class="form-control @error('repository') is-invalid @enderror" type="text" id="repository" name="repository" value="{{old('repository')}}">
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

    <button type="submit" class="btn btn-primary fw-bold">Add Project</button>

  </form>


</div>

@endsection
