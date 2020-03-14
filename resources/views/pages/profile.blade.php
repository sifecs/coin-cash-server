@extends('layout')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="leave-comment mr0">
                    <h3 class="text-uppercase">Мой профиль</h3>
                    @include('admin.errors')
                    <p>Ваш токне <small class="text-muted"> {{$user->api_token}} </small></p>
                    <p>Ваш баланс <small class="text-muted"> {{$user->balans}} </small></p>
                    <br>
                    <img src="{{$user->getImage()}}" alt="" class="profile-image">
                    <form class="form-horizontal contact-form" enctype="multipart/form-data"  role="form" method="post" action="/profile">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="file" class="form-control" id="image" name="avatar">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$user->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" value="{{$user->phone}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                            </div>
                        </div>

                        <button type="submit" class="btn send-btn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection