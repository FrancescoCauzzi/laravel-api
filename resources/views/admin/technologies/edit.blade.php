@extends('layouts/admin')

@section('content')
<div class=" __create-ctn text-white">
  <h1>Edit a technology</h1>

  <form action="{{route('admin.technologies.update', $technology->slug)}}" method="POST" class="">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="name">Name</label>
      <input class="form-control @error('name') is-invalid @enderror" technology="text" name="name" id="name" value="{{old('name') ?? $technology->name}}">
      @error('name')

        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>


    <div class="mb-3">
      <label for="description">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{old('description') ?? $technology->description}}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
        <label for="website">Website</label>
        <input class="form-control @error('website') is-invalid @enderror" technology="text" name="website" id="website" value="{{old('website') ?? $technology->website}}">
        @error('website')

          <div class="invalid-feedback">
            {{$message}}
          </div>
        @enderror
    </div>





    <button technology="submit" class="btn btn-primary fw-bold text-uppercase">Edit this technology</button>

  </form>


</div>

@endsection

