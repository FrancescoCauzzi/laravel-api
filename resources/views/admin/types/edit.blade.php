@extends('layouts/admin')

@section('content')
<div class=" __create-ctn text-white">
  <h1>Edit a type</h1>

  <form action="{{route('admin.types.update', $type->slug)}}" method="POST" class="">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="name">Name</label>
      <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{old('name') ?? $type->name}}">
      @error('name')

        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>


    <div class="mb-3">
      <label for="description">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{old('description') ?? $type->description}}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>





    <button type="submit" class="btn btn-primary fw-bold text-uppercase">Edit this Type</button>

  </form>


</div>

@endsection
