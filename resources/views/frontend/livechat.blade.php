@extends('frontend.frontend_layout')

@section('title', 'Live Chat')

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/livechat.css')}}">
@endpush

@section('content')
<div class="container chat-box">
    <div class="chat-container">
        <div class="card card-bordered">
            <div class="card-header">
                <div class="header-left">
                    <a href="#" class="btn-back"><i class="fas fa-arrow-left"></i></a>
                    <img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="Profile">
                    <div class="user-info">
                        <h4 class="card-title"><strong>Admin</strong></h4>
                    </div>
                </div>
               
            </div>
            <div class="ps-container ps-theme-default ps-active-y" id="chat-content">
                <!-- Chat messages will be dynamically inserted here -->

            </div>
            <div class="publisher bt-1 border-light">
                <img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                <input class="publisher-input" type="text" placeholder="Write something">
                <span class="publisher-btn file-group">
                    <i class="fa fa-paperclip file-browser"></i>
                    <input type="file">
                </span>
                <a class="publisher-btn" href="#" data-abc="true"><i class="fa fa-smile"></i></a>
                <a class="publisher-btn text-info" href="#" data-abc="true"><i class="fa fa-paper-plane"></i></a>
            </div>
        </div>
    </div>
    
</div>
@endsection

@push('scripts')
<script src="{{ asset('frontend/js/livechat.js')}}"></script>
@endpush