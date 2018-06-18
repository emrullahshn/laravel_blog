@extends('layouts.backend.main')

@section('title','MyBlog | Kategori Güncelle')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kategori
                <small> Kategori Güncelle</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-dashboard"> Dashboard </i></a>
                </li>
                <li><a href="{{ route('categories.index') }}">Kategori</a></li>
                <li class="active">Kategori Güncelle</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                {!! Form::model($category,[
                            'method' => 'PUT',
                            'route' => ['categories.update',$category->id],
                            'files' => true,
                            'id' => 'category-form'
                            ]) !!}

                @include("backend.categories.form")

                {!! Form::close() !!}
            </div>
        </section>
    </div>
@endsection

@include('backend.categories.script')