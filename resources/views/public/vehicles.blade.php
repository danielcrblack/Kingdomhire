@extends('layouts.public')

@section('content')
<section class="jumbotron jumbotron-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <header><h1 class="main-header">Our Fleet</h1></header>
      </div>
      <div class="col-md-6">
        <p class="paragraph">
          Below are most of the vehicles that are in our fleet. Not all our vehicles may be be listed on this page,
          so it's best to <b><a class="text-link" href="{{ route('public.contact') }}">Contact Us</a></b> to see what we have available.
        </p>
      </div>
    </div>
    <div class="row">
      <article class="col-sm-6">
        <img class="public-img" src="{{ asset('static/entrance.jpg') }}" alt="Kingdomhire main entrance">
        <h2 class="sub-header">Vehicle Rates/Hire Period</h2>
        <p class="paragraph">
          Our vehicle rates are competitive and can vary from vehicle to vehicle. They are also negotiable, so it's best to
          <b><a class="text-link" href="{{ route('public.contact') }}">Contact Us</a></b> to discuss pricing.
          Standard minimum renting period is <b>3 days</b> for all vehicles, large vans are an exception, where
          they start at <b>1 day</b> minimum rental.
        </p>
      </article>
      <article class="col-sm-6">
        <img class="public-img" src="{{ asset('static/business.jpg') }}" alt="Our facilities">
        <h2 class="sub-header">Insurance Policy</h2>
        <p class="paragraph">
          Most of our vehicles come with insurance as standard.
          If you wish to use your own insurance, we are sure we can facilitate you.
        </p>
      </article>
    </div>
  </div>
</section>
<section class="jumbotron jumbotron-content">
  <div class="container">
    <div class="row">
      @include('admin.vehicle.lists.public')
    </div>
  </div>
</section>
@endsection
