@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Список Финансов
        <small>Управление финансами пользователя</small>
      </h1>
    </section>

    <section class="content">
      {{Form::open([
        'route'=>'finance.store',
        'files'=>true
      ])}}
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Листинг сущности</h3>
              <div class="">Баланс {{$user->getBalans()}}</div>
              @include('admin.errors')
            </div>

            <div class="box-body">
              <div class="form-group">
                <a href="{{route('finance.create')}}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Категория</th>
                  <th>Валюта</th>
                  <th>Телефон пользователя</th>
                  <th>Сумма</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>

                  @foreach($finance as $financ)
                  <tr>
                    <td>{{$financ->id}}</td>
                    <td>{{$financ->getCategoryTitle()}}</td>
                    <td>{{$financ->getСurrencyTitles()}}</td>
                    <td>{{$financ->getPhoneAuthor()}}</td>
                    <td>{{$financ->amount}}</td>
                    <td>
                      <a href="{{route('finance.edit', $financ->id)}}" class="fa fa-pencil"></a>
                      {{Form::open(['route'=>['finance.destroy', $financ->id], 'method'=>'delete'])}}
                      <button onclick="return confirm('А вы уверены??')" class="delete-task" type="submit"><i class="fa fa-remove"></i></button>
                      {{Form::close()}}
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>

          </div>

      {{Form::close()}}
    </section>

  </div>
@endsection