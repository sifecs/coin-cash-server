@extends('admin.layout')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Редактируем пользователя
        <small>Админское редактирование :)</small>
      </h1>
    </section>

    <section class="content">

      <div class="box">
        {{ Form::open([
            'route'=>['users.update',$user->id],
            'method'=>'put',
            'files'=>true])
        }}
        <div class="box-header with-border">
          <h3 class="box-title">Редактируем пользователя</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">

          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Имя</label>
              <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$user->name}}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">E-mail</label>
              <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$user->email}}">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Телефон</label>
              <input type="text" name="phone" value="{{$user->phone}}" class="form-control" id="exampleInputEmail1" placeholder="">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Пароль</label>
              <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="">
            </div>

            <div class="form-group">
              <img src="{{$user->getImage()}}" alt="" class="img-responsive" width="150">
              <label for="exampleInputFile">Аватар</label>
              <input type="file" name="avatar" id="exampleInputFile">
              <p class="help-block">Какое-нибудь уведомление о форматах..</p>
            </div>

            <div class="form-group">
              <label for="exampleInuptBalans">Баланс</label>
              <input type="text" name="balans" id="exampleInuptBalans" value="{{$user->balans}}">
            </div>

            <div class="form-group">
              <div class="reating-arkows twokadjacent margin-bottom">
                <input <?php if ($user->is_admin) {echo 'checked';} ?> id="a" name="is_admin" type="checkbox"  value="1">
                <label for="a">
                  <div class="trianglesusing" data-checked="On" data-unchecked="Off"></div>
                  <div class="moresharpened">Сделать админом?</div>
                </label>
              </div>

              <div class="reating-arkows twokadjacent">
                <input  <?php if ($user->status) {echo 'checked';} ?> id="b" name="status" type="checkbox" value="1">
                <label for="b">
                  <div class="trianglesusing" data-checked="On" data-unchecked="Off"></div>
                  <div class="moresharpened">Сделать забаненым?</div>
                </label>
              </div>
            </div>

        </div>

      </div>
        <div class="box-footer">
          <a href="{{route('users.index')}}" class="btn btn-default">Назад</a>
          <button class="btn btn-warning pull-right">Изменить</button>
        </div>
        {{Form::close()}}
      </div>

    </section>

  </div>

@endsection