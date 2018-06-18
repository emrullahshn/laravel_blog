@extends('layouts.backend.main')

@section('title','MyBlog | Silme Onayı')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kullanıcılar
                <small> Silme Onayı</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-dashboard"> Dashboard </i></a>
                </li>
                <li><a href="{{ route('users.index') }}">Kullanıcılar</a></li>
                <li class="active">Silme Onayı</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                {!! Form::model($user,[
                            'method' => 'DELETE',
                            'route' => ['users.destroy',$user->id]
                            ]) !!}

                <div class="col-xs-9">
                    <div class="box">
                        <div class="box-body">
                            <p> Bu kullanıcıyı siliyorsunuz!</p>
                            <p>ID #{{ $user->id }}: {{ $user->name }}</p>
                            <p>Bu kullanıcının makaleleri ile ne yapılmalı?</p>
                            <p>
                                <input checked type="radio" name="delete_option" value="delete"> Tüm Makaleleri Sil
                            </p>
                            <p>
                                <input type="radio" name="delete_option" value="attribute"> Şu kullanıcıya aktar:
                                {!! Form::select('selected_user', $users, null) !!}
                            </p>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-danger">Onayla</button>
                            <a href="{{ route('users.index') }}" class="btn btn-default">Vazgeç</a>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </section>
    </div>
@endsection