@extends('admin.layout')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Изменение фананса
                <small>Пожалуйста измените финанс пользователя</small>
            </h1>
        </section>

        <section class="content">

            <div class="box">
                {{ Form::open([
                    'route'=>['finance.update',$financ->id],
                    'method'=>'put',
                    'files'=>true])
                }}
                <div class="box-header with-border">
                    <h3 class="box-title">Обновление Финанса пользователя</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Сумма</label>
                            <input type="text" name="amount" class="form-control" id="exampleInputEmail1" value="{{$financ->amount}}" placeholder="Сумма">
                        </div>

                        <div class="form-group">
                            <label>Категория</label>
                            {{Form::select('category_id',
                                $categories,
                                $financ->getCategoryID(),
                                ['class' => 'form-control select2'])}}
                        </div>

                        <div class="form-group">
                            <label>Валюты</label>
                            {{Form::select('currency_id',
                              $currencys,
                              $financ->currency_id,
                              ['class' => 'form-control select2'])}}
                        </div>

                        <div class="form-group">
                            <label>Дата:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date" class="form-control pull-right" id="datepicker" value="{{$financ->date}}">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Краткое описание</label>
                            <textarea name="comment" id="" cols="30" rows="10" class="form-control">{{$financ->comment}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{route('finance.index')}}" class="btn btn-default">Назад</a>
                    <button class="btn btn-warning pull-right">Изменить</button>
                </div>
                {{Form::close()}}
            </div>
        </section>
    </div>
@endsection