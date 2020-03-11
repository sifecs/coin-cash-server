@extends('admin.layout')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
       Все пользователи
        <small>Добавление, редактирование, удаление</small>
      </h1>
    </section>

    <section class="content">

      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Листинг сущности</h3>
            </div>

            <div class="box-body">
              <div class="form-group">
                <a href="{{route('users.create')}}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>TOKEN</th>
                  <th>Телефон</th>
                  <th>Имя</th>
                  <th>E-mail</th>
                  <th>Баланс</th>
                  <th>Статусы</th>
                  <th>Аватар</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                  <tr class="check">
                    <td>{{$user->id}}</td>
                    <td data-token="{{$user->api_token}}">{{str_limit($user->api_token, 10)}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->balans}}</td>
                    <td>
                     <span> {{$user->is_admin}} | </span>
                     <span> {{$user->status}} </span>
                    </td>
                    <td><img src="{{$user->getImage()}}" alt="" class="img-responsive" width="150"></td>
                    <td>
                      <a href="{{route('users.edit', $user->id)}}" class="fa fa-pencil"></a>
                      {{Form::open(['route'=>['users.destroy', $user->id], 'method'=>'delete'])}}
                      <button onclick="return confirm('А вы уверены??')" class="delete-task" type="submit"><i class="fa fa-remove"></i></button>
                      {{Form::close()}}
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>

      </div>

    </section>

    <div class="modal fade" id="show-token">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Токен пользователя</h4>
          </div>
          <div class="modal-body" >
           <p id="modal--show-token">Тут токе</p>
            <input type='button' id='bCopy' value='Копировать!' >
            <br>
            <span id='log'></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.модальное окно-Содержание -->
      </div><!-- /.модальное окно-диалог -->
    </div><!-- /.модальное окно -->

  </div>

@endsection