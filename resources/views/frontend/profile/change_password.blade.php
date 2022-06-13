@extends('frontend.main_master')
@section('content')
{{-- @php
$user = DB::table('users')->where('id',Auth::user()->id)->first();
@endphp --}}

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_profile_sidebar')
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Change your password</span></h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('user.password.update')}}">
                        @csrf

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmaill">Current password <span> </span></label>
                            <input id="current_password" name="oldPassword" type="password" class="form-control"
                                required>
                            {{-- Note: the next error handler work with all errors --}}
                            {{-- @if($errors->any())
                            <span class="text-danger">{{$errors->first()}}</span>
                            @endif --}}
                            {{-- Note: the next error handler work only with 'oldPassword' named errors --}}
                            @error('oldPassword')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">New password <span> </span></label>
                            <input id="password" type="password" name="password" class="form-control" required>
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Confirm Password <span>
                                </span></label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class="form-control" required>
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">
                                Update
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @endsection