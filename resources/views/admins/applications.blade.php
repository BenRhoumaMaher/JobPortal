@extends('layouts.admin')

@section('content')


@if (session()->has('deleteapp'))
    <p class="container alert alert-success text-center">{{ session('deleteapp') }}</p>
@endif
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Job Applications</h5>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">cv</th>
                <th scope="col">job_id</th>
                <th scope="col">job_title</th>
                <th scope="col">company</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                <tr>
                    <th scope="row">{{ $application->id }}</th>
                    <td><a class="btn btn-success" href="{{ asset('assets/cvs/'.$application->cv.'') }}">{{ $application->cv }}</a></td>
                    <td><a class="btn btn-info" href="{{ route('single.job',$application->id) }}">Go to this job</a></td>
                    <td>{{ $application->job_title }}</td>
                    <td>{{ $application->company }}</td>
                    <form action="{{ route('delete.applications',$application->id) }}" method="post">
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
