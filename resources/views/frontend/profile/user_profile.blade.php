@extends('frontend.main_master')
@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2 text-center"><br>
                <img class="card-img-top" src="{{(!empty($user->profile_photo_path))? url(
                'upload/user_images/'.$user->profile_photo_path
                ):url('upload/no_image.jpg')}}" alt="" height="100%" width="100%"
                    style="border-radius: 50%; max-width:200px; max-height:180px "><br><br>
                <ul class="list-group list-group-flush">
                    <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile update</a>
                    <a href="{{route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change password</a>
                    <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Log out</a>
                </ul>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi....</span><strong>{{
                            $user->name }}</strong> Update your profile </h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('user.profile.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmaill">Name <span> </span></label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name
                        }}">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email <span> </span></label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email
                        }}">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Phone <span> </span></label>
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone
                        }}">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">User image <span> </span></label>
                            <input type="file" name="profile_photo_path" class="form-control">
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