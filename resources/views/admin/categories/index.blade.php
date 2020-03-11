@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Список категорий
            <small>Полный список категорий</small>
        </h1>
    </section>

    <section class="content">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">лист категорий</h3>
            </div>

            <div class="box-body">
                <div class="form-group">
                    <a href="{{route('categories.create')}}" class="btn btn-success">Добавить</a>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>иконка</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categorie as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td style="color: {{$category->color}}">{{$category->title}}</td>
                            <td>
                                <img src="{{$category->getImage()}}" alt="" width="100">
                            </td>
                            <td>
                                <a href="{{route('categories.edit',$category->id)}}" class="fa fa-pencil"></a>
                                {{Form::open(['route'=>['categories.destroy', $category->id], 'method'=>'delete'])}}
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