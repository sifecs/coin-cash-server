@extends('admin.layout')

@section('content')
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Добавивление Финанс
        <small>Пожалуйста добавить Финанс пользователя</small>
      </h1>
    </section>

    <section class="content">
    {{Form::open([
      'route'=>'finance.store',
      'files'=>true
    ])}}
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Добавивление Финанс пользователя</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Название</label>
              <input type="text" name="title" value="{{old('title')}}" class="form-control" id="exampleInputEmail1" placeholder="">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Сумма</label>
              <input type="text" name="cumma" class="form-control" id="exampleInputEmail1" placeholder="Сумма">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Цвет</label>
              <input type="color" name="color" class="form-control" id="exampleInputEmail1" placeholder="">
            </div>

            <div class="form-group">
              <label>Категория</label>
              {{Form::select('category_id',
                $categories,
                null,
                ['class' => 'form-control select2'])}}
            </div>

            <div class="form-group">
              <label>Валюты</label>
              {{Form::select('currency_id',
               $currency,
               null,
                ['class' => 'form-control select2'])}}
            </div>

            <div class="form-group">
              <label>Дата:</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date" value="{{old('date')}}" class="form-control pull-right" id="datepicker">
              </div>
            </div>

          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Краткое описание</label>
              <textarea name="description" id="" cols="30" rows="10" class="form-control">{{old('description')}}</textarea>
            </div>
          </div>

      </div>

        <div class="box-footer">
          <a href="{{route('finance.index')}}" class="btn btn-default">Назад</a>
          <button class="btn btn-success pull-right">Добавить</button>
        </div>

      </div>
      {{Form::close()}}
    </section>
  </div>
@endsection