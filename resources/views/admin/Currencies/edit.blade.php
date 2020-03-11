@extends('admin.layout')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Изменяем валюту
        <small>Пожалуйста измените валюту</small>
      </h1>
    </section>

    <section class="content">

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Меняем валюту</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          {{ Form::open(['route'=>['currencies.update',$currency->id],'method'=>'put']) }}
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Название</label>
              <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$currency->title}}">
            </div>
          </div>
        </div>

        <div class="box-footer">
          <a href="{{route('currencies.index')}}" class="btn btn-default">Назад</a>
          <button class="btn btn-warning pull-right">Изменить</button>
        </div>

      </div>
      {{Form::close()}}

    </section>

  </div>

@endsection