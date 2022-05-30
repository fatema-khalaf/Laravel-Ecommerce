<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
    <h3 class="section-title">Newsletters</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <p>Sign Up for Our Newsletter!</p>
        <form method="post" action="{{route('subscribe.newsletter')}}">
            @csrf
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    placeholder="Subscribe to our newsletter">
                @error('email')
                <span class="invalid-feedback" style="color: red;" role="alert">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Subscribe</button>
        </form>
    </div>
    <!-- /.sidebar-widget-body -->
</div>