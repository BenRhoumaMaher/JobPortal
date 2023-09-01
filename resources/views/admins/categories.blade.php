@extends('layouts.admin')

@section('content')


@if (session()->has('createcategory'))
    <p class="container alert alert-success text-center">{{ session('createcategory') }}</p>
@endif
@if (session()->has('updatecategory'))
    <p class="container alert alert-success text-center">{{ session('updatecategory') }}</p>
@endif
@if (session()->has('deletecategory'))
    <p class="container alert alert-success text-center">{{ session('deletecategory') }}</p>
@endif
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Categories</h5>
         <a  href="{{ route('create.categories') }}" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">update</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td><a  href="{{ route('edit.categories',$category->id) }}" class="btn btn-warning text-white text-center ">Update </a></td>
                    <form action="{{ route('delete.categories',$category->id) }}" method="POST">
                        @csrf
                        <td><button type="submit" name="submit" class="btn btn-danger  text-center ">Delete </button></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>

@endsection
