@extends('frontend.frontend_layout')

@section('title', 'Order Tracking')

@push('styles')
  <link rel="stylesheet" href="{{ asset('frontend/css/ordertracking.css') }}">
@endpush

@section('content')
  <div class="container mt-5 py-4 mb-5">

    {{-- <div class="row d-flex justify-content-center">
      <div class="col-6 col-lg-12">
        <ul id="progressbar" class="text-center">
          <li class="active step0"></li>
          <li class="active step0"></li>
          <li class="active step0"></li>
          <li class="step0"></li>
        </ul>
      </div>
      <div class="col-6 col-lg-12">
        <div class="row justify-content-between top">
          <div class="row d-flex icon-content">
            <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order<br>Processed</p>
            </div>
          </div>
          <div class="row d-flex icon-content">
            <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order<br>Shipped</p>
            </div>
          </div>
          <div class="row d-flex icon-content">
            <img class="icon" src="https://i.imgur.com/TkPm63y.png">
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order<br>En Route</p>
            </div>
          </div>
          <div class="row d-flex icon-content">
            <img class="icon" src="https://i.imgur.com/HdsziHP.png">
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order<br>Arrived</p>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  <hr> --}}
  {{-- New --}}
  <div class="order-container">
    <div
      class="order-step-number w-full d-flex text-white mx-auto justify-content-around align-items-center my-5 max-w-md step-container">
      <div class="step">
        <div class="step-header">
          <div data-step="1" class="step-circle border-white step-done">
            <i class="fas fa-check"></i>
          </div>
          <span class="progress-line step-done"></span>
        </div>
        <div class="row d-flex pb-5 ">
          <img class="icon" src="{{ asset('images/processed.png') }}">
          <div class="d-flex flex-column">
            <p class="font-weight-bold">Order<br>Processed</p>
          </div>
        </div>
      </div>

      <div class="step">
        <div class="step-header">
          <div data-step="1" class="step-circle border-white step-done">
            <i class="fas fa-check"></i>
          </div>
          <span class="progress-line"></span>
        </div>
        <div class="row d-flex pb-5 ">
          <img class="icon" src="{{ asset('images/shipped.png') }}">
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order<br>Shipped</p>
            </div>
        </div>
      </div>

      <div class="step">
        <div class="step-header">
          <div data-step="1" class="step-circle border-white">
            <i class="fas fa-circle"></i>
          </div>
          <span class="progress-line"></span>
        </div>
        <div class="row d-flex pb-5">
          <img class="icon" src="{{ asset('images/enroute.png') }}">
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order<br>En Route</p>
            </div>
        </div>
      </div>

      <div class="step">
        <div class="step-header">
          <div data-step="1" class="step-circle border-white">
            <i class="fas fa-circle"></i>
          </div>
          {{-- <span class="progress-line"></span> --}}
        </div>
        <div class="row d-flex pb-5">
          <img class="icon" src="{{ asset('images/arrived.png') }}">
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order<br>Arrived</p>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
