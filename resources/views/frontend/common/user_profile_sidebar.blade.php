@php
$id= Auth::user()->id;
$user = App\Models\User::find($id);
@endphp
<div class="col-md-2 text-center"><br>
    <img class="card-img-top" src="{{(!empty($user->profile_photo_path))? url(
    'upload/user_images/'.$user->profile_photo_path
    ):url('upload/no_image.jpg')}}" alt="" height="100%" width="100%"
        style="border-radius: 50%; max-width:200px; max-height:180px"><br><br>
    <ul class="list-group list-group-flush">
        <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
        <a href="{{route('my.orders')}}" class="btn btn-primary btn-sm btn-block">Orders</a>
        <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile update</a>
        <a href="{{route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change password</a>
        <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Log out</a>
    </ul>
</div>