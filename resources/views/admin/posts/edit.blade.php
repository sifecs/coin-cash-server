@extends('admin.layout')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Изменение поста
                <small>Пожалуйста измените пост</small>
            </h1>
        </section>

        <section class="content">

            <div class="box">
                {{ Form::open([
                    'route'=>['posts.update',$post->id],
                    'method'=>'put',
                    'files'=>true])
                }}
                <div class="box-header with-border">
                    <h3 class="box-title">Обновление поста</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$post->title}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Сумма</label>
                            <input type="text" name="cumma" class="form-control" id="exampleInputEmail1" value="{{$post->cumma}}" placeholder="Сумма">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Цвет</label>
                            <input type="color" name="color" class="form-control" id="exampleInputEmail1" value="{{$post->color}}" placeholder="">
                        </div>

                        <div class="form-group">
                            <label>Категория</label>
                            {{Form::select('category_id',
                                $categories,
                                $post->getCategoryID(),
                                ['class' => 'form-control select2'])}}
                        </div>

                        <div class="form-group">
                            <label>Валюты</label>
                            {{Form::select('currency_id',
                              $currencys,
                              $post->currency_id,
                              ['class' => 'form-control select2'])}}
                        </div>

                        <div class="form-group">
                            <label>Дата:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date" class="form-control pull-right" id="datepicker" value="{{$post->date}}">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Краткое описание</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control">{{$post->description}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{route('posts.index')}}" class="btn btn-default">Назад</a>
                    <button class="btn btn-warning pull-right">Изменить</button>
                </div>
                {{Form::close()}}
            </div>
        </section>
    </div>
@endsection