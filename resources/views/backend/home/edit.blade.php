@extends('layouts.backend.main')

@section('title','MyBlog | Hesap Güncelle')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Hesap
                <small> Hesap Güncelle</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-dashboard"> Dashboard </i></a>
                </li>
                <li class="active">Hesap Güncelle</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                @include('backend.partials.message')

                {!! Form::model($user,[
                            'method' => 'PUT',
                            'url' => '/edit-account',
                            'id' => 'user-form'
                            ]) !!}

                @include("backend.users.form",['hideRoleDropDown' => true])

                {!! Form::close() !!}
            </div>
        </section>
    </div>
@endsection