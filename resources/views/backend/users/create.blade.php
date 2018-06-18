@extends('layouts.backend.main')

@section('title','MyBlog | Kullanıcı Ekle')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kullanıcılar
                <small> Kullanıcı Ekle</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-dashboard"> Dashboard </i></a>
                </li>
                <li><a href="{{ route('users.index') }}">Kullanıcılar</a></li>
                <li class="active">Kullanıcı Ekle</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                {!! Form::model($user,[
                            'method' => 'POST',
                            'route' => 'users.store',
                            'files' => true,
                            'id' => 'user-form'
                            ]) !!}

                @include("backend.users.form")

                {!! Form::close() !!}
            </div>
        </section>
    </div>
@endsection