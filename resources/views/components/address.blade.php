<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">{{ $title }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url($route)}}"><i class="mdi mdi-home-outline"></i></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{$page}}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{$subpage}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>