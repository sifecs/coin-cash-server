@extends('admin.layout')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Добавление категории
                <small>Пожалуйста добавьте категорию</small>
            </h1>
        </section>

        <section class="content">

            <div class="box">
                {{Form::open([
                 'route' => 'categories.store',
                 'files'=>true
               ])}}
                <div class="box-header with-border">
                    <h3 class="box-title">Добавление категории</h3>
                   @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Лицевая картинка</label>
                            <input type="file" name="icon" id="exampleInputFile">
                            <p class="help-block">Какое-нибудь уведомление о форматах..</p>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Цвет</label>
                            <input type="color" name="color" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>

                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{route('categories.index')}}" class="btn btn-default">Назад</a>
                    <button class="btn btn-success pull-right">Добавить</button>
                </div>

                {!! Form::close() !!}
            </div>

        </section>

    </div>

@endsection
