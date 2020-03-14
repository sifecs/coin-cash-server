@extends('layout')

@section('content')
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <div class="leave-comment mr0"><!--leave comment-->

                    <h3 class="text-uppercase">Register</h3>
                    @include('admin.errors')
                    <br>
                    <form action="/register" class="form-horizontal contact-form" role="form" method="post" action="">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" value="{{old('phone')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                            </div>
                        </div>
                        <button type="submit" class="btn send-btn">Register</button>
                    </form>
                </div><!--end leave comment-->
            </div>
        </div>
    </div>
</div>
<!-- end main content-->
@endsection