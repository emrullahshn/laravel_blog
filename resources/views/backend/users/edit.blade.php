@extends('layouts.backend.main')

@section('title','MyBlog | Kullanıcı Güncelle')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kullanıcılar
                <small> Kullanıcı Güncelle</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-dashboard"> Dashboard </i></a>
                </li>
                <li><a href="{{ route('users.index') }}">Kullanıcılar</a></li>
                <li class="active">Kullanıcı Güncelle</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                {!! Form::model($user,[
                            'method' => 'PUT',
                            'route' => ['users.update',$user->id],
                            'files' => true,
                            'id' => 'user-form'
                            ]) !!}

                @include("backend.users.form")

                {!! Form::close() !!}
            </div>
        </section>
    </div>
@endsection