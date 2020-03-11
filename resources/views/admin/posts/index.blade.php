@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Список постов
        <small>Полный список постов</small>
      </h1>
    </section>

    <section class="content">
      {{Form::open([
        'route'=>'posts.store',
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
                <a href="{{route('posts.create')}}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Название</th>
                  <th>Категория</th>
                  <th>Валюта</th>
                  <th>Телефон пользователя</th>
                  <th>Сумма</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>

                  @foreach($posts as $post)
                  <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->getCategoryTitle()}}</td>
                    <td>{{$post->getСurrencyTitles()}}</td>
                    <td>{{$post->getPhoneAuthor()}}</td>
                    <td>{{$post->cumma}}</td>
                    <td>
                      <a href="{{route('posts.edit', $post->id)}}" class="fa fa-pencil"></a>
                      {{Form::open(['route'=>['posts.destroy', $post->id], 'method'=>'delete'])}}
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