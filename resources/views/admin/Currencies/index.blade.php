@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Список валют
        <small>Полный список валют</small>
      </h1>
    </section>

    <section class="content">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Лист валит</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <a href="{{route('currencies.create')}}" class="btn btn-success">Добавить</a>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Название</th>
              <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($currencys as $currency)
              <tr>
                <td>{{$currency->id}}</td>
                <td>{{$currency->title}}</td>
                <td>
                  <a href="{{route('currencies.edit',$currency->id)}}" class="fa fa-pencil"></a>
                  {{Form::open(['route'=>['currencies.destroy', $currency->id], 'method'=>'delete'])}}
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

  </div>


@endsection