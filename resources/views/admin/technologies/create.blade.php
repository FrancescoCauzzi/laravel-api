@extends('layouts/admin')

@section('content')
<div class="container __create-ctn text-white">
  <h1>Add a technology</h1>

  <form action="{{route('admin.technologies.store')}}" method="POST" class="py-5">
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
      <label for="description">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{old('description')}}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
        <label for="website">Website</label>
        <input class="form-control @error('website') is-invalid @enderror" type="text" name="website" id="website" value="{{old('website')}}">
        @error('website')

          <div class="invalid-feedback">
            {{$message}}
          </div>
        @enderror
      </div>


    <button type="submit" class="btn btn-primary fw-bold">Add Technology</button>

  </form>


</div>

@endsection

