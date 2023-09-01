@extends('layouts.app')

@section('content')

<section class="section-hero overlay inner-page bg-image" style="background-image: url('{{ asset('assets/images/hero_1.jpg') }}'); margin-top: -24px" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h1 class="text-white font-weight-bold">Edit Profile</h1>
          <div class="custom-breadcrumbs">
            <a href="#">Home</a> <span class="mx-2 slash">/</span>
            <a href="#">Job</a> <span class="mx-2 slash">/</span>
            <span class="text-white"><strong>Edit Profile</strong></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="site-section">
    <div class="container">

      <div class="row align-items-center mb-5">
        <div class="col-lg-8 mb-4 mb-lg-0">
          <div class="d-flex align-items-center">
            <div>
              <h2>Update Your Informations</h2>
            </div>
          </div>
        </div>

      </div>
      <div class="row mb-5">
        <div class="col-lg-12">
          <form class="p-4 p-md-5 border rounded" action="{{ route('update.details',$profile->id) }}" method="post">
            @csrf
            <!--job details-->

            <div class="form-group">
              <label for="job-title">Name</label>
              <input type="text" name="name" value="{{ old('name',$profile->name) }}" class="form-control" id="job-title" placeholder="Product Designer">
            </div>

            <div class="form-group">
                <label for="job-title">Job Title</label>
                <input type="text" name="job_title" value="{{ old('job_title',$profile->job_title) }}" class="form-control" id="job-title" placeholder="Product Designer">
            </div>

            <div class="form-group">
                <label for="job-title">Facebook</label>
                <input type="text" name="facebook" value="{{ old('facebook',$profile->facebook) }}" class="form-control" id="job-title" placeholder="Product Designer">
            </div>

            <div class="form-group">
                <label for="job-title">Twitter</label>
                <input type="text" name="twitter" value="{{ old('twitter',$profile->twitter) }}" class="form-control" id="job-title" placeholder="Product Designer">
            </div>

            <div class="form-group">
                <label for="job-title">Linkedin</label>
                <input type="text" name="linkedin" value="{{ old('linkedin',$profile->linkedin) }}" class="form-control" id="job-title" placeholder="Product Designer">
            </div>

            <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="">Bio</label>
                  <textarea name="bio" id="" cols="30" rows="7" class="form-control" placeholder="Write Job Description...">
                    {{ old('bio',$profile->bio) }}
                  </textarea>
                </div>
            </div>

            <div class="col-lg-4 ml-auto">
                  <div class="row">
                    <div class="col-6">
                      <input type="submit" name="submit" class="btn btn-block btn-primary btn-md" style="margin-left: 180px;" value="Edit">
                    </div>
                  </div>
              </div>


            </form>
          </div>


        </div>

      </div>

@endsection
