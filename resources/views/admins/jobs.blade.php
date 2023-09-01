@extends('layouts.admin')

@section('content')

@if (session()->has('createjob'))
    <p class="container alert alert-success text-center">{{ session('createjob') }}</p>
@endif
@if (session()->has('deletejob'))
    <p class="container alert alert-success text-center">{{ session('deletejob') }}</p>
@endif
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Jobs</h5>
          <a  href="{{ route('create.jobs') }}" class="btn btn-primary mb-4 text-center float-right">Create Jobs</a>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">job title</th>
                <th scope="col">category</th>
                <th scope="col">company</th>
                <th scope="col">job region</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
              <tr>
                <th scope="row">{{ $job->id }}</th>
                <td>{{ $job->job_title }}</td>
                <td>{{ $job->category }}</td>
                <td>{{ $job->company }}</td>
                <td>{{ $job->job_region }}</td>
                <form action="{{ route('delete.jobs',$job->id) }}" method="POST">
                    @csrf
                    <td><button type="submit" name="submit" class="btn btn-danger  text-center ">delete</button></td>
                </form>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>

@endsection
